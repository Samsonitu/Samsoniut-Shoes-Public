<?php

namespace Controllers;

use services\AuthService;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Google\Client as Google_Client;
use Google\Service\Oauth2 as Google_Service_Oauth2;
class AuthController  {
    /* Begin Socials Setup */
        private $google_client;
        public function __construct() {
            $this->google_client = new Google_Client();
            $this->google_client->setClientId('Your client id');
            $this->google_client->setClientSecret('Your client Secret');
            $this->google_client->setRedirectUri('http://localhost:3000/auth/google/callback');
            $this->google_client->addScope("email");
            $this->google_client->addScope("profile");
        }
        public function googleCallback()
        {
            if (isset($_GET['code'])) {
                try {
                    $token = $this->google_client->fetchAccessTokenWithAuthCode($_GET['code']);
                    if (!isset($token['error'])) {
                        $this->google_client->setAccessToken($token['access_token']);
                        $google_service = new Google_Service_Oauth2($this->google_client);
                        $data = $google_service->userinfo->get();
                        
                        $email = $data['email'] ?? '';
                        
                        $resultLogin = AuthService::loginWithSocial($email, 'google');
                        if($resultLogin && $resultLogin[0]['active'] != 0 && $resultLogin[0]['role'] === 'customer') {
                            toastMessage('success', 'Thành công', 'Đăng nhập thành công. Chào mừng bạn quay trở lại');
                            $_SESSION['userInfo'] = $resultLogin;
                            redirect('HomeRoute');
                        }elseif($resultLogin && $resultLogin[0]['active'] == 0 && $resultLogin[0]['email'] === $email){
                            toastMessage('info', 'Thông báo', 'Bạn cần bổ sung thêm thông tin để hoàn tất việc tạo tài khoản');
                            $_SESSION['userInfoPending'] = $resultLogin;
                            redirect('AdditionalInfoRoute');
                        }else {
                            $isExists = AuthService::checkExistsEmail($email);
                            if($isExists) {
                                toastMessage('warning', 'Thất bại', 'Email đã được đăng ký');
                                redirect('RegisterRoute');
                            }
                            
                            $resultRegister = AuthService::registerWithSocial($email, 'google', $data['id']);
                            if(!$resultRegister) {
                                toastMessage('error', 'Thất bại', 'Đăng ký thất bại với tài khoản google');
                                redirect('RegisterRoute');
                            }

                            toastMessage('info', 'Thông báo', 'Bạn cần bổ sung thêm thông tin để hoàn tất việc tạo tài khoản');
                            $_SESSION['userInfoPending'] = $resultRegister;
                            redirect('AdditionalInfoRoute');
                        }
                    } else {
                        toastMessage('error', 'Thất bại', 'Đăng nhập với tài khoản google thất bại');
                        redirect('LoginRoute');
                    }
                } catch (Exception $e) {
                    toastMessage('error', 'Thấi bại', $e->getMessage());
                    redirect('LoginRoute');
                }
            } else {
                toastMessage('error', 'Thấi bại', 'Không xác nhận được tài khoản google');
                redirect('LoginRoute');
            }
        }
    /* End Socials Setup */

    /* Begin User */
        public function showUserLoginForm() {
            $googleLoginUrl = $this->google_client->createAuthUrl();
            view('User/UserPages/Account/LoginView', ['googleLoginUrl' => $googleLoginUrl]);
        }

        public function showUserRegisterForm() {
            $googleLoginUrl = $this->google_client->createAuthUrl();
            view('User/UserPages/Account/RegisterView' ,['googleLoginUrl' => $googleLoginUrl]);
        }

        public function loginUserNormal() {
            if(isset($_POST['SubmitLogin']) && ($_POST['SubmitLogin'])) {
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';

                $user = AuthService::authenticate($email, $password);

                if($user && $user[0]['active'] === 0) {
                    toastMessage('error', 'Đăng nhập thất bại', 'Tài khoản của bạn đã bị khóa');
                    redirect('LoginRoute');
                }

                if($user && $user[0]['role'] === 'customer') {
                    $_SESSION['userInfo'] = $user;
                    toastMessage('success', 'Đăng nhập thành công', 'Chào mừng bạn quay trở lại');
                    redirect('HomeRoute');
                } else {
                    toastMessage('error', 'Đăng nhập thất bại', 'Tài khoản hoặc mật khẩu không tồn tại');
                    redirect('LoginRoute');
                }
            }else { abort(); }
        }

