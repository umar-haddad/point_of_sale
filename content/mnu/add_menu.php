<?php

$edit = isset($_GET['edit']) ? $_GET['edit'] : '';
if (isset($_POST['save'])) {
    $menuName = $_POST['menu_name'];
    $parentId = $_POST['parent_id'];
    $menuIcon = $_POST['menu_icon'];
    $menuUrl = $_POST['menu_url'];
    $menuOrder = $_POST['menu_order'];

    $insert = mysqli_query($config, "INSERT INTO menus (menu_name, parent_id, menu_icon, menu_url, menu_order) VALUES ('$menuName', '$parentId', '$menuIcon', '$menuUrl', '$menuOrder') ");
    header("location:?page=/mnu/menu&add=success");
}

if (isset($_GET['edit'])) {
    $queryedit = mysqli_query($config, "SELECT * FROM menus WHERE menu_id = '$edit'");
    $rowedit = mysqli_fetch_assoc($queryedit);
    if (isset($_POST['menu_name'])) {
        $menuName = $_POST['menu_name'];
        $parentId = $_POST['parent_id'];
        $menuIcon = $_POST['menu_icon'];
        $menuUrl = $_POST['menu_url'];
        $menuOrder = $_POST['menu_order'];
        $update = mysqli_query($config, "UPDATE menus SET menu_name='$menuName', parent_id='$parentId', menu_icon='$menuIcon', menu_url='$menuUrl', menu_order='$menuOrder' WHERE menu_id='$edit' ");
        header("location:?page=/mnu/menu&edit=success");
    }
}


$queryParentID = mysqli_query($config, "SELECT * FROM menus WHERE parent_id=0 OR parent_id=''");
$rowParentID = mysqli_fetch_all($queryParentID, MYSQLI_ASSOC);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= isset($_GET['edit']) ? 'Edit' : 'Add' ?> Role</h5>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Parent ID</label>
                        <select name="parent_id" id="" class="form-control">
                            <option value="">Select One</option>

                            <?php foreach ($rowParentID as $parentID): ?>
                                <option <?= isset($_GET['edit']) ? $parentID['menu_id'] ? 'selected' : '' : '' ?>
                                    value="<?= $parentID['menu_id'] ?>">
                                    <?= $parentID['menu_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Name *</label>
                        <input type="text" class="form-control" name="menu_name" placeholder="Enter Menu Name"
                            value="<?= isset($_GET['edit']) ? $rowedit['menu_name'] : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Icon *</label>
                        <input type="text" class="form-control" name="menu_icon" placeholder="Enter Icon"
                            value="<?= isset($_GET['edit']) ? $rowedit['menu_icon'] : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Url </label>
                        <input type="text" class="form-control" name="menu_url" placeholder="Enter Url"
                            value="<?= isset($_GET['edit']) ? $rowedit['menu_url'] : '' ?>">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Order *</label>
                        <input type="number" class="form-control" name="menu_order" placeholder="Order"
                            value="<?= isset($_GET['edit']) ? $rowedit['menu_order'] : '' ?>" required>
                    </div>



                    <!-- <input type="text" class="form-control" name="role_name" placeholder="Enter Roles"
                            value="<?= isset($_GET['edit']) ? $rowEdit['role_name'] : '' ?>" required>
                    </div> -->
                    <div class="mb-3">
                        <input type="submit" class="btn btn-success"
                            name="<?= isset($edit) && $edit != '' ? 'edit' : 'save'; ?>"
                            value="<?= isset($edit) && $edit != '' ? 'Update' : 'Save'; ?>">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>