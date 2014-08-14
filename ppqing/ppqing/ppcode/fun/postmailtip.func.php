<?php

/**
 * 发送邮件 
 * @param unknown_type $to
 * @param unknown_type $subject
 * @param unknown_type $body
 */
        error_reporting(E_STRICT);
    date_default_timezone_set("Asia/Shanghai");//设定时区东八区
    
function postmailtip($to,$subject = "",$body = "",$rname=""){
    //Author:Jiucool WebSite: http://www.jiucool.com 
    //$to 表示收件人地址 $subject 表示邮件标题 $body表示邮件正文
    //error_reporting(E_ALL);

    require_once  'application/class/class.smtp.php';
    include_once('application/class/class.phpmailer.php');
    $SPconfig=file_get_contents('var/data/setting/SPconfig.tpl');
     $mailsetting=unserialize($SPconfig);
    $mail             = new PHPMailer(); //new一个PHPMailer对象出来
    $body             = eregi_replace("[\]",'',$body); //对邮件内容进行必要的过滤
    $mail->CharSet ="UTF-8";//设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->IsSMTP(); // 设定使用SMTP服务
    $mail->SMTPDebug  = 0;                     // 启用SMTP调试功能
                                           // 1 = errors and messages
                                           // 2 = messages only
    $mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
    $mail->SMTPSecure = "ssl";                 // 安全协议
    $mail->Host       = $mailsetting['mailhost'];     // SMTP 服务器
    $mail->Port       =  $mailsetting['mailpost'];                   // SMTP服务器的端口号
    $mail->Username   =  $mailsetting['mailusername'];  // SMTP服务器用户名
    $mail->Password   =  $mailsetting['mailpassword'];            // SMTP服务器密码
    $mail->SetFrom('admin@shenpang.cc', $mailsetting['mailnametip']);
    $mail->AddReplyTo("164935394@qq.com","邮件回复人的名称");
    $mail->Subject    = $subject;
    $mail->AltBody    = "To view the message, please use an HTML compatible email viewer! - From www.jiucool.com"; // optional, comment out and test
    $mail->MsgHTML($body);
    $address = $to;
    if($rname!=""){
    $mail->AddAddress($address, $rname);
    }else{
    $mail->AddAddress($address, "身旁网用户");	
    }
    //$mail->AddAttachment("images/phpmailer.gif");      // attachment 
    //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
    if(!$mail->Send()) {
        //echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
      //  echo "Message sent!恭喜，邮件发送成功！";
        }
    }
?>