<?php
//@ Assign ===============================
include __DIR__."/-meta.php";
// + Setting
Meta::vprefix("+/user");

// + Hierarcy
Meta::breadcrumb( __("admin.menu-user") , "+/user");
//@=========================================

class UserController extends IAuthController{
    /*** index */
    public function index(){
        $f = new ListForm();
        $f->load();
        return "index";
    }
    public function _ajax_post_list(){
        $f = new ListForm();
        $f->load();
        return "-list";
    }
    
    /*------------------------------------------------------------------------*/

    /*** add */
    public function add(){
        Meta::breadcrumb( __("register") , "+/add");
        $f = new \Form\UserAddForm();
        return "add";
    }
    
    public function _post_add(){
        Meta::breadcrumb( __("register") , "+/add");
        
        $f = new \Form\UserAddForm();
        if($f->hasError()){ return "add"; }
        $f->password = $f->pw;
        $id = $f->insert();
        
        //Mail
        $email = MailSender::register($f->email, $f->toArray_ignoreNull(), true);
        $regForm = new AdminUserRegisterMailForm();
        $regForm->has_template = false;
        
        if($email !== null){
            $regForm->has_template = true;
            $regForm->cc = $email->cc;
            $regForm->bcc = $email->bcc;
            $regForm->sender_addr = $email->sender_addr;
            $regForm->sender_name = $email->sender_name;
            $regForm->subject = $email->subject;
            $regForm->body = $email->body;
            $regForm->to = $f->email;
        }
        $regForm->name = $f->name;
        $regForm->password = $f->pw;
        $regForm->_src = $regForm->toBase64();
        
        Form::bundle($regForm);
        Message::addInfo( __("register-done") );
        return "add-success";
    }
    
    public function _post_saveEmail(){
        $f = new AdminUserRegisterMailForm();
        $f->bindBase64($f->_src);
        $txt = "--- To\n\n";
        $txt.= $f->to."\n\n";
        $txt.= "--- Subject\n\n";
        $txt.= $f->subject."\n\n";
        $txt.= "--- Body\n\n";
        $txt.= $f->body."\n";
        $nm = "[REGISTER] " . $f->name . " - " . $f->to.".txt";
        $fi = new FileInfo(Path::download_tmpfile());
        $fi->save($txt);
        return Response::download($fi->fullName(), $nm);
    }
    public function _post_sendEmail(){
        Meta::breadcrumb( __("register") , "+/add");
        
        $f = new AdminUserRegisterMailForm();
        $f->bindBase64($f->_src);
        $f->_src = $f->toBase64();
        
        Mailer::send($f->sender_addr, $f->sender_name, $f->to, $f->subject, $f->body);
        
        Message::addSuccess( __("send-done") );
        return "add-success";
    }
    
    /*------------------------------------------------------------------------*/
    public function detail(){
        Meta::breadcrumb( __("detail") , "+/detail");
        
        $f = new \Form\UserProfForm();
        $f->load();
        return "detail";
    }
    /*** edit */
    public function edit(){
        Meta::breadcrumb( __("edit") , "+/edit");
        
        $f = new \Form\UserProfForm();
        $f->load();
        return "edit";
    }
    public function _post_edit(){
        Meta::breadcrumb( __("edit") , "+/edit");
        $f = new \Form\UserProfForm();
        if(!$f->hasError()){
            $f->update();
            Message::addInfo( __("update-done") );
        }        
        return "edit";
    }
    
    /*------------------------------------------------------------------------*/
    public function roles(){
        Meta::breadcrumb( __("admin.menu-user-roles") , "+/roles");
        
        $f = new \Form\UserRoleForm();
        $f->load();
        return "roles";
    }
    public function _post_roles(){
        Meta::breadcrumb(__("admin.menu-user-roles") , "+/roles");
        $f = new \Form\UserRoleForm();
        if(!$f->hasError()){
            $f->update();
            Message::addInfo( __("update-done") );
        }
        return "roles";
    }
    
