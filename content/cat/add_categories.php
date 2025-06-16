<?php
$cId = isset($_GET['edit']) ? $_GET['edit'] : '';
if (isset($_POST['save'])) {
    //ada tidak parameter bernama edit, kalau ada jalankan perintah edit, jika tidak maka akan menyimpan baru
    $cName = $_POST['c_name'];
    $cId = isset($_GET['edit']) ? $_GET['edit'] : '';
    $queryInsert = mysqli_query($config, "INSERT INTO categories (c_name) VALUES ('$cName')");
    header("location:?page=/cat/categories&add=success");
}

if (isset($_POST['edit'])) {
    $cName = $_POST['c_name'];
    $queryUpdate = mysqli_query($config, "UPDATE categories SET c_name='$cName' WHERE c_id = $cId");
    header("location:?page=/cat/categories&update=success");
}
if (isset($_GET['edit'])) {
    $queryEdit = mysqli_query($config, "SELECT * FROM categories WHERE c_id = $cId");
    $rowEdit = mysqli_fetch_assoc($queryEdit);
}



if (isset($_GET['delete'])) {
    $c_id = isset($_GET['delete']) ? $_GET['delete'] : '';
    $queryDelete = mysqli_query($config, "UPDATE categories WHERE c_id = '$c_id'");
    if ($queryDelete) {
        header("location:?page=/cat/categories&delete=success");
    } else {
        header("location:?page=/cat/categories&delete=failed");
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= isset($_GET['edit']) ? 'Edit' : 'Add' ?> c</h5>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Name </label>
                        <input type="text" class="form-control" name="c_name" placeholder="Enter categories Name"
                            value="<?= isset($_GET['edit']) ? $rowEdit['c_name'] : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-success"
                            name="<?= isset($cId) && $cId != '' ? 'edit' : 'save'; ?>"
                            value="<?= isset($cId) && $cId != '' ? 'Update' : 'Save'; ?>">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>