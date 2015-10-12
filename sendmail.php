<?php    
    require("./phpmailer/class.phpmailer.php");    
    function smtp_mail( $sendto_email, $subject, $body){   
        $Sender = 'line010101@163.com'; //发送人 
        $mail = new PHPMailer();    
        $mail->CharSet = "utf-8"; //设置字符集编码
        $mail->IsSMTP();                  // send via SMTP    
        $mail->Host = 'smtp.163.com';   // SMTP servers    
        $mail->SMTPAuth = true;           // turn on SMTP authentication    
        $mail->Username = $Sender;     // SMTP username  注意：普通邮件认证不需要加 @域名    
        $mail->Password = 'nzziiohvljhhmsgj'; // SMTP password    
        $mail->From = $Sender;      // 发件人邮箱      
        $mail->AddAddress($sendto_email,'');  // 收件人邮箱和姓名      
        $mail->WordWrap = 50; // set word wrap 换行字数     
        $mail->IsHTML(true);  // send as HTML    
        // 邮件主题    
        $mail->Subject = $subject;    
        // 邮件内容    
        $mail->Body =   '<p>' . $body['realname'] . ' 希望试用国家免费孕前优生健康检查项目医疗服务信息系统</p>'
                        .'<p> 请速与答复！</p>'
                        .'<p> 单位名称：' . $body['unitname'] . '<br/></p>'
                        .'<p>姓名：' . $body['realname'] . '</p>'
                        .'<p>职务：' . $body['business'] . '</p>'
                        .'<p>电话/手机：' . $body['phone'] . '</p>';                                                                       
        $mail->AltBody ="text/html";   
        $msg = array();
        if(!$mail->Send())    {    
            //echo "邮件发送有误 <p>";    
            //echo "邮件错误信息: " . $mail->ErrorInfo;
            $msg['status'] = -1;
            $msg['info']   = '邮件发送失败';
            $mgs['data']   = $mail->ErrorInfo;
        }else{    
            //echo "$user_name 邮件发送成功!<br />";
            $msg['status'] = 1;
            $msg['info']   = '邮件发送成功';
            $mgs['data']   = '';    
        }
        echo json_encode($msg);    
    }    
    $body = array();
    $body['unitname'] = $_REQUEST['unitname'];
    $body['realname'] = $_REQUEST['realname'];
    $body['business'] = $_REQUEST['business'];
    $body['phone']    = $_REQUEST['phone'];
    // 参数说明(发送到, 邮件主题, 邮件内容, 附加信息, 用户名)    
    //smtp_mail("xiangzheng@lin-e.cn""01@lin-e.cn", "试用意向", $body);   
    smtp_mail("xiangzheng@lin-e.cn", "试用意向", $body); 
?> 