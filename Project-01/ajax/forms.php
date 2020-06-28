<?php
    include('../config.php');
        $data = [];
        $mail = new Email('smtp.gmail.com','brunoalvesvoice@gmail.com','Bru456123','project-01');

        $msg = '';
        foreach($_POST as $key =>$value)
        {
            $msg.=ucfirst($key).": ".$value;
            $msg.='<hr>';
        }
        $mail->addAdress('brunoalvesvoice@gmail.com','project');
        $info = array('subject'=>'New Contact!','body'=>$msg);
        $mail->formatEmail($info);
        if($mail->sendEmail())
        {
            $data['succed'] = true;
        }else 
        {
            $data['error'] = true;
        }
        die(json_encode($data));

?>