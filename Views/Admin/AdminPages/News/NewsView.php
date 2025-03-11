<?php 
    $title = "Quản Lý Tin Tức | SSNT SHOES";
    $activePage = [
        'navItem' => route('AdminNewsRoute'),
        'subNavItem' => route('AdminNewsRoute'),
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
        public_dir('js/AdminJs/News/News.js')
    ];

    require_once __DIR__ . "/../../AdminLayouts/SidebarView.php";
    require_once __DIR__ . "/../../AdminLayouts/HeaderView.php"; 
?>
<div class="content">
    <div class="bread-crump">
        <p>
            <a href="<?= route('AdminRoute'); ?>">Trang chủ</a> / 
            <a href="<?= route('AdminNewsRoute') ?>">Quản Lý Tin Tức</a>
        </p>
    </div>    
    <table id="table-news-management" class="table-responsive">
        <div class="d-flex justify-content-between align-items-center gap-2">
            
            <a href="<?= route('AdminNewsInTrashRoute'); ?>">
                Thùng rác (<?php if(!empty($countNewsInTrash)) echo $countNewsInTrash[0]['total']; ?>)
            </a>
            <a href="<?= route('AdminNewsCreateViewRoute'); ?>" class="btn btn-primary text-light ms-auto d-block">
                <i class="fa-solid fa-plus"></i>
                Tạo mới
            </a>
        </div>
        <thead>
            <tr>
                <th class="table__header-stt">SST</th>
                <th class="table__header-title">Tiêu đề tin tức</th>
                <th class="table__header-excerpt desc-column">Mô tả ngắn</th>
                <th class="table__header-thumbnail desc-column">Thumbnail</th>
                <th class="table__header-createAt desc-column">Ngày tạo</th>
                <th class="table__header-actions">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($newsList)): 
                $countSTT = 1;
                foreach ($newsList as $newsItem):
                    if($newsItem['active'] == 0) continue;
            ?>
                <tr>
                    <td class="table__data-stt">
                        <?= $countSTT; ?>
                        <input type="hidden" name="newsId" value="<?= $newsItem['newsId']; ?>">
                    </td>
                    <td class="table__data-title" style="text-transform: capitalize;">
                        <?= htmlspecialchars($newsItem['title'], ENT_QUOTES, 'UTF-8'); ?>
                    </td>
                    <td class="table__data-excerpt desc-column">
                        <?= htmlspecialchars($newsItem['excerpt'], ENT_QUOTES, 'UTF-8'); ?>
                    </td>
                    <td class="table__data-thumbnail desc-column">
                        <img width="100%" height="100%" src="/<?= htmlspecialchars($newsItem['thumbnail']); ?>" 
                            alt="<?= htmlspecialchars($newsItem['title'], ENT_QUOTES, 'UTF-8'); ?>">
                    </td>
                    <td class="table__data-createAt date-column">
                        <?= formatDate($newsItem['createAt']); ?>
                    </td>
                    <td class="table__data-actions">
                    <button class="btn-action" id="btn-action--view" data-bs-toggle="tooltip" title="Xem chi tiết"> 
                        <a href="<?= route('AdminNewsDetailsRoute', ['newsId' => $newsItem['newsId']]); ?>"><i class="bg-info fas fa-eye action-icons__icon action-icons__icon--view"></i></a>
                    </button>
                        <form action="<?= route('AdminChangeStatusNewsRoute'); ?>" method="post" 
                            data-bs-toggle="tooltip" title="Bật/Tắt hiển thị tin tức"
                        >
                            <input type="hidden" name="newsIdChangingStatus" value="<?= $newsItem['newsId']; ?>">
                            <button type="button" class="btn-action btn-action--status">
                                <?= $newsItem['status'] === 1 
                                ? '<i class="bg-success fas fa-toggle-on 
                                    action-icons__icon 
                                    action-icons__icon--toggle-on"></i>'
                                : '<i class="bg-secondary fas fa-toggle-off 
                                    action-icons__icon 
                                    action-icons__icon--toggle-off"></i>'; ?> 
                            </button>
                        </form>
                        <button class="btn-action btn-action--edit" 
                            data-bs-toggle="tooltip" title="Chỉnh sửa tin tức"
                        >
                            <a href="<?= route('AdminNewsUpdateRoute', ["newsId" => $newsItem['newsId']]) ?>">
                                <i class="bg-warning fas fa-pen action-icons__icon action-icons__icon--edit"></i>
                            </a>
                        </button>
                        <form action="<?= route('AdminTempDeleteNewsRoute'); ?>" method="post"
                            data-bs-toggle="tooltip" title="Xóa tin tức"
                        >
                            <input type="hidden" name="newsIdTempDelete" value="<?= $newsItem['newsId'];?>">
                            <button type="button" class="btn-action btn-action--delete">
                                <i class="bg-danger fas fa-trash action-icons__icon action-icons__icon--delete"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php 
                $countSTT++;
                endforeach;
                endif;
            ?>
        </tbody>
    </table>

    <div class="modal fade" id="modalTempDeleteNews" 
        tabindex="-1" aria-labelledby="modalTempDeleteNewsLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="text-end p-2"><button type="button" class="btn btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body text-center">
                    <p class="message-confirm">Xác nhận xóa tạm tin tức
                        <b id="titleDelete"></b>
                    </p>

                    <button type="button" class="btn btn-success" name="ConfirmSubmitTempDeleteNews">Xác nhận</button>
                    <button type="cancel" class="btn btn-danger" name="CancelSubmitTempDeleteNews">Hủy</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalChangingStatusNews" 
        tabindex="-1" aria-labelledby="modalChangingStatusNewsLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="text-end p-2"><button type="button" class="btn btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body text-center">
                    <p class="message-confirm">Xác nhận 
                        <b id="newsCurrentStatus"></b>  tin tức
                        <b id="titleChangingStatus"></b> 
                    </p>

                    <button type="button" class="btn btn-success" name="ConfirmSubmitChangingStatus">Xác nhận</button>
                    <button type="cancel" class="btn btn-danger" name="CancelSubmitChangingStatus">Hủy</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../../AdminLayouts/FooterView.php"; ?>