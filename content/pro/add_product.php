<?php
$pId = isset($_GET['edit']) ? $_GET['edit'] : '';

$queryCP = mysqli_query($config, "SELECT * FROM categories");
$rowCP = mysqli_fetch_all($queryCP, MYSQLI_ASSOC);

if (isset($_POST['save'])) {

    $idCat = $_POST['id_category'];
    $pName = $_POST['p_name'];
    $pPrice = $_POST['p_price'];
    $pQty = $_POST['p_qty'];
    $pDesc = $_POST['p_desc'];
    $pId = isset($_GET['edit']) ? $_GET['edit'] : '';
    $queryInsert = mysqli_query($config, "INSERT INTO products (id_category, p_name, p_price, p_qty, p_desc) VALUES ('$idCat', '$pName','$pPrice', '$pQty', '$pDesc')");
    header("location:?page=/pro/products&add=success");
}
if (isset($_GET['edit'])) {
    $queryEdit = mysqli_query($config, "SELECT * FROM products WHERE p_id = $pId");
    $rowEdit = mysqli_fetch_assoc($queryEdit);
}

if (isset($_POST['edit'])) {
    $pCat = $_POST['id_category'];
    $pName = $_POST['p_name'];
    $pPrice = $_POST['p_price'];
    $pQty = $_POST['p_qty'];
    $pDesc = $_POST['p_desc'];
    $queryUpdate = mysqli_query($config, "UPDATE products SET id_category='$idCat', p_name='$pName', p_price='$pPrice', p_qty='$pQty', p_desc='$pDesc' WHERE p_id = $pId");
    header("location:?page=/pro/products&update=success");
}



if (isset($_GET['delete'])) {
    $p_id = isset($_GET['delete']) ? $_GET['delete'] : '';
    $queryDelete = mysqli_query($config, "DELETE FROM products WHERE p_id = '$p_id'");
    if ($queryDelete) {
        header("location:?page=/pro/products&delete=success");
    } else {
        header("location:?page=/pro/products&delete=failed");
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= isset($_GET['edit']) ? 'Edit' : 'Add' ?> Product</h5>
                <form action="" method="post">

                    <div class="mb-3">
                        <label for="" class="form-label">Product Category *</label>
                        <select name="id_category" id="" class="form-control">
                            <option value="">Select one</option>
                            <?php foreach ($rowCP as $c): ?>
                                <option
                                    <?= isset($rowEdit) ? ($c['c_id'] == $rowEdit['id_category']) ? 'selected' : '' : '' ?>
                                    value="<?= $c['c_id'] ?>">
                                    <?= $c['c_name']  ?></option>
                            <?php endforeach ?>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Product Name *</label>
                        <input type="text" class="form-control" name="p_name" placeholder="Enter product's category"
                            value="<?= isset($_GET['edit']) ? $rowEdit['p_name'] : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Product Price *</label>
                        <input type="number" class="form-control" name="p_price" placeholder="Enter product's price"
                            value="<?= isset($_GET['edit']) ? $rowEdit['p_price'] : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Product Qty *</label>
                        <input type="number" class="form-control" name="p_qty" placeholder="Enter product's qty"
                            value="<?= isset($_GET['edit']) ? $rowEdit['p_qty'] : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Product Description *</label>
                        <input type="text" class="form-control" name="p_desc" placeholder="Enter product's description"
                            value="<?= isset($_GET['edit']) ? $rowEdit['p_desc'] : '' ?>">
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-success"
                            name="<?= isset($pId) && $pId != '' ? 'edit' : 'save'; ?>"
                            value="<?= isset($pId) && $pId != '' ? 'Update' : 'Save'; ?>">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>