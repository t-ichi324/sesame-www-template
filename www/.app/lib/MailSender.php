<?php
class MailSender{
    /**メールを送信*/
    private static function send($trigger, $toEmail, array $replaces, $no_send = false){
        $e = self::getEntity($trigger, $replaces);
        if($no_send){
            return $e;
        }
        
        if($e !== null && $e instanceof \Entity\AppMail){
            $ml = new Mailer();
            $ml->set_charaset();
            $ml->send($e->sender_addr, $e->sender_name, $toEmail, $e->subject, $e->body);
            return $e;
        }
        throw new Exception("MailSender:: NotFound [". $trigger."]");
    }
    
    /**置換済みEntityを取得*/
    public static function getEntity($trigger, array $replaces){
        $q = new DbQuery();
        $e = $q->table_Entity(\Entity\AppMail::class)->where("trigger", $trigger)->selectFirst();
        
        if($e !== null && $e instanceof \Entity\AppMail){
            $e->body = self::replacement($e->body, $replaces);
            return $e;
        }
        return null;
    }
    /**置換機構*/
    private static function replacement($body, array $replaces){
        foreach($replaces as $k => $v){ $body = str_replace("{".$k."}", $v, $body); }
        return $body;
    }
    
    /**
     * $replaces \Form\UserProf
     */
    public static function register($to, array $replaces, $no_send = false){
        return self::send("register", $to, $replaces, $no_send);
    }
    
    /**
     * $replaces UserEntity
     */
    public static function forgot($to, array $replaces, $no_send = false){
        return self::send("forgot", $to, $replaces, $no_send);
    }
    /**
     * $replaces \Form\ContactForm
     */
    public static function contact($to, array $replaces, $no_send = false){
        return self::send("contact", $to, $replaces, $no_send);
    }
}
?>