<main>
    <header class="header">
        <nav class="header__navbar px-4">
            <label for="sidebar-toggle" class="header__menu-toggle">
                <i class="fa-solid fa-bars-staggered"></i>
                <i class="fa-solid fa-bars"></i>
            </label>
            <div class="header__search input-group w-50 position-relative">
                <input id="adminSearch" class="form-control" type="text" placeholder="Tìm kiếm chức năng quản trị...">
                <button class="btn btn-secondary text-nowrap" type="button">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <ul id="searchResults" class="dropdown-menu w-100"></ul>
            </div>
            <div class="header__actions d-flex align-items-center gap-4">
                <button class="header__search-toggle">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <div class="header__user">
                    <img src="<?=public_dir('/img/unnamed.jpg')?>" alt="User Avatar" class="header__user-avatar">
                    <ul class="header__user-dropdown text-small shadow">
                        <li class="dropdown-item"><strong><?= $_SESSION['adminInfo'][0]['fullName'] ?></strong></li>
                        <hr class="m-0">
                        <li><a class="dropdown-item" href="<?= route('LogoutRoute'); ?>">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>