        public function registerUser()
        {
            if(isset($_POST['SubmitRegister']) && ($_POST['SubmitRegister'])) {
                $validatedRegisterInfo = $this->validateRegisterForm($_POST);
                $email = $validatedRegisterInfo['email'];
                $fullName = $validatedRegisterInfo['fullName'];

                $isExists = AuthService::checkExistsEmail($email);
                if($isExists) {
                    toastMessage('warning', 'Thất bại', 'Email đã được đăng ký');
                    redirect('RegisterRoute');
                }

                $verificationCode = $this->sendEmailToConfirmRegister($email, $fullName);
                if (!$verificationCode) {
                    toastMessage('warning', 'Thất bại', 'Gửi mã xác thực đến email của bạn thất bại');
                    redirect('RegisterRoute');
                }

                $insertSuccess = AuthService::saveVerificationCode($email, $verificationCode, 'register');
                if (!$insertSuccess) {
                    toastMessage('error', 'Thất bại', 'Không thể lưu mã xác nhận, vui lòng thử lại.');
                    redirect('RegisterRoute');
                }

                $_SESSION['validatedRegisterInfo'] = $validatedRegisterInfo;
                redirect('ConfirmRegisterRoute');
            }else {
                toastMessage('warning', 'Lỗi Rồi', 'Kiểm tra biểu mẫu được gửi đi');
                redirect('RegisterRoute');            
            }
        }

        public function resendVerificationCode()
        {
            if(isset($_SESSION['validatedRegisterInfo']) && !empty($_SESSION['validatedRegisterInfo'])) {
                $email = $_SESSION['validatedRegisterInfo']['email'];
                $fullName = $_SESSION['validatedRegisterInfo']['fullName'];
                $verificationCode = $this->sendEmailToConfirmRegister($email, $fullName);
                if (!$verificationCode) {
                    toastMessage('warning', 'Thất bại', 'Gửi mã xác thực đến email của bạn thất bại');
                    redirect('RegisterRoute');
                }

                $insertSuccess = AuthService::saveVerificationCode($email, $verificationCode, 'register');
                if (!$insertSuccess) {
                    toastMessage('error', 'Thất bại', 'Không thể lưu mã xác nhận, vui lòng thử lại.');
                    redirect('RegisterRoute');
                }

                toastMessage('info', 'Thông báo', 'Mã xác nhận tài khoản đã được gửi lại qua email');
                redirect('ConfirmRegisterRoute');
            } else {
                abort();
            }
        }

        public function showUserConfirmRegisterForm() 
        { 
            if(isset($_SESSION['validatedRegisterInfo']) && !empty($_SESSION['validatedRegisterInfo'])) {
                view('User/UserPages/Account/ConfirmRegisterView'); 
            }else {
                abort();
            }
        }

