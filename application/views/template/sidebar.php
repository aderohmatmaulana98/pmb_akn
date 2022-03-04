<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="mt-4">
            <img src="<?= base_url('assets/landing/assets/img/akn/logo_akn.png'); ?>" width="150" height="150" class='mx-auto d-block' alt="Gambar Logo">
        </div>
        <div class="sidebar-menu">
            <ul class="menu">

                <?php
                $role_id = $this->session->userdata('role_id');
                $queryMenu = "SELECT user_menu.id, menu
                            FROM user_menu JOIN user_access_menu
                            ON user_menu.id = user_access_menu.menu_id
                            WHERE user_access_menu.role_id = $role_id
                            ORDER BY user_access_menu.menu_id ASC";

                $menu = $this->db->query($queryMenu)->result_array();

                ?>
                <?php foreach ($menu as $m) : ?>
                    <li class='sidebar-title'><?= $m['menu']; ?></li>


                    <?php
                    $menuId = $m['id'];
                    $querySubMenu = "SELECT *
                                        FROM user_sub_menu JOIN user_menu
                                        ON user_sub_menu.menu_id = user_menu.id
                                        WHERE user_sub_menu.menu_id = $menuId
                                        AND user_sub_menu.is_active = 1
                                        ";
                    $subMenu = $this->db->query($querySubMenu)->result_array();
                    ?>
                    <?php foreach ($subMenu as $sm) : ?>
                        <?php if ($title == $sm['title']) : ?>
                            <li class="sidebar-item active">
                            <?php else : ?>
                            <li class="sidebar-item">
                            <?php endif; ?>

                            <a href="<?= base_url($sm['url']) ?>" class='sidebar-link'>
                                <i data-feather="<?= $sm['icon'] ?>" style="color: chocolate;" width="20"></i>
                                <span><?= $sm['title'] ?></span>
                            </a>
                            </li>
                        <?php endforeach ?>

                    <?php endforeach; ?>

                    <li class='sidebar-title'>Setting</li>



                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i data-feather="user" style="color: chocolate;" width="20"></i>
                            <span>Pengaturan</span>
                        </a>
                        <ul class="submenu">
                            <li>
                                <?php if ($user['role_id'] == 2) : ?>
                                    <a href="<?= base_url('admin/my_profil') ?>">My Profil</a>
                                <?php elseif ($user['role_id'] == 3) : ?>
                                    <a href="<?= base_url('penyeleksi/my_profil') ?>">My Profil</a>
                                <?php else : ?>
                                    <a href="<?= base_url('user/my_profil') ?>">My Profil</a>
                                <?php endif; ?>
                            </li>

                            <li>
                                <?php if ($user['role_id'] == 2) : ?>
                                    <a href="<?= base_url('admin/change_password') ?>">Ubah Password</a>
                                <?php elseif ($user['role_id'] == 3) : ?>
                                    <a href="<?= base_url('penyeleksi/change_password') ?>">Ubah Password</a>
                                <?php else : ?>
                                    <a href="<?= base_url('user/change_password') ?>">Ubah Password</a>
                                <?php endif; ?>
                            </li>

                            <li>
                                <a href="<?= base_url('auth/logout') ?>">Logout</a>
                            </li>
                        </ul>
                    </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>