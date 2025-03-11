<?php 
    $title = "Cập Nhật Tin Tức | SSNT SHOES";
    $activePage = [
        'navItem' => route('AdminNewsRoute'),
        'subNavItem' => route('AdminNewsRoute'),
    ];
    $extraCSS = ['https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css'];
    $extraJS = [
        'https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js',
        public_dir('js/AdminJs/News/newsUpdate.js'),
    ];
    require_once __DIR__ . "/../../AdminLayouts/SidebarView.php";
    require_once __DIR__ . "/../../AdminLayouts/HeaderView.php"; 
?>
<div class="content">
    <div class="bread-crump">
        <p>
            <a href="<?= route('AdminRoute'); ?>">Trang chủ</a> / 
            <a href="<?= route('AdminNewsRoute') ?>">Quản Lý Tin Tức</a> /
            <a href="<?= route('AdminUpdateNewsRoute', ['newsId' => $newsDetailsInfo[0]['newsId']]); ?>">Cập Nhật Tin Tức</a>
        </p>
    </div>    
    <form action="<?= route('AdminHandleUpdateNewsRoute'); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="newsId" value="<?= $newsDetailsInfo[0]['newsCatId']; ?>">
        <div class="mb-3 mt-3">
            <select name="newsCatId" class="form-select" required>
                <?php foreach($newsCatNameAndIdList as $newsCatNameAndIdItem) : ?>
                <option value="<?= $newsCatNameAndIdItem['newsCatId']; ?>"
                    <?= $newsCatNameAndIdItem['newsCatId'] = $newsCatNameAndIdItem['newsCatId'] === $newsDetailsInfo[0]['newsCatId'] ? 'selected' : ''; ?>
                >
                    <?= $newsCatNameAndIdItem['newsCatName']; ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row">
            <div class="col-6">
                <label for="title" class="form-label">Tiêu Đề:</label>
                <input type="text" class="form-control" id="title" placeholder="Nhập tiêu đề tin tức" name="title" maxlength="75" required
                    value="<?= $newsDetailsInfo[0]['title']; ?>"
                >
                <div class="mb-3 mt-3">
                    <label for="excerpt" class="form-label">Mô tả ngắn:</label>
                    <textarea type="excerpt" class="form-control" id="excerpt" name="excerpt" rows="5" placeholder="Nhập mô tả ngắn cho tin tức" style="resize: none;" required><?= $newsDetailsInfo[0]['excerpt']; ?></textarea>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3 mt-3">
                    <label for="thumbnail" class="form-label">Thumbnail:</label>
                    <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                </div>
                <label for="title" class="form-label">Xem trước thumbnail:</label>
                <img src="/<?= $newsDetailsInfo[0]['thumbnail']; ?>" 
                    alt="preview-thumbnail" id="preview-thumbnail" width="250px" height="150px">
            </div>
        </div>
        <div class="mb-3 mt-3">
            <label for="editor" class="form-label">Nội dung chi tiết:</label>
            <div id="editor" class="bg-light" style="min-height: 500px;">
                <?= html_entity_decode($newsDetailsInfo[0]['content']); ?>
            </div>
            <input type="hidden" name="content" id="quillContent">
        </div>
        <div class="text-center">
            <input class="btn btn-success" type="submit" value="Cập Nhật Tin Tức" name="SubmitHandleUpdateNews">
            <button class="btn btn-danger" type="cancel">Hoàn Tác</button>
        </div>
    </form>
    
</div>

<?php require_once __DIR__ . "/../../AdminLayouts/FooterView.php"; ?>