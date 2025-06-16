<?php
$instructorId = isset($_GET['edit']) ? $_GET['edit'] : '';
if (isset($_POST['save'])) {
    //ada tidak parameter bernama edit, kalau ada jalankan perintah edit, jika tidak maka akan menyimpan baru
    $idRole = 1;
    $instName = $_POST['instructor_name'];
    $instGender = $_POST['instructor_gender'];
    $instEd = $_POST['instructor_education'];
    $instPhone = $_POST['instructor_phone'];
    $instEmail = $_POST['instructor_email'];
    $instPassword = sha1($_POST['instructor_password']);
    $instAddr = $_POST['instructor_address'];
    $instructorId = isset($_GET['edit']) ? $_GET['edit'] : '';
    $queryInsert = mysqli_query($config, "INSERT INTO instructors (id_role, instructor_name, instructor_gender, instructor_education, instructor_phone, instructor_email, instructor_password instructor_address) VALUES ('$idRole', '$instName','$instGender', '$instEd', '$instPhone', '$instEmail', '$instPassword' '$instAddr')");
    header("location:?page=/instruct/instructor&add=success");
}
if (isset($_GET['edit'])) {
    $queryEdit = mysqli_query($config, "SELECT * FROM instructors WHERE instructor_id = $instructorId");
    $rowEdit = mysqli_fetch_assoc($queryEdit);
}

if (isset($_POST['edit'])) {
    $idRole = 1;
    $instName = $_POST['instructor_name'];
    $instGender = $_POST['instructor_gender'];
    $instEd = $_POST['instructor_education'];
    $instPhone = $_POST['instructor_phone'];
    $instEmail = $_POST['instructor_email'];
    $instPassword = isset($_POST['instructor_password']) ? sha1($_POST['instructor_password']) : $rowEdit['instructor_password'];
    $instAddr = $_POST['instructor_address'];
    $queryUpdate = mysqli_query($config, "UPDATE instructors SET id_role='$idRole', instructor_name='$instName', instructor_gender='$instGender', instructor_education='$instEd', instructor_phone='$instPhone', instructor_email='$instEmail', instructor_password='$instPassword', instructor_address='$instAddr' WHERE instructor_id = $instructorId");
    header("location:?page=/instruct/instructor&update=success");
}



if (isset($_GET['delete'])) {
    $instructor_id = isset($_GET['delete']) ? $_GET['delete'] : '';
    $queryDelete = mysqli_query($config, "UPDATE instructors SET deleted_at = 1 WHERE instructor_id = '$instructor_id'");
    if ($queryDelete) {
        header("location:?page=/instruct/instructor&delete=success");
    } else {
        header("location:?page=/instruct/instructor&delete=failed");
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= isset($_GET['edit']) ? 'Edit' : 'Add' ?> Instructor</h5>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Instructor Name *</label>
                        <input type="text" class="form-control" name="instructor_name" placeholder="Enter your Name"
                            value="<?= isset($_GET['edit']) ? $rowEdit['instructor_name'] : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Instructor Gender *</label>
                        <div>

                            <div class="mb-3">
                                <input type="radio" name="instructor_gender" value="1"
                                    <?= (isset($_GET['edit']) && $rowEdit['instructor_gender'] == '1') ? 'checked' : '' ?>
                                    required> Laki-Laki
                                <input type="radio" name="instructor_gender" value="0"
                                    <?= (isset($_GET['edit']) && $rowEdit['instructor_gender'] == '0') ? 'checked' : '' ?>
                                    required> Perempuan
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Instructor Education *</label>
                                <input type="text" class="form-control" name="instructor_education"
                                    placeholder="Enter your Name"
                                    value="<?= isset($_GET['edit']) ? $rowEdit['instructor_education'] : '' ?>"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Instructor Phone *</label>
                                <input type="text" class="form-control" name="instructor_phone"
                                    placeholder="Enter your Name"
                                    value="<?= isset($_GET['edit']) ? $rowEdit['instructor_phone'] : '' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email *</label>
                                <input type="email" class="form-control" name="instructor_email"
                                    placeholder="Enter your Email"
                                    value="<?= isset($_GET['edit']) ? $rowEdit['instructor_email'] : '' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Password *</label>
                                <input type="password" class="form-control" name="instructor_password"
                                    placeholder="Enter your Password" <?= empty($instructorId) ? 'required' : ''; ?>>
                                <?php if (isset($_GET['edit'])) : ?>
                                    <small>
                                        You can change your password by filling the above field
                                    </small>
                                <?php endif ?>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Address *</label>
                                <input type="text" class="form-control" name="instructor_address"
                                    placeholder="Enter your Email"
                                    value="<?= isset($_GET['edit']) ? $rowEdit['instructor_address'] : '' ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-success"
                                    name="<?= isset($instructorId) && $instructorId != '' ? 'edit' : 'save'; ?>"
                                    value="<?= isset($instructorId) && $instructorId != '' ? 'Update' : 'Save'; ?>">
                            </div>

                </form>
            </div>
        </div>
    </div>
</div>