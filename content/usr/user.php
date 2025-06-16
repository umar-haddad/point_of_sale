<?php
$queryUser = mysqli_query($config, "SELECT * FROM users WHERE deleted_at = 0 ORDER BY users.user_id DESC");
$rowUser = mysqli_fetch_all($queryUser, MYSQLI_ASSOC);
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body ">
                <h5 class="card-title">Data User</h5>
                <div class="mb-3 d-flex justify-content-between">
                    <a href="?page=/usr/add_user" class="btn btn-primary">Add User</a>
                    <a href="?page=/usr/restore_user" class="btn btn-success">Recycle Bin</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="">
                            <tr>
                                <th>Number</th>
                                <th>Name</th>
                                <th>Email</th>
                                <!-- <th>Role</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rowUser as $key => $user) : ?>
                                <tr>
                                    <td><?= $key += 1 ?></td>
                                    <td><?= $user['user_name'] ?></td>
                                    <td><?= $user['user_email'] ?></td>
                                    <!-- <td><?= $user['role_name'] ?></td> -->
                                    <td class="d-flex justify-content-center">
                                        <a href="?page=/usr/add_user&add-user-role=<?= $user['user_id'] ?>"
                                            class="btn btn-info me-2 ms-2">Add User Role</a>
                                        <a href="?page=/usr/add_user&edit=<?= $user['user_id'] ?>"
                                            class="btn btn-primary me-2 ms-2">Edit</a>
                                        <a onclick="return confirm('Are you Sure want to delete this data??')"
                                            href="?page=/usr/add_user&delete=<?= $user['user_id'] ?>"
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