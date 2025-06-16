<?php
$query = mysqli_query($config, "SELECT * FROM categories ORDER BY c_id DESC");
$row = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body ">
                <h5 class="card-title">Categories Data</h5>
                <div class="mb-3" align="right">
                    <a href="?page=/cat/add_categories" class="btn btn-success">Add Categories</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="">
                            <tr>
                                <th>Number</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($row as $key => $c) : ?>
                            <tr>
                                <td><?= $key += 1 ?></td>
                                <td><?= $c['c_name'] ?></td>
                                <td class="d-flex justify-content-center">
                                    <a href="?page=/cat/add_categories&edit=<?= $c['c_id'] ?>"
                                        class="btn btn-primary me-2 ms-2">Edit</a>
                                    <a onclick="return confirm('Are you Sure want to delete this data??')"
                                        href="?page=cat/add_categories&delete=<?= $c['c_id'] ?>"
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