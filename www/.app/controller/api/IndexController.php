<?php
//@ META ===================================
//@=========================================

class IndexController extends IController{
    public function index() {
        return Response::notFound();
    }
    public function init(){
        try{
            $x = new DbXml();
            $x->file("sys/init")->sql("default-kv")->execute();
            $x->file("sys/init")->sql("default-user")->execute();
            return "success";
        } catch (Exception $ex) {
            return Response::json($ex);
        }
    }
}