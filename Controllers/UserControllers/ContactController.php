<?php

namespace Controllers\UserControllers;
use Core\BaseController;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController extends BaseController
{
    protected $Model = "UserModels\ContactModel";
    public function showContactView() {view('User/UserPages/ContactView');}

    public function sendMessage()
    {
        if (isset($_POST['SubmitSendMessage']) && $_POST['SubmitSendMessage']) {
            $fullName = htmlspecialchars(trim($_POST['fullName']), ENT_QUOTES, 'UTF-8');
            $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
            $phone = htmlspecialchars(trim($_POST['phone']), ENT_QUOTES, 'UTF-8');
            $userMessage = htmlspecialchars(trim($_POST['message']), ENT_QUOTES, 'UTF-8');

            if (!$email) {
                toastMessage('error', 'Lỗi!', 'Email không hợp lệ');
                redirect('ContactRoute');
                return;
            }

            $subject = "Tin Nhắn Từ Biểu Mẫu Liên Hệ Website: Samsonitu Shoes";
            
            $emailContent = "
                <p>
                    <strong>Họ Và Tên:</strong> {$fullName}<br>
                    <strong>Email:</strong> {$email}<br>
                    <strong>Số Điện Thoại:</strong> {$phone}
                </p>
                <p><strong>Lời Nhắn: </strong> {$userMessage}</p>
            ";

            $mail = new PHPMailer(true);

            try {
                // Cấu hình SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'huanpnpi00139@gmail.com'; // Gmail của bạn
                $mail->Password = 'qelp txlm gcqb kdwy'; // Dùng App Password thay vì mật khẩu Gmail
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Thiết lập email
                $mail->CharSet = 'UTF-8';
                $mail->setFrom('huanpnpi00139@gmail.com', 'Samsonitu Shoes');
                $mail->addAddress('huanpham030505@gmail.com'); // Gửi đến email quản trị viên
                $mail->Subject = $subject;
                $mail->isHTML(true);
                $mail->Body = $emailContent;

                if ($mail->send()) {
                    toastMessage('success', 'Thành công!', 'Tin nhắn đã được gửi.');
                } else {
                    toastMessage('error', 'Lỗi!', 'Không thể gửi email, vui lòng thử lại.');
                }
            } catch (Exception $e) {
                toastMessage('error', 'Lỗi!', 'Lỗi gửi email: ' . $mail->ErrorInfo);
            }

            redirect('ContactRoute');
        } else {
            toastMessage('error', 'Lỗi!', 'Kiểm tra biểu mẫu gửi đi');
            redirect('ContactRoute');
        }
    }
}