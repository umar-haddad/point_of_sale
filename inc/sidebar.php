<?php
$_id = isset($_SESSION['ID_USER']) ? $_SESSION['ID_USER'] : '';
$queryMainMenu = mysqli_query($config, "SELECT DISTINCT menus.* FROM menus 
                                                                JOIN menu_roles ON menus.menu_id = menu_roles.id_menu
                                                                JOIN user_roles ON user_roles.id_role = menu_roles.id_role
                                                                WHERE user_roles.id_user = '$_id' 
                                                                AND (parent_id=0 OR parent_id='')
                                                                ORDER BY menu_order ASC");
$rowMainMenu = mysqli_fetch_all($queryMainMenu, MYSQLI_ASSOC);

?>

<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">


        <!-- End Dashboard Nav -->
        <?php foreach ($rowMainMenu as $mainMenu): ?>
            <?php
            // var_dump($mainMenu);
            // die;
            $idMenu = $mainMenu['menu_id'];
            // var_dump($idMenu);

            // print_r($idMenu);
            // die;
            $querySubMenu = mysqli_query($config, "SELECT DISTINCT menus.* FROM menus 
                                                                            JOIN menu_roles ON menus.menu_id = menu_roles.id_menu
                                                                            JOIN user_roles ON user_roles.id_role = menu_roles.id_role
                                                                            WHERE user_roles.id_user = '$_id' 
                                                                            AND (parent_id='$idMenu') 
                                                                            ORDER BY menu_order ASC");
            // $row = mysqli_fetch_all($querySubMenu, MYSQLI_ASSOC);
            // var_dump($row);
            // var_dump($querySubMenu);

            ?>
            <?php if (mysqli_num_rows($querySubMenu) > 0): ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#menu-<?= $mainMenu['menu_id'] ?>" data-bs-toggle="collapse"
                        href="#">
                        <i class="<?= $mainMenu['menu_icon'] ?>"></i><span><?= $mainMenu['menu_name'] ?></span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="menu-<?= $mainMenu['menu_id'] ?>" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <?php while ($rowSubMenu = mysqli_fetch_assoc($querySubMenu)): ?>
                            <li>
                                <a href="?page=<?= $rowSubMenu['menu_url'] ?>">
                                    <i class="<?= $rowSubMenu['menu_icon'] ?>"></i><span><?= $rowSubMenu['menu_name'] ?></span>
                                </a>
                            </li>
                        <?php endwhile ?>

                    </ul>
                </li><!-- End Components Nav -->
            <?php elseif (!empty($mainMenu['menu_url'])): ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= $mainMenu['menu_url'] ?>">
                        <i class="<?= $mainMenu['menu_icon'] ?>"></i>
                        <span><?= $mainMenu['menu_name'] ?></span>
                    </a>
                </li>
            <?php endif ?>
        <?php endforeach ?>



        <!-- End Profile Page Nav -->
    </ul>

</aside>