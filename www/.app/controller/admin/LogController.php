<?php
//@ META ==================================
Meta::action("+/log");
Meta::vprefix("+/log");
Meta::breadcrumb( __("admin.menu-userlog") , "+/log");
//@=========================================

class LogController extends IAuthController{
    
    /*** index */
    public function index(){
        $f = new ListForm();
        $f->load();
        
        if(!empty($f->user_id)){
            $user_name = UserUtil::getValue($f->user_id, "name");
            Model::set("user_name", $user_name);
            Meta::breadcrumb("[ ".$user_name." ]", "admin/log");
        }
        
        return "index";
    }
    public function _ajax_post_list(){
        $f = new ListForm();
        $f->load();
        
        return "-list";
    }
    public function _post_del(){
        $f = new ListForm();
        $q = $f->getDbQuery(false);
        $q->delete();
        
        Message::addInfo( __("delete-done") );
        Message::toRedirect();
        return Response::redirect("admin/log");
    }
    
    public function download_csv(){
        $f = new ListForm();
        
        $q = $f->getDbQuery()->fetchArray();
        $rows = $q->select("i.created_at, u.name, i.cl, i.url, i.user_agent, i.session_id, ip");
        
        $csv = new CsvBuilder();
        $csv->setArray($rows);
        return $csv->ResponseDonwload("download.csv");
    }
}

class ListForm extends IListForm{
    public $user_id;
    public $cl;
    public $sd;
    public $ed;
    
    public function load(){
        $this->setLimit(100);

        $q = $this->getDbQuery();
        $q->ordrBy("i.created_at desc");
        $this->setDbQueryList($q, "i.*, u.name");
        
        Model::set("dl-query", $this->queryString("list","p"));
    }
    
    public function getDbQuery($join_user = true){
        $q = new DbQuery();
        
        if($join_user){
            $a = "i.";
            $q->table_Entity(ListItem::class, "i");
            $q->leftJoin("user", "u", "i.user_id = u.id");
        } else {
            $a = "";
            $q->table_Entity(ListItem::class);
        }
        
        if(!empty($this->user_id)){
            $q->ands($a."user_id", $this->user_id);
        }
        if(!empty($this->cl)){
            $q->ands($a."cl", "IN", explode(",",$this->cl));
        }
        if(!empty($this->sd)){
            $q->ands("DATE(".$a."created_at)", ">=", date("Y-m-d", strtotime($this->sd)));
        }
        if(!empty($this->ed)){
            $q->ands("DATE(".$a."created_at)", "<=" ,date("Y-m-d", strtotime($this->ed)));
        }
        return $q;
    }
}
class ListItem extends \Entity\UserLog{
    public $name;
    public $cl_name;
    
    public function getBrowser(){
        echo UserAgentUtil::getBrowserName($this->user_agent);
    }
}

?>