<?php

namespace Controllers\UserControllers;
use Core\BaseController;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use services\AuthService;

class AccountController extends BaseController
{
    protected $Model = "UserModels\AccountModel";

    public function getPasswordByEmail()
    {
        if(isset($_POST['SubmitGetPassword']) && ($_POST['SubmitGetPassword'])) {
            $email = $_POST['email'];
            $isExists = $this->Database->checkExistsEmailCreateByNormal($email);
            if(!$isExists) redirect('LoginRoute');            

            $newPassword = $this->generateNewPassword();
            $hasSent = $this->sendNewPasswordToEmail($email, $newPassword);
            if(!$hasSent) redirect('LoginRoute');
            
            $resultUpdate = $this->Database->updateNewPassword($email, $newPassword);
            if(!$resultUpdate) {
                toastMessage('error', 'Thất bại', 'Không thể cập nhật mật khẩu mới');
            }else {
                toastMessage('success', 'Thành công', 'Vui lòng kiểm tra email để nhận mật khẩu mới');
            }
        }else {
            toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu gửi đi');
        }
        redirect('LoginRoute');
    }

    public function showAccountView(){view('User/UserPages/Account/AccountView');}

    public function showChangePasswordView()
    {
        if($_SESSION['userInfo'][0]['provider'] === null) {
            view('User/UserPages/Account/ChangePasswordView');
        }else {
            toastMessage('info', 'Thông báo', 'Tài khoản của bạn không được đăng ký đăng nhập bằng mật khẩu');
            redirect('AccountRoute');
        }
    }

    public function handleChangePassword()
    {
        if(isset($_POST['SubmitChangePassword']) && ($_POST['SubmitChangePassword'])) {
            $validatedInfo = $this->validateDataFormChangePassword($_POST);
            if(!$validatedInfo) redirect('ChangePasswordRoute');

            $resultUpdateNewPassword = $this->Database->updateNewPassword($_SESSION['userInfo'][0]['email'], $validatedInfo['newPassword']);
            if(!$resultUpdateNewPassword) {
                toastMessage('error', 'Thất bại', 'Đổi mật khẩu thất bại');
            }else {
                toastMessage('success', 'Thành công', 'Đổi mật khẩu thành công');
            }
            redirect('ChangePasswordRoute');
        }else {
            toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu gửi đi');
        }
        redirect('ChangePasswordRoute');
    }

    private function validateDataFormChangePassword($info)
    {   
        $validatedInfo = [];
        $errors = [];
        
        // Validate old password field
        if (!isset($info['oldPassword']) || empty($info['oldPassword'])) {
            $errors[] = 'Mật khẩu hiện tại không được để trống';
        } else {
            $validatedInfo['oldPassword'] = $info['oldPassword'];
        }
        
        // Validate new password field
        if (!isset($info['newPassword']) || empty($info['newPassword'])) {
            $errors[] = 'Mật khẩu mới không được để trống';
        } else {
            if (strlen($info['newPassword']) < 8 || strlen($info['newPassword']) > 50) {
                $errors[] = 'Mật khẩu phải có độ dài từ 8 đến 50 ký tự';
            }
            if (!preg_match('/[a-z]/', $info['newPassword'])) {
                $errors[] = 'Mật khẩu phải chứa ít nhất 1 ký tự chữ thường';
            }
            if (!preg_match('/[A-Z]/', $info['newPassword'])) {
                $errors[] = 'Mật khẩu phải chứa ít nhất 1 ký tự chữ hoa';
            }
            if (!preg_match('/\d/', $info['newPassword'])) {
                $errors[] = 'Mật khẩu phải chứa ít nhất 1 ký tự số';
            }
            if (empty($errors)) {
                $validatedInfo['newPassword'] = $info['newPassword'];
            }
        }
        
        // Validate confirm password
        if (!isset($info['confirmPassword']) || empty($info['confirmPassword'])) {
            $errors[] = 'Xác nhận mật khẩu không được để trống';
        } else if (isset($info['newPassword']) && $info['confirmPassword'] !== $info['newPassword']) {
            $errors[] = 'Xác nhận mật khẩu không khớp với mật khẩu mới';
        } else {
            $validatedInfo['confirmPassword'] = $info['confirmPassword'];
        }
        
        // Check if user exists and old password is correct
        if (empty($errors) && isset($validatedInfo['oldPassword'])) {
            $userId = $_SESSION['userInfo'][0]['userId'];
            if (!$this->verifyUserPassword($userId, $validatedInfo['oldPassword'])) {
                $errors[] = 'Mật khẩu hiện tại không chính xác';
            }
        }
        
        // Handle errors
        if (!empty($errors)) {
            foreach ($errors as $error) {
                toastMessage('error', 'Lỗi đổi mật khẩu', $error);
            }
            redirect('ChangePasswordRoute');
            exit();
        }
        
        return $validatedInfo;
    }

    private function verifyUserPassword($userId, $password)
    {
        $user = $this->Database->findUserById($userId);
        if (!$user) {
            return false;
        }
        
        return password_verify($password, $user[0]['password']);
    }

    public function updateUserInfo()
    {
        if(isset($_POST['SubmitUpdateUserInfo']) && ($_POST['SubmitUpdateUserInfo'])) {
            $fullName = $_POST['fullName'];
            $email = $_SESSION['userInfo'][0]['email'];
            $gender = $_POST['gender'];
            $birthDate = $_POST['birthDate'];
            $phoneNumber = $_POST['phoneNumber'];
            $address = $_POST['address'];

            $resultUpdate = $this->Database->updateUserInfo($email, $fullName, $gender, $birthDate, $phoneNumber, $address);
            if(!$resultUpdate) toastMessage('error', 'Thất bại', 'Cập nhật thông tin tài khoản thất bại');
            else {
                AuthService::updateUserSessionInfo();
                toastMessage('success', 'Thành công', 'Cập nhật thông tin tài khoản thành công');
            }
            redirect('AccountRoute');
        }else {
            abort();
        }
    }

    private function generateNewPassword()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $password = '';

        for ($i = 0; $i < 10; $i++) {
            $password .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $password;
    }

    private function sendNewPasswordToEmail($email, $newPassword)
    {
        if (!$email) {
            toastMessage('error', 'Lỗi!', 'Email không hợp lệ');
            redirect('ContactRoute');
            return;
        }

        $subject = "Mật khẩu mới của bạn - Samsonitu Shoes";
        
        $emailContent = "
            <p>Chào bạn,</p>
            <p>Bạn đã yêu cầu đặt lại mật khẩu. Dưới đây là mật khẩu mới của bạn:</p>
            <p><strong>Mật khẩu mới:</strong> <span style='color:blue;'>{$newPassword}</span></p>
            <p>Vui lòng đăng nhập và đổi mật khẩu ngay để bảo mật tài khoản.</p>
            <p>Trân trọng,</p>
            <p><strong>Samsonitu Shoes</strong></p>
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
            $mail->addAddress($email); // Gửi đến email của người dùng
            $mail->Subject = $subject;
            $mail->isHTML(true);
            $mail->Body = $emailContent;

            if ($mail->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
            toastMessage('error', 'Lỗi!', 'Lỗi gửi email: ' . $mail->ErrorInfo);
        }
    }

}
