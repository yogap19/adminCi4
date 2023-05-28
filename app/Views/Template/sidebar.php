        <!-- Sidebar -->
        <?php
        $role_id = session()->get('role_id');
        ?>
        <ul class="navbar-nav sidebar sidebar-dark accordion" style="background: #1c4645;" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <div class="text-center d-none d-md-inline">
                <img class="rounded-circle m-2" src="<?= base_url('/img/undraw_profile.svg'); ?>" id="sidebarToggle" alt="" width="50px" height="50px">
            </div>
            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- looping menu -->
            <?php $db = \Config\Database::connect(); ?>
            <!-- Query menu -->
            <?php

            $menua = $db->table('user_menu')
                ->join('user_access_menu', 'user_menu.id = user_access_menu.menu_id')
                ->where('user_access_menu.role_id = ' . $role_id)
                ->get()->getResultArray();
            ?>
            <?php foreach ($menua as $key => $m) : ?>
                <div class="sidebar-heading">
                    <?= $m['menu']; ?>
                </div>
                <!-- Divider -->

                <?php
                $menuid = $m['menu_id'];
                $subm = $db->table('user_menu')
                    ->join('user_sub_menu', 'user_sub_menu.menu_id = user_menu.id')
                    ->where('user_sub_menu.menu_id = ' . $menuid)->having('user_sub_menu.is_active = 1')
                    ->get()->getResultArray();

                ?>
                <!-- looping submenu -->
                <?php foreach ($subm as $key => $sm) : ?>
                    <?php if ($title == $sm['title']) : ?>
                        <li class="nav-item active">
                        <?php else : ?>
                        <li class="nav-item ">
                        <?php endif; ?>
                        <a class="nav-link" href="<?= base_url($sm['url']); ?>">
                            <i class="<?= $sm['icon']; ?>"></i>
                            <span><?= $sm['title']; ?></span></a>
                        </li>
                    <?php endforeach; ?>
                    <hr class="sidebar-divider ">
                    <!-- Query sub menu -->
                <?php endforeach; ?>
                <!-- Heading -->



                <!-- Nav Item - Edit Profile -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

        </ul>
        <!-- End of Sidebar -->