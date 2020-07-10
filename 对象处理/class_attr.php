<?php
/**
 * 对象遍历
 * User: kendo    Date: 2018/3/1
 */

class Test
{
    /***
     * TEST CLASS
     * @var int
     */
    public $a = 1;
    public $b = 2;
    protected $c = 3;
    private $d = 4;

    //重置迭代器指针位置
    public function rewind()
    {
        $this->position = 0;
    }
}

/*
 * 第一种方法，获取public属性
 */
$obj = new Test();
foreach ($obj as $k => $v) {
    echo $k, '=', $v, PHP_EOL;
}
echo '第二种方法：反射', PHP_EOL;
/**
 * 使用反射类，可以获取对象的所有属性
 */
$reflectionObj = new ReflectionClass($obj);
$properities = $reflectionObj->getProperties();
foreach ($properities as $item) {
    $item->setAccessible(TRUE); //不加这句的话，不可以访问非public属性的值，名可以访问，且下一语句报错
    //if($item->isPublic()){
    echo $item->getName(), '=', $item->getValue($obj), PHP_EOL;
    //}
}

/*
 * rewind -> valid -> current -> current -> key -> next
 */

class TestTwo implements Iterator
{
    private $var = array();

    public function __construct($array)
    {
        $this->var = $array;
    }

    public function rewind()
    {
        echo __FUNCTION__, PHP_EOL;
        reset($this->var);
    }

    public function current()
    {
        $val = current($this->var);
        echo 'current:', $val, PHP_EOL;
        return $val;
    }

    public function valid()
    {
        $val = $this->current() !== FALSE;
        echo 'valid:', $val, PHP_EOL;
        return $val;
    }

    public function next()
    {
        $val = next($this->var);
        echo 'next:', $val, PHP_EOL;
        return $val;
    }

    public function key()
    {
        $val = key($this->var);
        echo PHP_EOL, 'key:', $val, PHP_EOL;
        return $val;
    }
}

echo '第三种方法：迭代器', PHP_EOL;
$obj = new TestTwo(array(1, 2, 3, 4));
foreach ($obj as $k => $v) {
    var_dump($k, $v);
}


echo '第四种方法：IteratorAggregate', PHP_EOL;

class MyCollection implements IteratorAggregate
{
    private $items = array();
    private $count = 0;

    // Required definition of interface IteratorAggregate
    public function getIterator()
    {
        return new TestTwo($this->items);
    }

    public function add($value)
    {
        $this->items[$this->count++] = $value;
    }
}

$coll = new MyCollection();
$coll->add('value 1');
$coll->add('value 2');
$coll->add('value 3');

foreach ($coll as $key => $val) {
    echo "key/value: [$key -> $val]\n\n";
}

echo '第五种方法：IteratorAggregate', PHP_EOL;

class TestFive
{
    /***
     * TEST CLASS
     * @var int
     */
    public $a = 1;
    public $b = 2;
    protected $c = 3;
    private $d = 4;

    public function __get($name)
    {
//       yield $this->$name;
    }
}

$obj = new TestFive();
foreach ($obj as $item) {
    print_r($item);
}