    /*------------------------------------------------------------------------*/
    public function term(){
        Meta::breadcrumb( __("admin.menu-user-term") , "+/term");
        
        $f = new \Form\UserTermForm();
        $f->load();
        return "term";
    }
    public function _post_term(){
        Meta::breadcrumb( __("admin.menu-user-term") , "+/term");
        
        $f = new \Form\UserTermForm();
        if(!$f->hasError()){
            $f->update();
            Message::addInfo( __("update-done") );
        }
        return "term";
    }
    
    /*------------------------------------------------------------------------*/
    public function setting(){
        Meta::breadcrumb( __("admin.menu-user-setting") , "+/setting");
        
        $f = new \Form\UserSettingForm();
        $f->load();
        return "setting";
    }
    public function _post_setting(){
        Meta::breadcrumb( __("admin.menu-user-setting") , "+/setting");
        
        $f = new \Form\UserSettingForm();
        if(!$f->hasError()){
            $f->update();
            Message::addInfo( __("update-done") );
        }
        return "setting";
    }
    
    /*------------------------------------------------------------------------*/
    public function pw(){
        Meta::breadcrumb( __("admin.menu-user-pw") , "+/pw");
        
        $f = new \Form\UserPwForm();
        $f->load();
        return "pw";
    }
    public function _post_pw(){
        Meta::breadcrumb( __("admin.menu-user-pw") , "+/pw");
        
        $f = new \Form\UserPwForm();
        if(!$f->hasError()){
            $f->update();
            Message::addInfo( __("update-done") );
        }
        return "pw";
    }
    
    /*------------------------------------------------------------------------*/
    public function del(){
        if(Auth::getVal("id") == Form::getVal("id")){
            return Response::notFound();
        }
        
        Meta::breadcrumb( __("admin.menu-user-del") , "+/del");
        
        $f = new \Form\UserDelForm();
        $f->load();
        return "del";
    }
    public function _post_del(){
        if(Auth::getVal("id") == Form::getVal("id")){
            return Response::notFound();
        }
        
        Meta::breadcrumb( __("admin.menu-user-del") ,"+/del");
        
        $f = new \Form\UserDelForm();
        if(!$f->hasError()){
            $f->update();
            Model::set("is_deleted", Flags::ON);
            Message::addInfo( __("delete-done-*", $f->name) );
        }
        return "del";
    }
}

class ListForm extends IListForm{
    public $keyword;
    public $role;
    public $odr;
    
    public function load(){
        $this->setLimit(20);
        
        $q = UserUtil::query(null, true)->fetchClass(ListItem::class);
        
        if(StringUtil::isNotEmpty($this->keyword)){
            $kw = explode(" ", str_replace("　", " ", $this->keyword));
            $q->whereLikes(["email","name"], $kw);
        }
        if(StringUtil::isNotEmpty($this->role)){
            $q->where("roles", "LIKE", "%".$this->role."%");
        }
        $this->setDbQueryList($q);
        
        Model::set("roles", UserUtil::ROLE_MASTER());
    }
}
class ListItem extends IEntity{
    use \Entity\__User;
    public $roles_name;
    
    public function getRoleName(){
        $txt = $this->roles_name;
        return StringUtil::defaultVal($txt, "---");
    }
    
    public function getTermName(){
        $txt = str_replace("-", "/",$this->term_start) ."～".str_replace("-", "/",$this->term_end);
        if($txt === "～"){
            $txt = __("unlimited");
        }
        return $txt;
    }
    
    public function getSettingName(){
        $txt = "";
        $txt .= Flags::isON($this->is_single) ? "S" : "-" ;
        $txt .= Flags::isON($this->is_ban) ? "B" : "-" ;
        return $txt;
    }
}

class AdminUserRegisterMailForm extends IForm{
    use \Entity\__AppMail;
    public $has_template;
    public $to;
    public $password;
    public $name;
    
    public $_src;
}
?>