<?php
//@ Assign ===============================
include __DIR__."/-meta.php";

//@=========================================

class IndexController extends IAuthController{

    /*** index */
    public function index(){
        $q = new DbQuery();
        Model::set("contact_nocheck", $q->table("contact")->where("is_deleted", 0)->ands("is_checked", 0)->getCount());
        return "index";
    }
}
?>