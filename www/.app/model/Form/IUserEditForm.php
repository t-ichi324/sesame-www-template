<?php
namespace Form;
use UserUtil;
/*------------------------------------------------------------------------*/
abstract class IUserEditForm extends \IForm{
    public $id;
    public $name;

    public function load(){
        return $this->__load();
    }
    protected function __load(... $fields){
        if(empty($this->id)){ throw new \NotFoundException();}
        if(!UserUtil::isExists($this->id)){ throw new \NotFoundException();}
        $q = UserUtil::query($this->id);
        if(empty($fields)){
            $this->setDbQuery($q);
        }else{
            if(!in_array("id", $fields)){ $fields[] = "id"; }
            if(!in_array("name", $fields)){ $fields[] = "name"; }
            $this->setDbQuery($q, $fields);
        }
    }
}
