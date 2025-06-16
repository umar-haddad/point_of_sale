<?php
$roleId = isset($_GET['edit']) ? $_GET['edit'] : '';
if (isset($_POST['save'])) {
    //ada tidak parameter bernama edit, kalau ada jalankan perintah edit, jika tidak maka akan menyimpan baru
    $roleName = $_POST['role_name'];
    $roleId = isset($_GET['edit']) ? $_GET['edit'] : '';
    $queryInsert = mysqli_query($config, "INSERT INTO roles (role_name) VALUES ('$roleName')");
    header("location:?page=/rol/role&add=success");
}

if (isset($_POST['edit'])) {
    $roleName = $_POST['role_name'];
    $queryUpdate = mysqli_query($config, "UPDATE roles SET role_name='$roleName' WHERE role_id = $roleId");
    header("location:?page=/rol/role&update=success");
}
if (isset($_GET['edit'])) {
    $queryEdit = mysqli_query($config, "SELECT * FROM roles WHERE role_id = $roleId");
    $rowEdit = mysqli_fetch_assoc($queryEdit);
}



if (isset($_GET['delete'])) {
    $major_id = isset($_GET['delete']) ? $_GET['delete'] : '';
    $queryDelete = mysqli_query($config, "UPDATE roles SET deleted_at = 1 WHERE role_id = '$roleId'");
    if ($queryDelete) {
        header("location:?page=/rol/role&delete=success");
    } else {
        header("location:?page=/rol/role&delete=failed");
    }
}

$queryRole = mysqli_query($config, "SELECT * FROM roles ORDER BY role_id DESC");
$rowRole = mysqli_fetch_all($queryRole, MYSQLI_ASSOC);

if (isset($_GET['add_role_menu'])) {

    $idAccess = $_GET['add_role_menu'];
    $edit = [];
    $editRoleMenu = mysqli_query($config, "SELECT * FROM menu_roles WHERE id_role='$idAccess'");
    // $rowEditRoleMenu = mysqli_fetch_all($editRoleMenu, MYSQLI_ASSOC);
    $rowEditRoleMenu = [];
    $menus = mysqli_query($config, "SELECT * FROM menus ORDER BY parent_id, menu_order");
    // $rowAccess = [];
    while ($editMenu = mysqli_fetch_assoc($editRoleMenu)) {
        $rowEditRoleMenu[] = $editMenu['id_menu'];
    }
    $rowMenu = [];
    while ($m = mysqli_fetch_assoc($menus)) {
        $rowMenu[] = $m;
    }
}

if (isset($_POST['save_menu'])) {
    $idRole = $_GET['add_role_menu'];
    $idMenus = $_POST['id_menus'] ?? [];
    // if($_POST['id_menus']){
    // $idMenus = $_POST['id_menu'];
    //     else{
    //         $idMenus = [];
    //     }
    // }

    mysqli_query($config, "DELETE FROM menu_roles WHERE id_role='$idRole'");
    foreach ($idMenus as $m) {
        $idMenu = $m;
        mysqli_query($config, "INSERT INTO menu_roles(id_role, id_menu) VALUES('$idRole', '$idMenu')");
    }
    header("location:?page=/rol/add_role&add_role_menu=" . $idRole . "&add=success");
}

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <?= (isset($_GET['edit']) ? 'Edit' : (isset($_GET['add_role_menu']) ? 'Access' : 'Add')) ?> Role
                </h5>
                <?php if (isset($_GET['add_role_menu'])): ?>
                    <form action="" method="post">
                        <ul>
                            <?php foreach ($rowMenu as $mainMenu): ?>
                                <?php if ($mainMenu['parent_id'] == 0 or $mainMenu['parent_id'] == ''): ?>
                                    <!--  -->
                                    <li>
                                        <div class="mb-3">
                                            <label for="" class="">
                                                <input <?= in_array($mainMenu['menu_id'], $rowEditRoleMenu) ? 'checked' : '' ?>
                                                    class="" type="checkbox" name="id_menus[]"
                                                    value="<?= $mainMenu['menu_id'] ?>"><?= $mainMenu['menu_name'] ?>
                                            </label>
                                            <ul>
                                                <?php foreach ($rowMenu as $subMenu): ?>
                                                    <?php if ($subMenu['parent_id'] == $mainMenu['menu_id']): ?>
                                                        <li>
                                                            <label for="" class="">
                                                                <input
                                                                    <?= in_array($subMenu['menu_id'], $rowEditRoleMenu) ? 'checked' : '' ?>
                                                                    class="" type="checkbox" name="id_menus[]"
                                                                    value="<?= $subMenu['menu_id'] ?>"><?= $subMenu['menu_name'] ?>
                                                            </label>
                                                        </li>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </ul>

                                        </div>
                                    </li>
                                <?php endif ?>
                            <?php endforeach ?>
                            <div class="mb-3" align="right">
                                <button type="submit" class="btn btn-primary" name="save_menu">Save Changes</button>
                            </div>
            </div>
            </form>
            </ul>
        <?php else: ?>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Role *</label>
                    <!-- <select name="role_id" id="" class="form-control">
                            <option value="">Choose one</option>
                            <?php foreach ($rowRole as $role): ?>
                                <option
                                <?= (isset($rowEdit) && $role['role_id'] == $rowEdit['role_id']) ? 'selected' : '' ?>
                                value="<?= $role['role_id'] ?>">
                                <?= $role['role_name'] ?>
                            </option>
                            <?php endforeach ?>
                        </select> -->

                    <input type="text" class="form-control" name="role_name" placeholder="Enter Roles"
                        value="<?= isset($_GET['edit']) ? $rowEdit['role_name'] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-success"
                        name="<?= isset($roleId) && $roleId != '' ? 'edit' : 'save'; ?>"
                        value="<?= isset($roleId) && $roleId != '' ? 'Update' : 'Save'; ?>">

            </form>
        </div>
    <?php endif ?>
    </div>
</div>
</div>