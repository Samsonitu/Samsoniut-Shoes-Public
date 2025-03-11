<?php

namespace Models\UserModels;

use Core\Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactModel extends Model
{
    public function sendEmail($to, $subject, $message, $senderName) {
        $mail = new PHPMailer(true);    
        try {
            // Cấu hình SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'huanpnpi00139@gmail.com';
            $mail->Password = 'qelp txlm gcqb kdwy';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Thiết lập email
            $mail->CharSet = 'UTF-8';
            $mail->setFrom('huanpnpi00139@gmail.com', $senderName);
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}