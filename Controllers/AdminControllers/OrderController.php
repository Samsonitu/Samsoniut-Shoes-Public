<?php

namespace Controllers\AdminControllers;

use Core\BaseController;
class OrderController extends BaseController {
    protected $Model = "AdminModels\OrderModel";
    
    public function showOrderView() 
    {
        $orderList = $this->Database->getOrderByStatus(1);
        view('Admin/AdminPages/Order/OrderView', compact('orderList'));
    }

    public function getOrderByStatus($status)
    {
        header('Content-Type: application/json');

        if (empty($status)) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid color code'
            ]);
            exit;
        }
 
        $orderList = $this->Database->getOrderByStatus($status);
        echo json_encode([
            'success' => true,
            'orderList' => $orderList
        ]);
        exit;
    }

    public function updateOrder()
    {
        if(isset($_POST['SubmitUpdateOrder']) && ($_POST['SubmitUpdateOrder'])) {
            $note = $_POST['orderNote'];
            $orderCode = $_POST['orderCode'];
            $orderStatus = $_POST['orderStatusUpdate'];
            $resultUpdate = $this->Database->updateOrder($orderCode, $orderStatus, $note);
            if(!$resultUpdate) {
                toastMessage('error', 'Thất bại', 'Cập nhật thông tin cho đơn hàng thất bại');
            }else {
                toastMessage('success', 'Thành công', 'Cập nhật thông tin cho đơn hàng thành công');
            }
        }else {
            toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu gửi đi');
        }
        redirect('AdminOrderRoute');
    }

    public function updateStatusOrder()
    {
        
    }
}