<?php

namespace Controllers\UserControllers;

use Core\BaseController;
use Google\Service\CloudDeploy\Predeploy;
use services\AuthService;

class OrderController extends BaseController
{
    protected $Model = "UserModels\OrderModel";
    /* BEGIN CART */
        public function showCartView() 
        {   
            $userId = $_SESSION['userInfo'][0]['userId'];
            if(!$userId) redirect('LoginRoute');
            $orderPendingForPayList = $this->Database->getAllOrderPendingForPay($userId);
            view('User/UserPages/Order/CartView', compact('orderPendingForPayList'));
        }

        public function updateOrderQuantity() {
            if(isset($_POST['SubmitUpdateOrderQuantity']) && ($_POST['SubmitUpdateOrderQuantity'])) {
                $orderCode = $_POST['orderCodeUpdate'];
                $orderQuantity = $_POST['orderQuantityUpdate'];
                $userId = $_SESSION['userInfo'][0]['userId'];
                $resultUpdate = $this->Database->updateOrderQuantity($userId, $orderCode, $orderQuantity);
                if(!$resultUpdate) {
                    toastMessage('warning', 'Thất bại', 'Cập nhật số lượng đơn hàng thất bại');
                }else {
                    toastMessage('success', 'Thành công', 'Cập nhật số lượng đơn hàng thành công');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra lại biểu mẫu gửi đi');
            }
            redirect('CartRoute');
        }

        public function removeOrder() {
            if(isset($_POST['SubmitRemoveOrder']) && ($_POST['SubmitRemoveOrder'])) {
                $orderCode = $_POST['orderCodeDelete'];
                $userId = $_SESSION['userInfo'][0]['userId'];
                $resultDelete = $this->Database->deleteOrder($userId, $orderCode);
                if(!$resultDelete) {
                    toastMessage('warning', 'Thất bại', 'Xóa đơn hàng thất bại');
                }else {
                    toastMessage('success', 'Thành công', 'Xóa đơn hàng thành công');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra lại biểu mẫu gửi đi');
            }
            redirect('CartRoute');
        }

    /* END CART */

    /* BEGIN ORDER */
        public function showOrderFastForm()
        {
            if(isset($_POST['SubmitOrderFast']) && ($_POST['SubmitOrderFast'])) {
                $userId = $_SESSION['userInfo'][0]['userId'];
                $validatedRequest = $this->validateOrderFastForm($_POST); 
                if(!$validatedRequest) redirect('ProductRoute');

                $hasInStock = $this->Database->checkOrderHasInStock($validatedRequest);
                if(!$hasInStock || $hasInStock[0]['quantity'] === 0) {
                    toastMessage('error', 'Thất bại', 'Sản phẩm này đã hết hàng');
                    redirect('ProductDetailsRoute', ['proSlug' => $hasInStock[0]['proSlug']]);
                }
                
                $orderQuantity = $validatedRequest['orderQuantity'];
                if($orderQuantity > $hasInStock[0]['quantity']) {
                    toastMessage('info', '', 'Số lượng sản phẩm trong kho chi còn ' . $hasInStock[0]['quantity'] . ' sản phẩm');
                    redirect('ProductDetailsRoute', ['proSlug' => $hasInStock[0]['proSlug']]);
                }

                $proPendingOrderInfo = $this->Database->getProductInfoByMainKeyValues($validatedRequest, $orderQuantity);
                view('User/UserPages/Order/OrderFastView', compact('proPendingOrderInfo', 'orderQuantity'));
            }else {
                toastMessage('warning', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
                redirect('ProductRoute');
            }
        }

        public function orderFast()
        {
            if(isset($_POST['SubmitConfirmOrderFast']) && ($_POST['SubmitConfirmOrderFast'])) {
                $userId = $_SESSION['userInfo'][0]['userId'];
                $proId = $_POST['confirmOrderProId'];
                $varId = $_POST['confirmOrderVarId'];
                $orderQuantity = $_POST['confirmOrderQuantity'];
                $unitPrice = $_POST['unitPrice'];
                $totalOrder = $_POST['totalOrder'];
                $resultOrderFast = $this->Database->orderFast($userId, $proId, $varId, $orderQuantity, 'cod', $unitPrice, $totalOrder);
                if(!$resultOrderFast) {
                    toastMessage('error', 'Thất bại', 'Đặt hàng thất bại, vui lòng thử lại sau');
                }else {
                    AuthService::updateUserSessionInfo();
                    toastMessage('success', 'Thành công', 'Đặt hàng thành công, cảm mơn bạn đã ủng hộ shop');
                    redirect('OrderedRoute');
                } 
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra lại biểu mẫu gửi đi');
            }
            redirect('ProductRoute');
        }

        private function validateOrderFastForm($request)
        {
            $requiredFields = [
                'Mã sản phẩm' => 'orderProId', 
                'Mã màu biến thể' => 'orderColorCode',
                'Kích cỡ' => 'orderSize',
                'Số lượng' => 'orderQuantity',
            ];

            // Kiểm tra các trường bắt buộc
            foreach ($requiredFields as $requestFiledLabels => $requestFiled) {
                if (empty($request[$requestFiled] ?? '')) {
                    toastMessage('error', 'Lỗi', "$requestFiledLabels không được để trống");
                    return false;
                }
            }

            return $request;
        }

        public function showOrderNormalForm()
        {
            if(isset($_POST['orderCodes']) && ($_POST['orderCodes'])) {
                $orderCodes = $_POST['orderCodes'];
                if(empty(array_filter($orderCodes))) {
                    toastMessage('warning', 'Thất bại', 'Không có đơn hàng nào được chọn để tiến hành đặt hàng');
                    redirect('CartRoute');
                }
                $userId = $_SESSION['userInfo'][0]['userId'];
                $proPendingOrderInfo = $this->Database->getProductInfoByOrderCodes($userId, $orderCodes);
                if(!$proPendingOrderInfo) redirect('CartRoute');
                view('User/UserPages/Order/OrderNormalView', compact('proPendingOrderInfo'));
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
                redirect('ProductRoute');
            }
        }

        public function orderNormal() 
        {
            if(isset($_POST['SubmitOrderNormal']) && ($_POST['SubmitOrderNormal'])) {
                $orderCodes = $_POST['orderCodes'];
                $userId = $_SESSION['userInfo'][0]['userId'];
                $resultOrderNormal = $this->Database->orderNormal($userId, $orderCodes);
                if(!$resultOrderNormal) {
                    toastMessage('error', 'Thất bại', 'Đặt hàng thất bại, vui lòng thử lại sau');
                    redirect('CartRoute');
                }else {
                    AuthService::updateUserSessionInfo();
                    toastMessage('success', 'Thành công', 'Đặt hàng thành công, cảm mơn bạn đã ủng hộ shop');
                    redirect('OrderedRoute');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra lại biểu mẫu được gửi đi');
                redirect('CartRoute');
            }
        }

        public function addProVarToCart($proId, $varId, $quantity)
        {
            header('Content-Type: application/json');

            if (!isset($_SESSION['userInfo'])) {
                echo json_encode([
                    'success' => false,
                    'redirect' => 'dang-nhap',
                    'message' => 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng'
                ]);
                exit;
            }

            if (empty($proId) || empty($varId) || empty($quantity)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Không thể thêm sản phẩm vào giỏ hàng'
                ]);
                exit;
            }

            $userId = $_SESSION['userInfo'][0]['userId'];
            $resultAdd = $this->Database->addProVarToCart($userId, $proId, $varId, $quantity);
            AuthService::updateUserSessionInfo();

            if (!$resultAdd) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Thêm sản phẩm vào giỏ hàng thất bại'
                ]);
            } else {
                echo json_encode([
                    'success' => true,
                    'totalProInCart' => $_SESSION['userInfo'][0]['totalProInCart'],
                    'message' => 'Thêm sản phẩm vào giỏ hàng thành công'
                ]);
            }
            exit;
        }

        public function showOrderedView()
        {
            $orderedList = $this->Database->getAllOrdered($_SESSION['userInfo'][0]['userId']);
            view('User/UserPages/Order/OrderedView', compact('orderedList'));
        }
    /* END ORDER */
}