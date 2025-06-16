<?php
$userId = isset($_GET['edit']) ? $_GET['edit'] : '';

if (isset($_POST['save'])) {
    //ada tidak parameter bernama edit, kalau ada jalankan perintah edit, jika tidak maka akan menyimpan baru
    $userName = $_POST['user_name'];
    $userEmail = $_POST['user_email'];
    $userPassword = sha1($_POST['user_password']);
    $userId = isset($_GET['edit']) ? $_GET['edit'] : '';
    $queryInsert = mysqli_query($config, "INSERT INTO users (user_name, user_email, user_password) VALUES ('$userName', '$userEmail', '$userPassword')");
    header("location:?page=/usr/user&add=success");
}
if (isset($_GET['edit'])) {
    $queryEdit = mysqli_query($config, "SELECT * FROM users WHERE user_id = $userId");
    $rowEdit = mysqli_fetch_assoc($queryEdit);
}
if (isset($_POST['edit'])) {
    $userName = $_POST['user_name'];
    $userEmail = $_POST['user_email'];
    $userPassword = isset($_POST['user_password']) ? sha1($_POST['user_password']) : $rowEdit['user_password'];
    // if (empty($_POST['user_password'])) {
    //     $userPassword = $rowEdit['user_password'];
    // } else {
    //     $userPassword = sha1($_POST['user_password']);
    // }
    $queryUpdate = mysqli_query($config, "UPDATE users SET user_name='$userName', user_email='$userEmail', user_password='$userPassword' WHERE user_id = $userId");
    header("location:?page=/usr/user&update=success");
}


if (isset($_GET['delete'])) {
    $user_id = isset($_GET['delete']) ? $_GET['delete'] : '';
    $queryDelete = mysqli_query($config, "UPDATE users SET deleted_at = 1 WHERE user_id = '$user_id'");
    if ($queryDelete) {
        header("location:?page=/usr/user&delete=success");
    } else {
        header("location:?page=/usr/user&delete=failed");
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= isset($_GET['edit']) ? 'Edit' : 'Add' ?> User</h5>
                <form action="" method="post">

                    <div class="mb-3">
                        <label for="" class="form-label">Full Name *</label>
                        <input type="text" class="form-control" name="user_name" placeholder="Enter your Name"
                            value="<?= isset($_GET['edit']) ? $rowEdit['user_name'] : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Email *</label>
                        <input type="email" class="form-control" name="user_email" placeholder="Enter your Email"
                            value="<?= isset($_GET['edit']) ? $rowEdit['user_email'] : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Password *</label>
                        <input type="password" class="form-control" name="user_password"
                            placeholder="Enter your Password" <?= empty($userId) ? 'required' : ''; ?>>
                        <?php if (isset($_GET['edit'])) : ?>
                            <small>
                                You can change your password by filling the above field
                            </small>
                        <?php endif ?>
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-success"
                            name="<?= isset($userId) && $userId != '' ? 'edit' : 'save'; ?>"
                            value="<?= isset($userId) && $userId != '' ? 'Update' : 'Save'; ?>">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>