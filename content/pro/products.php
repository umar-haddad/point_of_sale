<?php
$query = mysqli_query($config, "SELECT products.*, categories.c_name 
                                                                                FROM products 
                                                                                LEFT JOIN categories ON categories.c_id = products.id_category ORDER BY products.p_id DESC");
$row = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body ">
                <h5 class="card-title">Product Data</h5>
                <div class="mb-3" align="right">
                    <a href="?page=/pro/add_product" class="btn btn-success">Add Product</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="">
                            <tr>
                                <th>Number</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Desc</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($row as $key => $product) : ?>
                            <tr>
                                <td><?= $key += 1 ?></td>
                                <td><?= $product['c_name'] ?></td>
                                <td><?= $product['p_name'] ?></td>
                                <td><?= $product['p_price'] ?></td>
                                <td><?= $product['p_qty'] ?></td>
                                <td><?= $product['p_desc'] ?></td>
                                <td class="d-flex justify-content-center">
                                    <!-- <a href="?page=/pro/add_product_major&id=<?= $product['p_id'] ?>"
                                            class="btn btn-secondary me-2 ms-2">Add Major</a> -->
                                    <a href="?page=/pro/add_product&edit=<?= $product['p_id'] ?>"
                                        class="btn btn-primary me-2 ms-2">Edit</a>
                                    <a onclick="return confirm('Are you Sure want to delete this data??')"
                                        href="?page=pro/add_product&delete=<?= $product['p_id'] ?>"
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