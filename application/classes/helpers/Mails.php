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

    static function sendTemplateWithParamsToEmail($email, $template, $param, $order=false) {
        $templates = ORM::factory('templates');
        $template = $templates->getTemplate($template);
        $template['template'] = str_replace('%s%', $param, $template['template']);
        if($order) {
            $template['template'] = str_replace('%order%', self::generateOrderHtml($order), $template['template']);
        }
        self::sendLetterToEmail($template, $email);
        return true;
    }

    static function generateOrderHtml($order) {
        $arr = json_decode($order);
        $count_summ = 0;
        $arr = (array)$arr;
        if($arr['corner']=='left') $corner = '(Левая)'; else $corner = '(Правая)';
        $html = '';
        $html .= '<table border="1" style="border-collapse: collapse">
            <tr>
                <td style="padding:10px" colspan="3">'.ORM::factory('catalog')->where('id','=',$arr['id'])->find()->name.'
                    '.$corner.'
                </td>
            </tr>';
        foreach($arr as $key=>$item) {
            if($key == 'grades') {
                $grades = (array)$arr['grades'];
                if(count($grades)>0) {
                    $count_grades = count($grades)+1;
                    $html .= '<tr><td style="padding:10px" rowspan="'.$count_grades.'">Комплектация</td> </tr>';
                    foreach($grades as $key_grade=>$value_grade) {
                        $count_summ += $value_grade;
                        $html .= '  <tr>
                                        <td style="padding:10px">'.ORM::factory('grade')->where('id','=',$key_grade)->find()->name.'</td><td style="padding:10px">'.$value_grade.' руб.</td>
                                    </tr>';
                    }
                }
            }
            if($key == 'massages') {
                $massages = (array)$arr['massages'];
                if(count($massages)>0) {
                    $count_massages = count($massages)  ;
                    $html .= '<tr><td style="padding:10px" rowspan="'.$count_massages.'">Массажные опции</td> </tr>';
                    foreach($massages as $key_massage=>$value_massage) {
                        if($key_massage!='undefined') {
                            $count_summ += $value_massage;
                            $html .= '  <tr>
                                            <td style="padding:10px">'.ORM::factory('massage')->where('id','=',$key_massage)->find()->name.'</td><td style="padding:10px">'.$value_massage.' руб.</td>
                                        </tr>';
                        }
                    }
                }
            }
            if($key == 'accessories') {
                $accessories = (array)$arr['accessories'];
                if(count($accessories)>0) {
                    $count_accessories = count($accessories)+1  ;
                    $html .= '<tr><td style="padding:10px" rowspan="'.$count_accessories.'">Аксессуары</td> </tr>';
                    foreach($accessories as $key_accessories=>$value_accessories) {
                        $count_summ += $value_accessories;
                        if($key_accessories!='undefined') {
                            $html .= '  <tr>
                                            <td style="padding:10px">'.ORM::factory('catalog')->where('id','=',$key_accessories)->find()->name.'</td><td style="padding:10px">'.$value_accessories.' руб.</td>
                                        </tr>';
                        }
                    }
                }
            }

        }
        $html .= '
            <tr>
                <td style="padding:10px" colspan=2>Итого:</td><td style="padding:10px"><b>'.$count_summ.'</b> руб.</td>
            </tr>';
        $html .= '</table>';
        return $html;
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
