<?php
class UserUtil{
    public static function PW_HASH($password){
        return \Secure::toHash($password);
    }
    
    public static function ROLE_MASTER(){
        return AppKv::keyVal("user_role");
    }
    
    /*------------------------------------------------------------------------*/
    
    /** クエリを取得 */
    public static function query($id = null, $role_name = false){
        $q = new \DbQuery();
        $q->table(UserUtilEntity::TABLE());
        if($role_name){
            $fld = UserUtilEntity::TABLE().".roles";
            $q->fieldQuery("roles_name", AppKv::SQL_NAME_FIELD_QUERY("user_role", $fld, true));
        }
        if(\StringUtil::isNotEmpty($id)){ $q->ands("id", $id); }
        return $q;
    }
    
    /** 新規登録 */
    public static function insert(\Entity\User $entity){
        $x = new DbXml();
        try {
            $x->beginTran();
            
            $e = new Entity\UserActual($entity);
            $e->id = null;
            $e->is_deleted = 0;

            //パスワードのHASH
            if(!empty($e->password)){
                $e->password = self::PW_HASH($e->password);
            }

            //ロールの調整
            if(!empty($e->roles) && is_array($e->roles)){ $e->roles = implode(",", $e->roles); }
            
            //XMLのSQLを実行
            $x->file_Entity(\Entity\UserActual::class);
            $x->sql("insert", $e->toArray_ignoreNull())->execute();
            
            $x->commit();

            return $x->lastInsertId();
        } catch (Exception $exc) {
            $x->rollback();
            throw $exc;
        }
    }
    
    /** プロフィールテーブルの更新 */
    public static function update(\Entity\User $e, $id = null){
        if(!empty($id)){ $e->id = $id; }
        if(empty($e->id)) { return -1; }
        
        $x = new DbXml();
        try {
            $x->beginTran();
            
            //XMLのSQLを実行
            $x->file_Entity(\Entity\UserActual::class);
            $x->sql("update", $e->toArray())->execute();
            
            $x->commit();

            return $x->lastInsertId();
        } catch (Exception $exc) {
            $x->rollback();
            throw $exc;
        }
    }
    
    public static function delete($id){
        $q = new \DbQuery();
        $q->table_Entity(Entity\UserActual::class)->where("id", $id)->set("is_deleted", 1)->update();
    }
    /*------------------------------------------------------------------------*/
    /** 認証テーブルの更新 */
    private static function update_any($id, array $vals){
        $q = new \DbQuery();
        $q->table_Entity(\Entity\UserActual::class)->where("id", $id);
        foreach($vals as $k => $v){ if($k != "id"){ $q->set($k, $v); } }
        $q->update();
    }
    public static function update_auth_password($id, $password){
        $hash =self::PW_HASH($password);
        self::update_any( $id, array("password"=> $hash));
        //自分自身の場合は、cookieも更新
        if(Auth::getVal("id") == $id){ Auth::updateRemember("password", $hash); }        
    }
    public static function update_auth_roles($id, $roleList){
        $roles = "";
        if(is_array($roleList) && !empty($roleList)){
            $roles = implode(",", $roleList);
        }else{
            $roles = null;
        }
        self::update_any($id, array("roles"=>$roles));
    }
    public static function update_auth_ban($id, $flag){
        $v = \Flags::isON($flag) ? 1 : 0;
        self::update_any($id, array("is_ban"=>  $v));
    }
    public static function update_auth_single($id, $flag){
        $v = \Flags::isON($flag) ? 1 : 0;
        self::update_any($id, array("is_single"=> $v));
    }
    public static function update_auth_session_id($id, $session_id){
        self::update_any($id, array("session_id"=>$session_id));
    }
    public static function update_auth_term($id, $start, $end){
        if(empty($start)){ $start = null; }
        if(empty($end)){ $end = null; }
        self::update_any($id, array("term_start"=>$start, "term_end"=>$end));
    }
    public static function update_auth_notice($id, $notice){
        self::update_any($id, array("notice"=>$notice));
    }
    public static function update_auth_token($id, $token){
        self::update_any($id, array("token"=>$token));
    }
    public static function update_auth_attr($id, $attr){
        self::update_any($id, array("attr"=>$attr));
    }
    public static function update_auth_remarks($id, $remarks){
        self::update_any($id, array("remarks"=>$remarks));
    }
    /*------------------------------------------------------------------------*/
    
    
    /** ユニークデータ判定（is_deletedを除く） */
    public static function isUnique($fld_name, $fld_value, $id = null){
        $q = self::query();
        $q->ands($fld_name, $fld_value);
        if($id !== null){ $q->ands("id", "<>", $id); }
        return !$q->isExists();
    }
        
    /** 存在判定 */
    public static function isExists($id){
        return self::query($id)->isExists();
    }
    
    /** 単一データ取得 */
    public static function getValue($id, $fieldName){
        return self::query($id)->getValue($fieldName);
    }
    
    /** Entityに取得 */
    public static function getEntity($id){
        $e = self::query($id)->selectFirst();
        if(!$e !== null){
            $e instanceof UserUtilEntity;
        }
        return $e;
    }
    
    public static function getId_FromEmail($email){
        return self::query()->where("email", trim($email))->getValue("id");
    }
    
    /*------------------------------------------------------------------------*/
    /** 利用可能なEmailか */
    public static function isAvailable_email($email, $id = null){
        return self::isUnique("email", $email, $id);
    }
}
?>