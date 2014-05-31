<?php

defined('SYSPATH') or die('No direct script access.');

class Mails {
            
    static function sendConfirmLetter($address, $id_user) {
        $mail = new PHPMailer();
        $translator = FrontHelper::getTranslation();
        $mail->From = ORM::factory('parameters')->getParam('global_email');
        $mail->AddAddress($address);
        $mail->Subject = $translator['letter_confirm_subject'];
        $user = ORM::factory('User')->where('id', '=', $id_user)->find();
        $url = URL::base(true) . "profile/confirm/" . $user->hash;
        $mail->Body = Translation::getTranslateParam('%s%', $url, $translator['letter_confirm_body']);             
        $mail->IsHTML(true); 
        return $mail->Send();
    }
    
    static function sendForgotLetter($address, $id_user) {
        $mail = new PHPMailer();
        $translator = FrontHelper::getTranslation();
        $mail->From = ORM::factory('parameters')->getParam('global_email');
        $mail->AddAddress($address);        
        $mail->Subject = $translator['letter_forgot_subject'];
        $user = ORM::factory('User')->where('id', '=', $id_user)->find();
        $url = URL::base(true) . "profile/forgot/" . $user->hash;
        $mail->Body = Translation::getTranslateParam('%s%', $url, $translator['letter_forgot_body']);                     
        $mail->IsHTML(true); 
        return $mail->Send();
    }
    
    static function sendTemplate($user, $template) {
        $templates = ORM::factory('templates');        
        $template = $templates->getTemplate($template);
        self::sendLetter($template, $user->id);
        return true;
    }
    
    static function sendTemplateWithParams($user, $template, $param) {
        $templates = ORM::factory('templates');        
        $template = $templates->getTemplate($template);
        $template = str_replace('%s%', $param, $template['template']);        
        self::sendLetter($template, $user->id);
        return true;
    }

    static function sendTemplateWithParamsToEmail($email, $template, $param) {
        $templates = ORM::factory('templates');
        $template = $templates->getTemplate($template);
        $template['template'] = str_replace('%s%', $param, $template['template']);
        self::sendLetterToEmail($template, $email);
        return true;
    }
        
    /* $template : ORM Factory Array
     * $template = array(
     *                      'subject'=>
     *                      'template'=>
     *             )
     *    */
    static function sendLetter($template, $id_user) {
        $user = ORM::factory('user', $id_user);
        $mail = new PHPMailer();        
        $mail->From = ORM::factory('parameters')->getParam('global_email');
        $mail->AddAddress($user->email);
        $mail->Subject = $template['description'];                
        $mail->Body = $template['template'];           
        $mail->IsHTML(true); 
        return $mail->Send();
    }

    static function sendLetterToEmail($template, $email) {
        $mail = new PHPMailer();
        $mail->From = $email;
        $mail->AddAddress($email);
        $mail->Subject = $template['description'];
        $mail->Body = $template['template'];
        $mail->IsHTML(true);
        return $mail->Send();
    }
    
    
}
?>
