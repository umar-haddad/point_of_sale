<?php
// $query = mysqli_query($config, "SELECT users.user_name, users.user_email, roles.* FROM roles RIGHT JOIN users ON users.id_role = roles.role_id ORDER BY role_id DESC");
$query = mysqli_query($config, "SELECT * FROM menus ORDER BY menu_id DESC");
$row = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body ">
                <h5 class="card-title">Data Menu</h5>
                <div class="mb-3" align="right">
                    <a href="?page=/mnu/add_menu&new_menu" class="btn btn-success">Add Menu</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="">
                            <tr>
                                <th>Number</th>
                                <th>Parent ID</th>
                                <th>Name</th>
                                <th>Icon</th>
                                <th>Url</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($row as $key => $role) : ?>
                                <tr>
                                    <td><?= $key += 1 ?></td>
                                    <td><?= $role['parent_id'] ?></td>
                                    <td><?= $role['menu_name'] ?></td>
                                    <td><?= $role['menu_icon'] ?></td>
                                    <td><?= $role['menu_url'] ?></td>
                                    <td class="d-flex justify-content-center">
                                        <a href="?page=/mnu/add_menu&edit=<?= $role['menu_id'] ?>"
                                            class="btn btn-primary me-2 ms-2">Edit</a>
                                        <a onclick="return confirm('Are you Sure Want to Delete This Data??')"
                                            href="?page=/mnu/add_menu&delete=<?= $role['menu_id'] ?>"
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