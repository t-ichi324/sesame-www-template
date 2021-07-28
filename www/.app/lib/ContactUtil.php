<?php
class ContactUtil{
    public static function CL_MASTER(){
        return AppKv::keyVal("contact_cl");
    }
    
    /*------------------------------------------------------------------------*/
    
    /** クエリを取得 */
    public static function query($id = null, $cl_name = false){
        $q = new DbQuery();
        $q->table_Entity(\Entity\Contact::class)->where("is_deleted", 0);
        
        if(\StringUtil::isNotEmpty($id)){ $q->ands("id", $id); }
        if($cl_name){
            $q->fieldQuery("cl_name", AppKv::SQL_NAME_FIELD_QUERY("contact_cl", \Entity\Contact::TABLE().".cl"));
        }
        return $q;
    }
    
    /** 新規登録 */
    public static function insert(array $prof_data, $password, array $ext_auth_data = null){
        $q = new \DbQuery();
        try {
            $q->beginTran();
            $eP = new \Entity\UserProf($prof_data);
            $eA = new \Entity\UserAuth($ext_auth_data);

            $eA->id = null;
            $eA->is_deleted = 0;
            $eA->password = self::PW_HASH($password);
            $eA->created_at = now();
            //ロールの調整
            if(!empty($eA->roles) && is_array($eA->roles)){ $eA->roles = implode(",", $eA->roles); }
            
            //Authの登録
            $q->table_Entity(\Entity\UserAuth::class)->setArray($eA->toArray_ignoreNull("id"));
            $q->insert();

            
            //オートインクリメントのID
            $eP->id = $q->lastInsertId();
            
            //Profの登録
            $q->table_Entity(\Entity\UserProf::class)->setArray($eP->toArray_ignoreNull());
            $q->insert();
            
            $q->commit();
            
            return $eP->id;
        } catch (Exception $exc) {
            $q->rollback();
            throw $exc;
        }
        return -1;
    }
}

