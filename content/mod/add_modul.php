<?php
// $instructorId = isset($_GET['edit']) ? $_GET['edit'] : '';
// if (isset($_POST['save'])) {
//     //ada tidak parameter bernama edit, kalau ada jalankan perintah edit, jika tidak maka akan menyimpan baru
//     $instName = $_POST['instructor_name'];
//     $instGender = $_POST['instructor_gender'];
//     $instEd = $_POST['instructor_education'];
//     $instPhone = $_POST['instructor_phone'];
//     $instEmail = $_POST['instructor_email'];
//     $instPassword = sha1($_POST['instructor_password']);
//     $instAddr = $_POST['instructor_address'];
//     $instructorId = isset($_GET['edit']) ? $_GET['edit'] : '';
//     $queryInsert = mysqli_query($config, "INSERT INTO instructors (instructor_name, instructor_gender, instructor_education, instructor_phone, instructor_email, instructor_password instructor_address) VALUES ('$instName','$instGender', '$instEd', '$instPhone', '$instEmail', '$instPassword' '$instAddr')");
//     header("location:?page=/instruct/instructor&add=success");
// }
// if (isset($_GET['edit'])) {
//     $queryEdit = mysqli_query($config, "SELECT * FROM instructors WHERE instructor_id = $instructorId");
//     $rowEdit = mysqli_fetch_assoc($queryEdit);
// }

// if (isset($_POST['edit'])) {
//     $instName = $_POST['instructor_name'];
//     $instGender = $_POST['instructor_gender'];
//     $instEd = $_POST['instructor_education'];
//     $instPhone = $_POST['instructor_phone'];
//     $instEmail = $_POST['instructor_email'];
//     $instPassword = isset($_POST['instructor_password']) ? sha1($_POST['instructor_password']) : $rowEdit['instructor_password'];
//     $instAddr = $_POST['instructor_address'];
//     $queryUpdate = mysqli_query($config, "UPDATE instructors SET instructor_name='$instName', instructor_gender='$instGender', instructor_education='$instEd', instructor_phone='$instPhone', instructor_email='$instEmail', instructor_password='$instPassword', instructor_address='$instAddr' WHERE instructor_id = $instructorId");
//     header("location:?page=/instruct/instructor&update=success");
// }



// if (isset($_GET['delete'])) {
//     $instructor_id = isset($_GET['delete']) ? $_GET['delete'] : '';
//     $queryDelete = mysqli_query($config, "UPDATE instructors SET deleted_at = 1 WHERE instructor_id = '$instructor_id'");
//     if ($queryDelete) {
//         header("location:?page=/instruct/instructor&delete=success");
//     } else {
//         header("location:?page=/instruct/instructor&delete=failed");
//     }
// }

