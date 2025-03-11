<?php

namespace Controllers\AdminControllers;

use \Core\BaseController;
use DateTime;
class AccountController extends BaseController {
    protected $Model = "AdminModels\AccountModel";
    public function showAccountView() 
    {
        $accountList = $this->Database->getAllAccount();
        view('Admin/AdminPages/Account/AccountView', compact('accountList'));
    }

    public function createAccount() 
    {
        if(isset($_POST['SubmitCreateAccount']) && ($_POST['SubmitCreateAccount'])) {
            $accountInfo = $this->validateFormDataCreateAccount($_POST);
            $isExists = $this->Database->checkExistsEmail($accountInfo['emailCreate']);
            if($isExists) {
                toastMessage('error', 'Thất bại', 'Tạo tài khoản thất bại, email này đã tồn tại');
                redirect('AdminAccountRoute');
            }
            $resultCreate = $this->Database->createAccount($accountInfo);
            if(!$resultCreate) {
                toastMessage('error', 'Thất bại', 'Tạo tài khoản mới thất bại');
            }else {
                toastMessage('success', 'Thành công', 'Tạo tài khoản mới thành công');
            }
        }else {
            toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
        }
        redirect('AdminAccountRoute');
    }

    private function validateFormDataCreateAccount($data)
    {
        $errors = [];

        // Kiểm tra họ và tên
        if (empty($data['fullNameCreate'])) {
            $errors[] = 'Họ và tên không được để trống.';
        }

        // Kiểm tra email hợp lệ
        if (!filter_var($data['emailCreate'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email không hợp lệ.';
        }

        // Kiểm tra số điện thoại (chỉ chứa số và có độ dài hợp lý)
        if (!preg_match('/^[0-9]{10,11}$/', $data['phoneNumberCreate'])) {
            $errors[] = 'Số điện thoại không hợp lệ.';
        }

        // Kiểm tra địa chỉ
        if (empty($data['addressCreate'])) {
            $errors[] = 'Địa chỉ không được để trống.';
        }

        // Kiểm tra giới tính hợp lệ
        $validGenders = ['male', 'female', 'unisex'];
        if (!in_array($data['genderCreate'], $validGenders)) {
            $errors[] = 'Giới tính không hợp lệ.';
        }

        // Kiểm tra ngày sinh
        if (!empty($data['dobCreate'])) {
            $dob = DateTime::createFromFormat('Y-m-d', $data['dobCreate']);
            $today = new DateTime();
            $age = $today->diff($dob)->y;

            if (!$dob) {
                $errors[] = 'Định dạng ngày sinh không hợp lệ.';
            } elseif ($dob > $today) {
                $errors[] = 'Ngày sinh không được lớn hơn ngày hiện tại.';
            } elseif ($age < 5) {
                $errors[] = 'Tuổi phải từ 5 trở lên.';
            }
        } else {
            $errors[] = 'Ngày sinh không được để trống.';
        }

        // Kiểm tra vai trò hợp lệ
        $validRoles = ['customer', 'admin'];
        if (!in_array($data['roleCreate'], $validRoles)) {
            $errors[] = 'Vai trò không hợp lệ.';
        }

        // Kiểm tra mật khẩu (ít nhất 8 ký tự, có chữ hoa, chữ thường, số)
        if (
            strlen($data['passwordCreate']) < 8 ||
            !preg_match('/[A-Z]/', $data['passwordCreate']) ||
            !preg_match('/[a-z]/', $data['passwordCreate']) ||
            !preg_match('/[0-9]/', $data['passwordCreate'])
        ) {
            $errors[] = 'Mật khẩu phải có ít nhất 8 ký tự, chứa chữ hoa, chữ thường và số.';
        }

        // Kiểm tra xác nhận mật khẩu
        if ($data['passwordCreate'] !== $data['confirmPasswordCreate']) {
            $errors[] = 'Xác nhận mật khẩu không khớp.';
        }

        // Nếu có lỗi, hiển thị thông báo và quay lại form
        if (!empty($errors)) {
            foreach ($errors as $error) {
                toastMessage('error', 'Lỗi', $error);
            }
            redirect('AdminAccountRoute');
        }

        // Mã hóa mật khẩu trước khi lưu
        $data['passwordCreate'] = password_hash($data['passwordCreate'], PASSWORD_DEFAULT);

        return $data;
    }

    public function updateAccount()
    {
        if(isset($_POST['SubmitUpdateAccount']) && ($_POST['SubmitUpdateAccount'])) {
            $accountInfo = $this->validateFormUpdateAccount($_POST);
            $resultUpdate = $this->Database->updateAccount($accountInfo);
            if(!$resultUpdate) {
                toastMessage('error', 'Thất bại', 'Cập nhật tài khoản thất bại');
            }else {
                toastMessage('success', 'Thành công', 'Cập nhật tài khoản thành công');
            }
        }else {
            toastMessage('error', 'Lỗi Rồi', 'Kiểm tra biểu mẫu gửi đi');
        }
        redirect('AdminAccountRoute');
    }

    private function validateFormUpdateAccount($data)
    {
        $errors = [];

        // Kiểm tra mã tài khoản
        if (empty($data['userIdUpdate'])) {
            $errors[] = 'Không tìm thấy mã tài khoản';
        } 

        // Kiểm tra họ và tên
        if (empty($data['fullNameUpdate'])) {
            $errors[] = 'Họ và tên không được để trống.';
        }

        // Kiểm tra số điện thoại (chỉ chứa số và có độ dài hợp lý)
        if (!preg_match('/^[0-9]{10,11}$/', $data['phoneNumberUpdate'])) {
            $errors[] = 'Số điện thoại không hợp lệ.';
        }

        // Kiểm tra địa chỉ
        if (empty($data['addressUpdate'])) {
            $errors[] = 'Địa chỉ không được để trống.';
        }

        // Kiểm tra giới tính hợp lệ
        $validGenders = ['male', 'female', 'unisex'];
        if (!in_array($data['genderUpdate'], $validGenders)) {
            $errors[] = 'Giới tính không hợp lệ.';
        }

        // Kiểm tra ngày sinh
        if (!empty($data['dobUpdate'])) {
            $dob = DateTime::createFromFormat('Y-m-d', $data['dobUpdate']);
            $today = new DateTime();
            $age = $today->diff($dob)->y;

            if (!$dob) {
                $errors[] = 'Định dạng ngày sinh không hợp lệ.';
            } elseif ($dob > $today) {
                $errors[] = 'Ngày sinh không được lớn hơn ngày hiện tại.';
            } elseif ($age < 5) {
                $errors[] = 'Tuổi phải từ 5 trở lên.';
            }
        } else {
            $errors[] = 'Ngày sinh không được để trống.';
        }

        // Kiểm tra vai trò hợp lệ
        $validRoles = ['customer', 'admin'];
        if (!in_array($data['roleUpdate'], $validRoles)) {
            $errors[] = 'Vai trò không hợp lệ.';
        }

        // Kiểm tra mật khẩu nếu tài khoản nhập mật khẩu mới
        if (!empty($data['passwordUpdate']) || !empty($data['confirmPasswordUpdate'])) {
            $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';

            if (!preg_match($passwordPattern, $data['passwordUpdate'])) {
                $errors[] = "Mật khẩu mới phải có ít nhất 8 ký tự, chứa chữ hoa, chữ thường và số.";
            }

            if ($data['passwordNewUpdate'] !== $data['confirmPasswordNewUpdate']) {
                $errors[] = "Mật khẩu xác nhận không khớp.";
            }
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                toastMessage('warning', 'Cảnh báo', $error);
            }
            return false;
        }

        return $data;
    }

    public function changeActiveAccount()
    {
        if(isset($_POST['SubmitChangeActiveAccount']) && ($_POST['SubmitChangeActiveAccount'])) {
            $userId = $_POST['userIdChangeActive'] ?? '';
            $email = $_POST['emailChangeActive'] ?? '';
            $active = $_POST['changeActive'] ?? '';
            $resultChangeActive = $this->Database->changeActiveAccount($userId, $email,$active);
            if(!$resultChangeActive) {
                toastMessage('error', 'Thất bại', 'Thay đổi trạng thái tài khoản thất bại');
            }else {
                toastMessage('success', 'Thành công', 'Thay đổi trạng thái tài khoản thành công');
            }
        }else {
            toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu gửi đi');
        }
        redirect('AdminAccountRoute');
    }

    public function removeAccount()
    {
        if(isset($_POST['SubmitRemoveAccount']) && ($_POST['SubmitRemoveAccount'])) {
            $userId = $_POST['userIdRemove'] ?? '';
            $email = $_POST['emailRemove'] ?? '';
            $resultDelete = $this->Database->deleteAccount($userId, $email);
            if($resultDelete) {
                toastMessage('success', 'Thành công', 'Xóa tài khoản thành công');
            }
        }else {
            toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu gửi đi');
        }
        redirect('AdminAccountRoute');
    }
}