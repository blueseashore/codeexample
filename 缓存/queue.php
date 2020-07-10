<?php

/**
 * User: kendo    Date: 2018/3/1
 * 队列 FIFO
 */
class Memcache_queue
{

    private static $_instance;

    private $_mem;

    private $_max_try = 5;

    private $_prefix = 'fifo_';

    private function __construct()
    {
        $this->_mem = new Memcached('queue');
        $this->_mem->addServer('127.0.0.1', 11211);
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function getInstance()
    {
        if (!self::$_instance instanceof self) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * 检测是否存在当前队列的锁
     * 存在，则等待当前锁释放，然后重新上锁
     * 不存在，直接上锁
     *
     * @param string $key
     * @return bool
     */
    public function lock($key = '')
    {
        $lock_key = $this->_prefix . $key . '_access';
        $this->_mem->get($lock_key);
        if ($this->_mem->getResultCode() === Memcached::RES_NOTFOUND) { //锁不存在
            return $this->_mem->add($lock_key, TRUE);
        } else {  //锁存在
            $this->_mem->delete($lock_key);
            $access = FALSE;
            $max_try = $this->_max_try;
            while (!$access) {
                usleep(500);
                $this->_mem->get($lock_key);
                if ($this->_mem->getResultCode() === Memcached::RES_NOTFOUND) {
                    return $this->_mem->add($lock_key, TRUE);
                }
                $max_try--;
                if ($max_try < 1) {
                    return FALSE;
                    break;
                }
            }
        }
        return TRUE;
    }

    /**
     * 锁释放
     *
     * @param string $key
     * @return bool
     */
    public function unlock($key = '')
    {
        $lock_key = $this->_prefix . $key . '_access';
        return $this->_mem->delete($lock_key);
    }

    //入栈
    public function pop($key = '', $value = '')
    {
        $lock = $this->lock($key);
        if (!$lock) {
            return FALSE;
        }
        $val_key = $this->_prefix . $key;
        $val = $this->_mem->get($val_key);
        if ($this->_mem->getResultCode() === Memcached::RES_NOTFOUND) {
            return $this->_mem->add($val_key, json_encode([$value]));
        } else {
            $mq = json_decode($val, TRUE);
            $mq[] = $value;
            $this->_mem->set($val_key, json_encode($mq));
        }
        $this->unlock($key);
        return TRUE;
    }

    //出栈
    public function shift($key = '', $num = 1)
    {
        $lock = $this->lock($key);
        if (!$lock) {
            return FALSE;
        }
        $val_key = $this->_prefix . $key;
        $val = $this->_mem->get($val_key);
        if ($this->_mem->getResultCode() === Memcached::RES_NOTFOUND) {
            return FALSE;
        } else {
            $list = [];
            $mq = json_decode($val, TRUE);
            if ($num === count($mq)) {
                $list = $mq;
            }
            for ($i = 1; $i <= $num; $i++) {
                $list[] = array_shift($mq);
            }
        }
        $this->_mem->set($val_key, json_encode($mq));
        $this->unlock($key);
        return $list;
    }

    public function get_mq($key = '')
    {
        return $this->_mem->get($this->_prefix . $key);
    }

    public function flush()
    {
        return $this->_mem->flush();
    }
}

$mem = Memcache_queue::getInstance();
$info = [
    'title' => 'Test',
    'content' => 'just a test',
    'time' => time(),
];
$mem->pop('message', $info);
$mem->pop('message', $info);
$b = $mem->shift('message');
print_r($b);
