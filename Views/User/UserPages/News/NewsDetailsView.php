<?php
    $Title = "Tin Tức | Samsonitu Shoes";
    $extraCSS = [public_dir('css/UserCss/newsDetails.css')];
    require_once __DIR__ . "/../../UserLayouts/HeaderView.php";
?>
    <main>
        <section class="section-breadcrump" style="background-image: url(<?=public_dir('/img/section_breadcrumb.webp')?>)">
            <div class="breadcrump-container text-center">
                <div class="title-section">
                    <h2 style="margin-bottom: 25px;">Tin tức</h2>
                    <ul class="breadcrump p-0">
                        <li>
                            <a href="" class="hover-maincl">Trang chủ</a>
                            <i class="fa-solid fa-caret-right"></i>
                        </li>
                        <li>
                            <span>Tin tức</span>
                            <i class="fa-solid fa-caret-right"></i> 
                        </li>
                        <li><?= $newsDetailsInfo[0]['title'] ?></li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="section-news mb-4">
            <div class="container-lg">
                <?= html_entity_decode($newsDetailsInfo[0]['content']); ?>
            </div>
        </section>

        <?php if(isset($newsRelatedList)) : ?>
        <section class="section-related-news">
            <div class="container-lg">
                <div class="news-related-list">
                    <?php foreach($newsRelatedList as $newsRelatedItem) : ?>
                        <div class="news-related-item">
                            <div class="news-related-img">
                                <img src="/<?= htmlspecialchars($newsRelatedItem['thumbnail']); ?>" 
                                alt="<?= htmlspecialchars($newsRelatedItem['title']); ?>">
                            </div>
                            <div class="news-related-content">
                                <h3>
                                    <a href="<?= $newsRelatedItem['newsSlug']; ?>">
                                        <?= htmlspecialchars($newsRelatedItem['title']); ?>
                                    </a>
                                </h3>
                                <p><strong>Ngày đăng:</strong> <?= formatDate(htmlspecialchars($newsRelatedItem['createAt'])); ?></p>
                                <p><?= htmlspecialchars($newsRelatedItem['excerpt']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?> 
                </div>
            </div>
        </section>
        <?php endif; ?>
    </main>
<?php
    require_once __DIR__ . "/../../UserLayouts/FooterView.php";
?>