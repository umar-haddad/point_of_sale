<?php

$query = mysqli_query($config, "SELECT * FROM users WHERE deleted_at = 1 ORDER BY user_id DESC");
$row = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_GET['restore'])) {
    $idRes = $_GET['restore'];
    $queryRes = mysqli_query($config, "UPDATE users SET deleted_at = 0 WHERE user_id='$idRes'");
    if ($queryRes) {
        header("location:?page=/usr/user");
    }
}

if (isset($_GET['delete'])) {
    $idDel = $_GET['delete'];
    $queryDel = mysqli_query($config, "DELETE FROM users WHERE user_id='$idDel'");
    if ($queryDel) {
        header("location:?page=/usr/user");
    }
}

?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body ">
                <h5 class="card-title">Data User</h5>
                <div class="mb-3 d-flex justify-content-between">
                    <a href="?page=/usr/user" class="btn btn-secondary">Back</a>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="">
                            <tr>
                                <th>Number</th>
                                <th>Name</th>
                                <th>Email</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($row as $key => $user) : ?>
                                <tr>
                                    <td><?= $key += 1 ?></td>
                                    <td><?= $user['user_name'] ?></td>
                                    <td><?= $user['user_email'] ?></td>

                                    <td class="d-flex justify-content-center">
                                        <a href="?page=/usr/restore_user&restore=<?= $user['user_id'] ?>"
                                            class="btn btn-success me-2 ms-2">Restore</a>
                                        <a onclick="return confirm('Are you Sure want to delete this data??')"
                                            href="?page=/usr/restore_user&delete=<?= $user['user_id'] ?>"
                                            class="btn btn-danger me-2 ms-2">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>