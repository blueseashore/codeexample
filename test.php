<?php
/**
*/
Class BuildXml{
    public static $_instance = null;
    public $configArr = [];
    public $dom = null;

    private function __construct(){
        $this->checkExtension();
    }

    public function __clone()
    {
        trigger_error("Can not be cloned");
    }

    public static function getInstance(){
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function checkExtension($extension_name = 'dom'){
        if(!extension_loaded($extension_name)){
            throw new Exception($extension_name.'-is not loaded !');
        }
        $this->dom = new DOMDocument('1.0');
    }

    public function bulidXml(array $configArr,$parent = null){
        try{
            if(!empty($configArr) && is_array($configArr)){
                foreach ($configArr as $k=>$v){
                    $v_ele = $this->dom->createElement($k);  //创建根节点
                    empty($parent)?$this->dom->appendChild($v_ele):$parent->appendChild($v_ele);        //添加根节点
                    if(is_array($v)){
                        $this->bulidXml($v,$v_ele);
                    }else{
                        $e_text = $this->dom->createTextNode($v);   //创建文本节点text
                        $v_ele->appendChild($e_text);   //将文本节点text添加到节点ele
                    }
                }
            }elseif(empty($parent)){
                throw new Exception('Data is non invalid !');
            }
            return $this->dom->saveXML();
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }
}



?>