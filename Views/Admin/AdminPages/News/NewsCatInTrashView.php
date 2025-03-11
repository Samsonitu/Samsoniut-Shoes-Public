<?php 
    $title = "Thùng Rác Danh Mục Tin Tức | SSNT SHOES";
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
        public_dir('js/AdminJs/News/newsCatInTrash.js'),
    ];

    require_once __DIR__ . "/../../AdminLayouts/SidebarView.php";
    require_once __DIR__ . "/../../AdminLayouts/HeaderView.php"; 
?>

<div class="content">
    <div class="bread-crump">
        <p>
            <a href="<?= route('AdminRoute'); ?>">Trang chủ</a> /
            <a href="<?= route('AdminNewsCategoryRoute'); ?>">Quản Lý Danh Mục Tin Tức</a> /
            <a href="<?= route('AdminNewsCatInTrashRoute'); ?>">Thùng Rác Danh Mục Tin Tức</a>
        </p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Danh Mục</th>
                <th>Mô Tả</th>
                <th>Ngày Tạo</th>
                <th>Lần Cập Nhật Cuối</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($newsCatInTrashList)) : ?>
                <?php foreach ($newsCatInTrashList as $index => $category) : ?>
                    <tr data-news-cat-id="<?= $category['newsCatId'] ?>" data-news-cat-name= "<?= $category['newsCatName'] ?>">
                        <td><?= $index + 1; ?></td>
                        <td><?= htmlspecialchars($category['newsCatName']); ?></td>
                        <td><?= htmlspecialchars($category['description']); ?></td>
                        <td><?= htmlspecialchars($category['createAt']); ?></td>
                        <td><?= htmlspecialchars($category['lastUpdated']); ?></td>
                        <td>
                            <button type="button" class="btn-action btn-action--delete" 
                                data-id="<?= $category['newsCatId'] ?>">
                                <i class="bg-danger fas fa-trash action-icons__icon action-icons__icon--delete"></i>
                            </button>
                            <button type="button" class="btn-action btn-action--restore" 
                                data-id="<?= $category['newsCatId'] ?>">
                                <i class="bg-success fas fa-undo action-icons__icon"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6">Không có danh mục nào trong thùng rác.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="modal fade" id="modalDelNewsCatPermanently" 
        tabindex="-1" aria-labelledby="modalDelNewsCatPermanentlyLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="text-end p-2"><button type="button" class="btn btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body text-center">
                    <form action="<?= route('AdminRemoveNewsCategoryRoute'); ?>" method="post">
                        <input type="hidden" name="newsCatIdDelete">
                        <button type="submit" name="SubmitDeleteNewsCategory" class="btn border-3 border-danger" value="SubmitChange"><b>Xóa vĩnh viễn</b> danh mục 
                            <b id="newsCatNameDelete"></b> 
                        </button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalRestoreNewsCatInTrash" 
        tabindex="-1" aria-labelledby="modalRestoreNewsCatInTrashLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="text-end p-2"><button type="button" class="btn btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body text-center">
                    <form action="<?= route('AdminRestoreNewsCatInTrashRoute'); ?>" method="post">
                        <input type="hidden" name="newsCatIdRestore">
                        <button type="submit" name="SubmitRestoreNewsCatInTrash" class="btn border-3 border-success" value="SubmitChange"><b>Khôi phục </b> danh mục 
                            <b id="newsCatNameRestore"></b> 
                        </button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  

<?php require_once __DIR__ . "/../../AdminLayouts/FooterView.php"; ?>
