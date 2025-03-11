<?php 
    $title = "Thùng Rác Tin Tức | SSNT SHOES";
    $activePage = [
        'navItem' => route('AdminNewsRoutes'),
        'subNavItem' => route('AdminNewsRoutes'),
    ];
    $extraCSS = [
        'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css',
        'https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css'
    ];
    $extraJS = [
        'https://code.jquery.com/jquery-3.7.1.js',
        'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js',
        'https://cdn.datatables.net/2.2.2/js/dataTables.js',
        'https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js',
        public_dir('js/AdminJs/News/newsInTrash.js'),
    ];

    require_once __DIR__ . "/../../AdminLayouts/SidebarView.php";
    require_once __DIR__ . "/../../AdminLayouts/HeaderView.php"; 
?>

<div class="content">
    <div class="bread-crump">
        <p>
            <a href="<?= route('AdminRoute'); ?>">Trang chủ</a> /
            <a href="<?= route('AdminNewsRoute'); ?>">Quản Lý Tin Tức</a> /
            <a href="<?= route('AdminNewsInTrashRoute'); ?>">Thùng Rác Tin Tức</a>
        </p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tiêu đề</th>
                <th>Mô tả ngắn</th>
                <th>Thumbnail</th>
                <th>Ngày Tạo</th>
                <th>Lần Cập Nhật Cuối</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($newsInTrashList)) : ?>
                <?php foreach ($newsInTrashList as $index => $category) : ?>
                    <tr data-news-id="<?= $category['newsId'] ?>" data-title= "<?= $category['title'] ?>">
                        <td><?= $index + 1; ?></td>
                        <td><?= htmlspecialchars($category['title']); ?></td>
                        <td><?= htmlspecialchars($category['excerpt']); ?></td>
                        <td>
                            <img width="100%" height="100%" src="/<?= htmlspecialchars($category['thumbnail']); ?>" 
                                alt="<?= htmlspecialchars($category['title']); ?>"></td>
                        <td><?= htmlspecialchars($category['createAt']); ?></td>
                        <td><?= htmlspecialchars($category['lastUpdated']); ?></td>
                        <td>
                            <button type="button" class="btn-action btn-action--delete" 
                                data-id="<?= $category['newsId'] ?>">
                                <i class="bg-danger fas fa-trash action-icons__icon action-icons__icon--delete"></i>
                            </button>
                            <button type="button" class="btn-action btn-action--restore" 
                                data-id="<?= $category['newsId'] ?>">
                                <i class="bg-success fas fa-undo action-icons__icon"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6">Không có tin tức nào trong thùng rác.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="modal fade" id="modalDelNewsPermanently" 
        tabindex="-1" aria-labelledby="modalDelNewsPermanentlyLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="text-end p-2"><button type="button" class="btn btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body text-center">
                    <form action="<?= route('AdminRemoveNewsRoute'); ?>" method="post">
                        <input type="hidden" name="newsIdDelete">
                        <button type="submit" name="SubmitDeleteNews" class="btn border-3 border-danger" value="SubmitChange"><b>Xóa vĩnh viễn</b> tin tức 
                            <b id="titleDelete"></b> 
                        </button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalRestoreNewsInTrash" 
        tabindex="-1" aria-labelledby="modalRestoreNewsInTrashLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="text-end p-2"><button type="button" class="btn btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body text-center">
                    <form action="<?= route('AdminRestoreNewsInTrashRoute'); ?>" method="post">
                        <input type="hidden" name="newsIdRestore">
                        <button type="submit" name="SubmitRestoreNewsInTrash" class="btn border-3 border-success" value="SubmitChange"><b>Khôi phục </b> tin tức 
                            <b id="titleRestore"></b> 
                        </button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  

<?php require_once __DIR__ . "/../../AdminLayouts/FooterView.php"; ?>
