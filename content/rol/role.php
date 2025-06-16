<?php
// $query = mysqli_query($config, "SELECT users.user_name, users.user_email, roles.* FROM roles RIGHT JOIN users ON users.id_role = roles.role_id ORDER BY role_id DESC");
$query = mysqli_query($config, "SELECT * FROM roles ORDER BY role_id DESC");
$row = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body ">
                <h5 class="card-title">Data User</h5>
                <div class="mb-3" align="right">
                    <a href="?page=/rol/add_role&new_role" class="btn btn-success">Add Role</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="">
                            <tr>
                                <th>Number</th>
                                <!-- <th>Username</th>
                                <th>Email</th> -->
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($row as $key => $role) : ?>
                                <tr>
                                    <td><?= $key += 1 ?></td>
                                    <!-- <td><?= $role['user_name'] ?></td>
                                    <td><?= $role['user_email'] ?></td> -->
                                    <td><?= $role['role_name'] ?></td>
                                    <td class="d-flex justify-content-center">
                                        <a href="?page=/rol/add_role&add_role_menu=<?= $role['role_id'] ?>"
                                            class="btn btn-info me-2 ms-2">Access</a>
                                        <a href="?page=/rol/add_role&edit=<?= $role['role_id'] ?>"
                                            class="btn btn-primary me-2 ms-2">Edit</a>
                                        <a onclick="return confirm('Are you Sure Want to Delete This Data??')"
                                            href="?page=/rol/add_role&delete=<?= $role['role_id'] ?>"
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