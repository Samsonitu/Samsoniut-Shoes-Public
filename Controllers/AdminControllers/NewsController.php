<?php

namespace Controllers\AdminControllers;

use \Core\BaseController;

class NewsController extends BaseController
{
    protected $Model = "AdminModels\NewsModel";
    private $TARGET_DIR_NEWS_THUMBNAIL= "./uploads/img/newsThumbnail/";
    
    /* BEGIN NEWS CATEGORY */
        public function showNewsCategoryView()
        {
            $newsCategoryList = $this->Database->getAllNewsCategory();
            $countNewsCatInTrash = $this->Database->countNewsCatInTrash();
            view('Admin/AdminPages/News/NewsCategoryView', compact('newsCategoryList', 'countNewsCatInTrash'));
        }

        public function storeNewsCategory()
        {
            if(isset($_POST['SubmitCreateNewsCategory']) && ($_POST['SubmitCreateNewsCategory']))
            {
                $userId = $_SESSION['adminInfo'][0]['userId'];
                $newsCatName = $_POST['newsCategoryName'];
                $description = $_POST['description'];
                $isExists = $this->Database->checkExistsNewsCategory($newsCatName, $description);
                if($isExists) {
                    toastMessage('error', 'Thất bại', 'Thông tin danh mục tin tức này đã tồn tại');
                    redirect('AdminNewsCategoryRoute');
                }

                $resultCreate = $this->Database->createNewsCategory($userId, $newsCatName, $description);
                if(!$resultCreate) {
                    toastMessage('error', 'Thất bại', 'Tạo thông tin danh mục tin tức mới thất bại');
                }else {
                    toastMessage('success', 'Thành công', 'Tạo thông tin danh mục tin tức mới thành công');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminNewsCategoryRoute');
        }

        public function updateNewsCategory()
        {
            if(isset($_POST['SubmitUpdateNewsCategory']) && ($_POST['SubmitUpdateNewsCategory']))
            {
                $userId = $_SESSION['adminInfo'][0]['userId'];
                $newsCatId = $_POST['newsCatIdUpdate'];
                $newsCatName = $_POST['newsCatNameUpdate'];
                $description = $_POST['descriptionUpdate'];
                $isExists = $this->Database->checkExistsNewsCategory($newsCatName, $description);
                if($isExists) {
                    toastMessage('error', 'Thất bại', 'Thông tin danh mục tin tức này đã tồn tại');
                    redirect('AdminNewsCategoryRoute');
                }
                $resultUpdate = $this->Database->updateNewsCategory($userId, $newsCatId, $newsCatName, $description);
                if(!$resultUpdate) {
                    toastMessage('error', 'Thất bại', 'Cập nhật thông tin danh mục tin tức mới thất bại');
                }else {
                    toastMessage('success', 'Thành công', 'Cập nhật thông tin danh mục tin tức mới thành công');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminNewsCategoryRoute');
        }

        public function tempDeleteNewsCategory()
        {
            if(isset($_POST['SubmitTempDeleteNewsCat']) && ($_POST['SubmitTempDeleteNewsCat']))
            {
                $userId = $_SESSION['adminInfo'][0]['userId'];
                $newCatId = $_POST['newsCatIdTempDelete'];

                $hasTempDelete = $this->Database->checkHasTempDeleteNewCat($newCatId);
                if($hasTempDelete) {
                    toastMessage('error', 'Thất bại', 'Còn tin tức liên kết với danh mục này');
                    redirect('AdminNewsCategoryRoute');
                }

                $resultTempDelete = $this->Database->tempDeleteNewsCategory($userId, $newCatId);   
                if(!$resultTempDelete) {
                    toastMessage('error', 'Thất bại', 'Xóa tạm danh mục tin tức thất bại');
                }

            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminNewsCategoryRoute');
        }

        public function showNewsCatInTrash()
        {
            $newsCatInTrashList = $this->Database->getAllNewsCatInTrash();
            view('Admin/AdminPages/News/NewsCatInTrashView', compact('newsCatInTrashList'));
        }

        public function removeNewsCategory()
        {
            if(isset($_POST['SubmitDeleteNewsCategory']) && ($_POST['SubmitDeleteNewsCategory']))
            {
                $newsCatId = $_POST['newsCatIdDelete'];
                $resultDelete = $this->Database->deleteNewsCategory($newsCatId);
                if(!$resultDelete) {
                    toastMessage('error', 'Thất bại', 'Xóa danh mục tin tức thất bại');
                }else {
                    toastMessage('success', 'Thàn công', 'Xóa danh mục tin tức thành công');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminNewsCatInTrashRoute');
        }

        public function restoreNewsCatInTrash()
        {
            if(isset($_POST['SubmitRestoreNewsCatInTrash']) && ($_POST['SubmitRestoreNewsCatInTrash']))
            {
                $newsCatId = $_POST['newsCatIdRestore'];
                $userId = $_SESSION['adminInfo'][0]['userId'];
                $resultRestore = $this->Database->restoreNewsCatInTrash($userId, $newsCatId);
                if(!$resultRestore) {
                    toastMessage('error', 'Thất bại', 'Khôi phục danh mục tin tức thất bại');
                }else {
                    toastMessage('success', 'Thành công', 'Khôi phục danh mục tin tức thành công');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminNewsCatInTrashRoute');
        }

        public function changeStatusNewsCategory()
        {
            if(isset($_POST['SubmitChangeStatusNewsCategory']) && ($_POST['SubmitChangeStatusNewsCategory']))
            {
                $userId = $_SESSION['adminInfo'][0]['userId'];
                $newsCatId = $_POST['newsCatIdChangingStatus'];
                $resultChangeStatus = $this->Database->changeStatusNewsCategory($userId, $newsCatId);
                if(!$resultChangeStatus) {
                    toastMessage('error', 'Thất bại', 'Thay đổi trạng thái hiển thị danh mục tin tức thành công');
                }else {
                    toastMessage('success', 'Thành công', 'Thay đổi trạng thái hiển thị danh mục tin tức thành công');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminNewsCategoryRoute');
        }

    /* END NEWS CATEGORY */

    /* BEGIN NEWS */
        public function showNewsView()
        {
            $newsList = $this->Database->getAllNews();
            $countNewsInTrash = $this->Database->countNewsInTrash();
            view('Admin/AdminPages/News/NewsView', compact('newsList', 'countNewsInTrash'));
        }

        public function showNewsDetailsView($newsId)
        {
            $newsDetailsInfo = $this->Database->getNewsDetailsInfo($newsId);
            view('Admin/AdminPages/News/NewsDetailsView', compact("newsDetailsInfo"));
        }

        public function showNewsCreateView()
        { 
            $newsCatNameAndIdList = $this->Database->getNewsCatNameAndId();
            view('Admin/AdminPages/News/NewsCreateView', compact('newsCatNameAndIdList')); 
        }

        public function handleCreateNews()
        {
            if(isset($_POST['SubmitHandleCreateNews']) && ($_POST['SubmitHandleCreateNews']))
            {
                $userId = $_SESSION['adminInfo'][0]['userId'];
                $newsCatId = $_POST['newsCatId'];
                $title = $_POST['title'];
                $excerpt = $_POST['excerpt'];
                $content = htmlentities($_POST['content']);

                $newsThumbnailImagePath = $this->uploadNewsThumbnailForCreate($_FILES["thumbnail"], $this->TARGET_DIR_NEWS_THUMBNAIL);
                if (!$newsThumbnailImagePath) {
                    redirect('AdminCreateNewsRoute');
                }

                $isExists = $this->Database->checkExistsNews($title, $excerpt, $newsThumbnailImagePath);
                if($isExists) {
                    toastMessage('error', 'Thất bại', 'Thông tin tin tức này đã tồn tại');
                    redirect('AdminNewsCategoryRoute');
                }

                $resultCreate = $this->Database->createNews($userId, $newsCatId, $title, $excerpt, $content, $newsThumbnailImagePath);
                if(!$resultCreate) {
                    toastMessage('error', 'Thất bại', 'Tạo thông tin tin tức mới thất bại');
                }else {
                    toastMessage('success', 'Thành công', 'Tạo thông tin tin tức mới thành công');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminNewsRoute');
        }

        private function uploadNewsThumbnailForCreate($file, $target_dir) 
        {   
            // Kiểm tra xem có file nào được tải lên không
            if (!isset($file) || $file["error"] != 0) {
                toastMessage('error', 'Thất bại', 'Không có ảnh nào được tải lên!');
                return false;
            }

            // Kiểm tra và tạo thư mục nếu chưa tồn tại
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Đường dẫn lưu ảnh
            $target_file = $target_dir . basename($file["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Kiểm tra định dạng ảnh hợp lệ
            $allowed_types = ["jpg", "png", "jpeg", "gif", "webp"];
            if (!in_array($imageFileType, $allowed_types)) {
                toastMessage('error', 'Thất bại', 'Định dạng ảnh không hợp lệ!');
                return false;
            }

            // Kiểm tra dung lượng ảnh (giới hạn 5MB)
            if ($file["size"] > 5 * 1024 * 1024) {
                toastMessage('error', 'Thất bại', 'Dung lượng ảnh quá lớn! (tối đa 5MB)');
                return false;
            }

            // Di chuyển file vào thư mục đích
            if (!file_exists($target_file)) {
                if (!move_uploaded_file($file["tmp_name"], $target_file)) {
                    toastMessage('error', 'Thất bại', 'Không thể lưu ảnh sản phẩm!');
                    return false;
                }
            }

            return $target_file; // Trả về đường dẫn file nếu thành công
        }

        public function showUpdateNewsView($newsId)
        {
            $newsDetailsInfo = $this->Database->getNewsDetailsInfo($newsId);    
            $newsCatNameAndIdList = $this->Database->getNewsCatNameAndId();
            view('Admin/AdminPages/News/NewsUpdateView', compact("newsDetailsInfo", "newsCatNameAndIdList"));
        }

        public function handleUpdateNews()
        {
            if(isset($_POST['SubmitHandleUpdateNews']) && ($_POST['SubmitHandleUpdateNews']))
            {
                $userId = $_SESSION['adminInfo'][0]['userId'];
                $newsId = $_POST['newsId'];
                $newsCatId = $_POST['newsCatId'];
                $title = $_POST['title'];
                $excerpt = $_POST['excerpt'];
                $content = htmlentities($_POST['content']);

                if (!isset($_FILES["thumbnail"]) && !($_FILES["thumbnail"])) {
                    $newsThumbnailImagePath = $this->uploadNewsThumbnailForCreate($_FILES["thumbnail"], $this->TARGET_DIR_NEWS_THUMBNAIL);
                    if (!$newsThumbnailImagePath) {
                        redirect('AdminUpdateNewsRoute', ['newsId' => $newsId]);
                    }
                }else {
                    $newsThumbnailImagePath = null;
                }

                $isExists = $this->Database->checkExistsNews($title, $excerpt, $newsThumbnailImagePath);
                if($isExists) {
                    toastMessage('error', 'Thất bại', 'Thông tin tin tức này đã tồn tại');
                    redirect('AdminNewsRoute');
                }

                $resultCreate = $this->Database->updateNews($userId, $newsId, $newsCatId, $title, $excerpt, $content, $newsThumbnailImagePath);
                if(!$resultCreate) {
                    toastMessage('error', 'Thất bại', 'Cập nhật thông tin tin tức mới thất bại');
                }else {
                    toastMessage('success', 'Thành công', 'Cập nhật thông tin tin tức mới thành công');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminNewsRoute');
        }

        public function changeStatusNews()
        {
            if(isset($_POST['SubmitChangeStatusNews']) && ($_POST['SubmitChangeStatusNews']))
            {
                $userId = $_SESSION['adminInfo'][0]['userId'];
                $newsId = $_POST['newsIdChangingStatus'];
                $resultChangeStatus = $this->Database->changeStatusNews($userId, $newsId);
                if(!$resultChangeStatus) {
                    toastMessage('error', 'Thất bại', 'Thay đổi trạng thái hiển thị tin tức thành công');
                }else {
                    toastMessage('success', 'Thành công', 'Thay đổi trạng thái hiển thị tin tức thành công');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminNewsRoute');
        }

        public function tempDeleteNews()
        {
            if(isset($_POST['SubmitTempDeleteNews']) && ($_POST['SubmitTempDeleteNews']))
            {
                $userId = $_SESSION['adminInfo'][0]['userId'];
                $newsId = $_POST['newsIdTempDelete'];

                $resultTempDelete = $this->Database->tempDeleteNews($userId, $newsId);   
                if($resultTempDelete) {
                    toastMessage('success', 'Thành công', 'Xóa tạm tin tức thành công');
                }else {
                    toastMessage('error', 'Thất bại', 'Xóa tạm tin tức thất bại');
                }

            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminNewsRoute');
        }

        public function showNewsInTrashView()
        {
            $newsInTrashList = $this->Database->getAllNewsInTrash();
            view('Admin/AdminPages/News/NewsInTrashView', compact('newsInTrashList'));
        }

        public function removeNews()
        {
            if(isset($_POST['SubmitDeleteNews']) && ($_POST['SubmitDeleteNews']))
            {
                $newsId = $_POST['newsIdDelete'];
                $resultDelete = $this->Database->deleteNews($newsId);
                if(!$resultDelete) {
                    toastMessage('error', 'Thất bại', 'Xóa tin tức thất bại');
                }else {
                    toastMessage('success', 'Thàn công', 'Xóa tin tức thành công');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminNewsInTrashRoute');
        }

        public function restoreNewsInTrash()
        {
            if(isset($_POST['SubmitRestoreNewsInTrash']) && ($_POST['SubmitRestoreNewsInTrash']))
            {
                $newsId = $_POST['newsIdRestore'];
                $userId = $_SESSION['adminInfo'][0]['userId'];
                $resultRestore = $this->Database->restoreNewsInTrash($userId, $newsId);
                if(!$resultRestore) {
                    toastMessage('error', 'Thất bại', 'Khôi phục tin tức thất bại');
                }else {
                    toastMessage('success', 'Thành công', 'Khôi phục tin tức thành công');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminNewsInTrashRoute');
        }
    /* END NEWS */
}