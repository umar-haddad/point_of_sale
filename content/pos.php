<?php
$queryUser = mysqli_query($config, "SELECT users.user_name, transactions.* FROM transactions
LEFT JOIN users ON users.user_id = transactions.id_user
ORDER BY id DESC");
$rowUser = mysqli_fetch_all($queryUser, MYSQLI_ASSOC);
?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body ">
        <h5 class="card-title">Data Transaction</h5>
        <div class="mb-3">
          <a href="?page=tambah-pos" class="btn btn-primary" align="right">Add Transaction</a>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead class="">
              <tr>
                <th>No</th>
                <th>Transaction</th>
                <th>Cashier Name</th>
                <th>Email</th>
                <th>Subtotal</th>
                <th>action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rowUser as $key => $user) : ?>
              <tr>
                <td><?= $key += 1 ?></td>
                <td><?= $user['user_name'] ?></td>
                <td><?= $user['user_email'] ?></td>
                <td><?= $user['role_name'] ?></td>
                <td><?= "Rp" . $user['role_name'] ?></td>
                <td class="d-flex justify-content-center">
                  <a href="?page=tambah-pos&print=<?= $user['user_id'] ?>" class="btn btn-primary me-2 ms-2">print</a>
                  <a onclick="return confirm('Are you Sure want to delete this data??')"
                    href="?page=tambah-pos&delete=<?= $user['user_id'] ?>" class="btn btn-danger me-2 ms-2">Delete</a>
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