$id_instructor = isset($_id) ? $_id : '';
$queryInstructMajor = mysqli_query($config, "SELECT majors.major_name, instructor_major.* 
                                                            FROM instructor_major LEFT JOIN majors ON majors.major_id = instructor_major.id_major
                                                            WHERE instructor_major.id_instructor=$id_instructor");
$rowInstructMajor = mysqli_fetch_all($queryInstructMajor, MYSQLI_ASSOC);

if (isset($_POST['save'])) {
    $idInstructor = $_POST['id_instructor'];
    $idMajor = $_POST['id_major'];
    $modulName = $_POST['modul_name'];
    $queryInsert = mysqli_query($config, "INSERT INTO moduls (id_instructor, id_major, modul_name) VALUES ('$idInstructor', '$idMajor', '$modulName')");
    if ($queryInsert) {
        $idModul = mysqli_insert_id($config);
        // $_FILES = 

        foreach ($_FILES['file']['name'] as $index => $file) {
            if ($_FILES['file']['error'][$index] == 0) {
                $modulName = basename($_FILES['file']['name'][$index]);
                $fileName = uniqid() . "-" . $modulName;
                $path = "Modul_Files/";
                $targetPath = $path . $fileName;

                if (move_uploaded_file($_FILES['file']['tmp_name'][$index], $targetPath)) {
                    $queryModulDetail = mysqli_query($config, "INSERT INTO modul_details (id_modul, md_file) VALUES ('$idModul', '$fileName')");
                    // print_r($queryModulDetail);
                    // die;
                }
            }
        }
        header(header: "location:?page=/mod/moduls&add=success");
    }
}

if (isset($_GET['delete'])) {
    $idd = $_GET['delete'];
    $queryFiles = mysqli_query($config, "SELECT md_file FROM modul_details WHERE id_modul = $idd");
    $rowFiles = mysqli_fetch_assoc($queryFiles);
    unlink('Modul_Files/' . $rowFiles['md_file']);
    $queryDeleteModuls = mysqli_query($config, "DELETE FROM modul_details WHERE id_modul='$idd'");
    $queryDeleteModuls = mysqli_query($config, "DELETE FROM moduls WHERE modul_id='$idd'");
    if ($queryDeleteModuls) {
        header("location:?page=/mod/moduls&delete=success");
    } else {
        header("location:?page=/mod/moduls&delete=failed");
    }
}

$id_modul = isset($_GET['detail']) ? $_GET['detail'] : '';
$queryModul = mysqli_query($config, "SELECT majors.major_name, instructors.instructor_name, moduls.*
                                                FROM moduls 
                                                LEFT JOIN majors ON majors.major_id = moduls.id_major
                                                LEFT JOIN instructors ON instructors.instructor_id = moduls.id_instructor 
                                                WHERE moduls.modul_id = '$id_modul'");
$rowModul = mysqli_fetch_assoc($queryModul);

$queryDetailModul = mysqli_query($config, "SELECT * FROM modul_details WHERE id_modul = '$id_modul'");
$rowDetailModul = mysqli_fetch_all($queryDetailModul, MYSQLI_ASSOC);

if (isset($_GET['download'])) {
    $file = $_GET['download'];
    $filePath = "Modul_Files/" . $file;
    if (file_exists($filePath)) {
        header("Content-Description: File Transfer");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=" . basename($filePath));
        header("Expires:0");
        header("Cache-Control:-must-revalidate");
        header("Pragma:public");
        header("Content-Length:" . filesize($filePath));
        ob_clean();
        readfile($filePath);

        exit;
    }

    print_r($file);
    die;
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= isset($_GET['detail']) ? 'Detail' : 'Add' ?> Modul</h5>
                <?php if (isset($_GET['detail'])): ?>
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>Modul Name</th>
                                <th>:</th>
                                <td><?= $rowModul['modul_name'] ?></td>
                                <th>Major Name</th>
                                <th>:</th>
                                <td><?= $rowModul['major_name'] ?></td>
                            </tr>
                            <tr>
                                <th>Instructor Name</th>
                                <th>:</th>
                                <td><?= $rowModul['instructor_name'] ?></td>
                            </tr>
                        </thead>
                    </table>
                    <br>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rowDetailModul as $key => $dm): ?>
                                <tr>
                                    <td>
                                        <?= $key += 1 ?>
                                    </td>
                                    <td>
                                        <a target="_blank"
                                            href="?page=/mod/add_modul&download=<?= urlencode($dm['md_file']) ?>">
                                            <i class="bi bi-download"></i> <?= $dm['md_file'] ?>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Instructor Name </label>
                                    <input readonly type="text" class="form-control" value="<?= $_name ?>">
                                    <input type="hidden" name="id_instructor" class="form-control" value="<?= $_id ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Major Name</label>
                                    <select name="id_major" id="" class="form-control" required>
                                        <option value="">Select one--</option>
                                        <?php foreach ($rowInstructMajor as $rIM): ?>
                                            <option value="<?= $rIM['id_major'] ?>"><?= $rIM['major_name'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Modul Name *</label>
                                    <input type="text" name="modul_name" class="form-control" placeholder="Enter new Modul"
                                        required>
                                </div>
                            </div>

                        </div>

                        <div align="right" class="mb-3">
                            <button type="button" class="btn btn-primary addRow" id="addRow">Add Row</button>
                        </div>
                        <table class="table" id="tableModul">
                            <thead>
                                <tr>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>

                        <div class="mb-3">
                            <input type="submit" class="btn btn-success" name="save" value="Save">
                            <!-- name="<?= isset($instructorId) && $instructorId != '' ? 'edit' : 'save'; ?>"
                        value="<?= isset($instructorId) && $instructorId != '' ? 'Update' : 'Save'; ?>" -->
                        </div>

                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script>
    //var, let, const
    //var: tidak ada nilai, maka akan error, let harus mempunyai nilai
    //const: nilai tidak boleh berubah/statis
    //const nama = "bambang";
    //nama = "udin";
    // const button = document.getElementById('addRow');
    // const button = document.getElementsByClassName('addRow');
    const button = document.querySelector('.addRow');
    const tbody = document.querySelector('#tableModul tbody');
    //mengganti content suatu variable
    // button.textContent = "duar";
    //jika text == add Row maka akan menjadi duar
    button.addEventListener("click", function() {
        // alert('duar');
        const tr = document.createElement("tr"); //membuat <tr></tr>
        tr.innerHTML = `<td><input type='file' name='file[]'></td>
        <td><button class='btn btn-danger'>Delete</button></td>`; //menambahkan <td></td> kedalam tr

        tbody.appendChild(tr);
    })
</script>