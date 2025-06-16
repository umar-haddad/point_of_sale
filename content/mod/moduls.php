<?php
// $queryUser = mysqli_query($config, "SELECT roles.role_name, users.* FROM users LEFT JOIN roles ON roles.role_id = users.id_role WHERE deleted_at = 0 ORDER BY users.user_id DESC");
// $rowUser = mysqli_fetch_all($queryUser, MYSQLI_ASSOC);
$id_user = isset($_SESSION['ID_USER']) ? $_SESSION['ID_USER'] : '';
$rowStudent = mysqli_fetch_assoc(mysqli_query($config, "SELECT * FROM students WHERE student_id = '$id_user'"));
$id_major = isset($rowStudent['id_major']);

if ($_role == 2) {
    $where = "WHERE moduls.id_major='$id_major'";
} elseif ($_role == 1) {
    $where = "WHERE moduls.id_instructor='$id_user'";
}
$query = mysqli_query($config, "SELECT majors.major_name, instructors.instructor_name, moduls.*
                                                    FROM moduls 
                                                    LEFT JOIN majors ON majors.major_id = moduls.id_major
                                                    LEFT JOIN instructors ON instructors.instructor_id = moduls.id_instructor
                                                    $where
                                                    ORDER BY moduls.modul_id DESC");
$row = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body ">
                <h5 class="card-title">Data Moduls</h5>
                <?php if (addingModule(1)): ?>
                    <div class="mb-3" align="right">
                        <a href="?page=/mod/add_modul" class="btn btn-success">Add Modul</a>
                    </div>
                <?php endif ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="">
                            <tr>
                                <th>Number</th>
                                <th>Title</th>
                                <th>Instructor</th>
                                <th>Major</th>
                                <?php if ($_role == 1): ?>
                                    <th>Action</th>
                                <?php endif ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($row as $key => $mod) : ?>
                                <tr>
                                    <td><?= $key += 1 ?></td>
                                    <td><a href="?page=/mod/add_modul&detail=<?= $mod['modul_id'] ?>" <i
                                            class="bi bi-link"></i><?= $mod['modul_name'] ?></a>
                                    </td>
                                    <td><?= $mod['instructor_name'] ?></td>
                                    <td><?= $mod['major_name'] ?></td>
                                    <!-- <td><?= $mod['role_name'] ?></td> -->
                                    <?php if (addingModule(1)): ?>
                                        <td class="d-flex justify-content-center">
                                            <a href="?page=/mod/add_modul&detail=<?= $mod['modul_id'] ?>"
                                                class="btn btn-primary me-2 ms-2">Details</a>
                                            <a onclick="return confirm('Are you Sure want to delete this data??')"
                                                href="?page=/mod/add_modul&delete=<?= $mod['modul_id'] ?>"
                                                class="btn btn-danger me-2 ms-2">Delete</a>
                                        </td>
                                    <?php endif ?>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>