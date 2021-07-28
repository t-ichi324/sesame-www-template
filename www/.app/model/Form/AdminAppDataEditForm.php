<?php
namespace Form;
use AppKv;
use Validator;

class AdminAppDataEditForm extends \IForm{
    const KV_NAME = "app_data_cl";
    
    use \Entity\__AppData;
    public $cl_name;
    public $cl_attr;
    
    public function hasError() {
        return Validator::hasError();
    }
    
    public function load(){
        if(!AppKv::isExists(self::KV_NAME, $this->key)) { throw new \NotFoundException(); }
        
        $x = new \DbXml();
        $x->file_Entity(\Entity\AppData::class);
        $r = $x->sql("get", $this->toArray())->selectFirst();
        if(!empty($r)){
            $this->bind($r);
        }
        
        $this->cl_name = AppKv::getVal(self::KV_NAME, $this->key);
        $this->cl_attr = AppKv::getAttr(self::KV_NAME, $this->key);
    }
    public function save(){
        if(!AppKv::isExists(self::KV_NAME, $this->key)) { throw new \NotFoundException(); }
        
        $param = $this->toArray();
        $param["attr"] = $this->cl_attr;
        
        $x = new \DbXml();
        $x->file_Entity(\Entity\AppData::class);
        $x->sql("save", $param)->execute();
    }
}
