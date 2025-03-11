<?php 
    $title = "Tạo Mới Tin Tức | SSNT SHOES";
    $activePage = [
        'navItem' => route('AdminNewsRoutes'),
        'subNavItem' => route('AdminNewsRoutes'),
    ];
    $extraCSS = ['https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css'];
    $extraJS = [
        'https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js',
        public_dir('js/AdminJs/News/newsCreate.js'),
    ];

    require_once __DIR__ . "/../../AdminLayouts/SidebarView.php";
    require_once __DIR__ . "/../../AdminLayouts/HeaderView.php";
?>

<div class="content">
    <div class="bread-crump">
        <p>
            <a href="<?= route('AdminRoute'); ?>">Trang chủ</a> /
            <a href="<?= route('AdminNewsRoute'); ?>">Tin Tức</a> /
            <a href="<?= route('AdminCreateNewsRoute'); ?>">Tạo Mới Tin Tức</a>
        </p>
    </div>

    <form action="<?= route('AdminHandleCreateNewsRoute'); ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <select name="newsCatId" class="form-select" required>
                <option value="">Chọn danh mục tin tức</option>
                <?php foreach($newsCatNameAndIdList as $newsCatNameAndIdItem) : ?>
                <option value="<?= $newsCatNameAndIdItem['newsCatId']; ?>"><?= $newsCatNameAndIdItem['newsCatName']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row">
            <div class="col-6">
                <label for="title" class="form-label">Tiêu Đề:</label>
                <input type="text" class="form-control" id="title" placeholder="Nhập tiêu đề tin tức" name="title" maxlength="75" required>
                <div class="mb-3 mt-3">
                    <label for="excerpt" class="form-label">Mô tả ngắn:</label>
                    <textarea type="excerpt" class="form-control" id="excerpt" placeholder="Nhập mô tả ngắn cho tin tức" name="excerpt" rows="5" style="resize: none;" required></textarea>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3 mt-3">
                    <label for="thumbnail" class="form-label">Thumbnail:</label>
                    <input type="file" class="form-control" id="thumbnail" name="thumbnail" required>
                </div>
                <label for="title" class="form-label">Xem trước thumbnail:</label>
                <img src="" alt="preview-thumbnail" id="preview-thumbnail" width="250px" height="150px">
            </div>
        </div>
        <div class="mb-3 mt-3">
            <label for="editor" class="form-label">Nội dung chi tiết:</label>
            <div id="editor" class="bg-light" style="min-height: 500px;"></div>
            <input type="hidden" name="content" id="quillContent" required>
        </div>
        <div class="text-center">
            <input class="btn btn-success" type="submit" value="Tạo Tin Tức" name="SubmitHandleCreateNews">
            <button class="btn btn-danger" type="cancel">Hoàn Tác</button>
        </div>
    </form>

</div>
<?php require_once __DIR__ . "/../../AdminLayouts/FooterView.php"; ?>