        public function confirmRegister()
        {
            if(isset($_POST['SubmitConfirmRegister']) && ($_POST['SubmitConfirmRegister'])) {
                $verificationCode = $_POST['verificationCode'] ?? '';
                $isValid = AuthService::checkVerificationCode($_SESSION['validatedRegisterInfo']['email'], $verificationCode, 'register');
                if(!$isValid) {
                    toastMessage('error', 'Thất bại', 'Mã xác nhận không trùng khớp, vui lòng kiểm tra lại');
                    redirect('ConfirmRegisterRoute');
                }else {
                    $newUser = AuthService::createNewUserByNormal($_SESSION['validatedRegisterInfo']);
                    if(!$newUser) {
                        toastMessage('error', 'Thất bại', 'Tạo tài khoản thất bại');
                        redirect('RegisterRoute');
                    }else {
                        $_SESSION['validatedRegisterInfo'] = null;
                        $_SESSION['userInfo'] = $newUser;
                        toastMessage('success', 'Thành công', 'Tạo tài khoản thành công, chào mừng bạn đến với Samsonitu Shoes');
                        redirect('HomeRoute');
                    }
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
                redirect('ConfirmRegisterRoute');
            }
        }

        private function validateRegisterForm($registerInfo)
        {
            $validatedRegisterInfo = [];

            $requiredFields = [
                'Họ và tên' => 'fullName', 
                'Giới tính' => 'gender', 
                'Địa chỉ email' => 'email',
                'Mật khẩu' => 'password',
                'Ngày sinh' => 'birthDate',
                'Số điện thoại' => 'phoneNumber',
                'Địa chỉ' => 'address',
            ];

            // Kiểm tra các trường bắt buộc
            foreach ($requiredFields as $registerFormFiledLabels => $registerFormField) {
                if (empty($registerInfo[$registerFormField] ?? '')) {
                    toastMessage('error', 'Lỗi', "$registerFormFiledLabels không được để trống");
                    return false;
                }
            }

            // Kiểm tra ký tự đầu tiên của họ tên
            if (isset($registerInfo['fullName']) && substr($registerInfo['fullName'], 0, 1) === ' ') {
                toastMessage('error', 'Lỗi', "Họ và tên không được bắt đầu bằng khoảng trắng");
                return false;
            }

            // Kiểm tra ký tự đầu tiên của địa chỉ
            if (isset($registerInfo['address']) && substr($registerInfo['address'], 0, 1) === ' ') {
                toastMessage('error', 'Lỗi', "Địa chỉ không được bắt đầu bằng khoảng trắng");
                return false;
            }

            // Kiểm tra độ dài họ tên tối thiểu
            if (isset($registerInfo['fullName']) && strlen(trim($registerInfo['fullName'])) < 3) {
                toastMessage('error', 'Lỗi', "Họ và tên phải có ít nhất 3 ký tự");
                return false;
            }

            // Kiểm tra định dạng email
            if (isset($registerInfo['email']) && !filter_var($registerInfo['email'], FILTER_VALIDATE_EMAIL)) {
                toastMessage('error', 'Lỗi', "Địa chỉ email không hợp lệ");
                return false;
            }

            // Kiểm tra độ mạnh của mật khẩu
            if (isset($registerInfo['password'])) {
                $password = $registerInfo['password'];
                if (strlen($password) < 8 ||
                    !preg_match('/[A-Z]/', $password) ||
                    !preg_match('/[a-z]/', $password) ||
                    !preg_match('/[0-9]/', $password)) {
                    toastMessage('error', 'Lỗi', "Mật khẩu phải có ít nhất 8 ký tự, chứa chữ hoa, chữ thường và số");
                    return false;
                }
            }

            // Kiểm tra định dạng số điện thoại
            if (isset($registerInfo['phoneNumber']) && !preg_match('/^[0-9]{10,11}$/', $registerInfo['phoneNumber'])) {
                toastMessage('error', 'Lỗi', "Số điện thoại không hợp lệ");
                return false;
            }

            // Nếu tất cả kiểm tra đều thành công
            $validatedRegisterInfo = [
                'fullName' => trim($registerInfo['fullName']),
                'gender' => $registerInfo['gender'],
                'email' => trim($registerInfo['email']),
                'password' => $registerInfo['password'],
                'birthDate' => $registerInfo['birthDate'],
                'phoneNumber' => $registerInfo['phoneNumber'],
                'address' => trim($registerInfo['address']),
            ];

            return $validatedRegisterInfo;
        }

        private function sendEmailToConfirmRegister($email, $fullName)
        {
            if (empty($email) || empty($fullName)) {
                return false;
            }
    
            $verificationCode = rand(10000, 99999); 
    
            // Nội dung email
            $subject = "Mã xác nhận của bạn từ Samsonitu Shoes";
            $message = "
                <p>Chào <strong>$fullName</strong>,</p>
                <p>Cảm ơn bạn đã đăng ký tài khoản tại <strong>Samsonitu Shoes</strong>!</p>
                <p>Để hoàn tất quy trình đăng ký và xác minh tài khoản, vui lòng sử dụng mã xác nhận dưới đây:</p>
                <h2 style='color:blue;'>$verificationCode</h2>
                <p>Hãy nhập mã này vào ô yêu cầu trên trang web của chúng tôi.</p>
                <p>Nếu có vấn đề, vui lòng liên hệ qua: <strong>0123456789</strong></p>
                <p>Trân trọng,<br>Đội ngũ Hỗ trợ Khách hàng<br>Samsonitu Shoes</p>
            ";
    
            $mail = new PHPMailer(true);    
    
            try {
                // Cấu hình SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = ''; 
                $mail->Password = '';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
    
                // Thiết lập email
                $mail->CharSet = 'UTF-8';
                $mail->setFrom('', 'Samsonitu Shoes');
                $mail->addAddress($email);
                $mail->Subject = $subject;
                $mail->isHTML(true);
                $mail->Body = $message;
    
                $mail->send();
                return $verificationCode;
            } catch (Exception $e) {
                error_log("Lỗi gửi email: " . $mail->ErrorInfo);
                return false;
            }
        }

        public function showAdditionalInfoForm() 
        {
            if(isset($_SESSION['userInfoPending']) && !empty($_SESSION['userInfoPending'])) {
                $email = $_SESSION['userInfoPending'][0]['email'];
                $provider = $_SESSION['userInfoPending'][0]['provider'];
                view('User/UserPages/Account/AdditionalInfoView', compact('email', 'provider'));
            }else {
                abort();
            } 
        }

        public function handleAdditionalInfo()
        {
            if(isset($_POST['SubmitAdditionalInfo']) && ($_POST['SubmitAdditionalInfo'])) {
                $validatedAdditionalInfo = $this->validatedAdditionalInfoForm($_POST);
                if(!$validatedAdditionalInfo) redirect('AdditionalInfoRoute');

                $userId = $_SESSION['userInfoPending'][0]['userId'];
                $email = $_SESSION['userInfoPending'][0]['email'];
                $provider = $_SESSION['userInfoPending'][0]['provider'];
                $resultAdditionalInfo = AuthService::additionalInfo($validatedAdditionalInfo, $userId, $email, $provider);
                if(!$resultAdditionalInfo) {
                    toastMessage('error', 'Thất bại', 'Bổ sung thông tin thất bại');
                    redirect('AdditionalInfoRoute');
                }else {
                    toastMessage('success', 'Thành công', 'Đăng ký thành công với tài khoản google');
                    $_SESSION['userInfoPending'] = null;
                    $_SESSION['userInfo'] = $resultAdditionalInfo;
                    redirect('HomeRoute');
                }
            }else {
                abort();
            }
        }

        private function validatedAdditionalInfoForm($additionalInfo) 
        {
            $validatedAdditionalInfo = [];

            $requiredFields = [
                'Họ và tên' => 'fullName', 
                'Giới tính' => 'gender', 
                'Ngày sinh' => 'birthDate',
                'Số điện thoại' => 'phoneNumber',
                'Địa chỉ' => 'address',
            ];

            // Kiểm tra các trường bắt buộc
            foreach ($requiredFields as $additionalInfoFormFiledLabels => $additionalInfoFormFiled) {
                if (empty($additionalInfo[$additionalInfoFormFiled] ?? '')) {
                    toastMessage('error', 'Lỗi', "$additionalInfoFormFiledLabels không được để trống");
                    return false;
                }
            }

            // Kiểm tra ký tự đầu tiên của họ tên
            if (isset($additionalInfo['fullName']) && substr($additionalInfo['fullName'], 0, 1) === ' ') {
                toastMessage('error', 'Lỗi', "Họ và tên không được bắt đầu bằng khoảng trắng");
                return false;
            }

            // Kiểm tra ký tự đầu tiên của địa chỉ
            if (isset($additionalInfo['address']) && substr($additionalInfo['address'], 0, 1) === ' ') {
                toastMessage('error', 'Lỗi', "Địa chỉ không được bắt đầu bằng khoảng trắng");
                return false;
            }

            // Kiểm tra độ dài họ tên tối thiểu
            if (isset($additionalInfo['fullName']) && strlen(trim($additionalInfo['fullName'])) < 3) {
                toastMessage('error', 'Lỗi', "Họ và tên phải có ít nhất 3 ký tự");
                return false;
            }

            // Kiểm tra định dạng số điện thoại
            if (isset($additionalInfo['phoneNumber']) && !preg_match('/^[0-9]{10,11}$/', $additionalInfo['phoneNumber'])) {
                toastMessage('error', 'Lỗi', "Số điện thoại không hợp lệ");
                return false;
            }

            // Nếu tất cả kiểm tra đều thành công
            $validatedAdditionalInfo = [
                'fullName' => trim($additionalInfo['fullName']),
                'gender' => $additionalInfo['gender'],
                'birthDate' => $additionalInfo['birthDate'],
                'phoneNumber' => $additionalInfo['phoneNumber'],
                'address' => trim($additionalInfo['address']),
            ];

            return $validatedAdditionalInfo;
        }
    /* End User */

    /* Begin Admin */
        public function showAdminLoginForm () {view('Admin/AdminPages/LoginView');}
        public function loginAdmin () 
        {
            if(isset($_POST['SubmitAdminLogin']) && ($_POST['SubmitAdminLogin'])) {
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';

                $user = AuthService::authenticate($email, $password);

                if($user && $user[0]['active'] === 0) {
                    toastMessage('error', 'Đăng nhập thất bại', 'Tài khoản của bạn đã bị khóa');
                    redirect('AdminLoginRoute');
                }

                if($user && $user[0]['role'] === 'admin') {
                    $_SESSION['adminInfo'] = $user;
                    toastMessage('success', 'Đăng nhập thành công', 'Chào mừng bạn quay trở lại');
                    redirect('AdminRoute');
                } else {
                    toastMessage('error', 'Đăng nhập thất bại', 'Tài khoản hoặc mật khẩu không tồn tại');
                    redirect('AdminLoginRoute');
                }
            }else { abort(); }
        }
    /* End Admin */

    /* Begin Common */
        public function logout ()
        {
            if(isset($_SESSION['adminInfo'])) {
                unset($_SESSION);
                session_destroy();
                redirect('AdminLoginRoute');
            }else {
                unset($_SESSION);
                session_destroy();
                redirect('HomeRoute');
            }
        }
    /* End Common */
}