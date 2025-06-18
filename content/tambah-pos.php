<?php
$userId = isset($_GET['edit']) ? $_GET['edit'] : '';

if (isset($_POST['save'])) {
    //ada tidak parameter bernama edit, kalau ada jalankan perintah edit, jika tidak maka akan menyimpan baru
    $userName = $_POST['user_name'];
    $userEmail = $_POST['user_email'];
    $userPassword = sha1($_POST['user_password']);
    $userId = isset($_GET['edit']) ? $_GET['edit'] : '';
    $queryInsert = mysqli_query($config, "INSERT INTO users (user_name, user_email, user_password) VALUES ('$userName', '$userEmail', '$userPassword')");
    header("location:?page=/usr/user&add=success");
}
if (isset($_GET['edit'])) {
    $queryEdit = mysqli_query($config, "SELECT * FROM users WHERE user_id = $userId");
    $rowEdit = mysqli_fetch_assoc($queryEdit);
}
if (isset($_POST['edit'])) {
    $userName = $_POST['user_name'];
    $userEmail = $_POST['user_email'];
    $userPassword = isset($_POST['user_password']) ? sha1($_POST['user_password']) : $rowEdit['user_password'];
    // if (empty($_POST['user_password'])) {
    //     $userPassword = $rowEdit['user_password'];
    // } else {
    //     $userPassword = sha1($_POST['user_password']);
    // }
    $queryUpdate = mysqli_query($config, "UPDATE users SET user_name='$userName', user_email='$userEmail', user_password='$userPassword' WHERE user_id = $userId");
    header("location:?page=/usr/user&update=success");
}


if (isset($_GET['delete'])) {
    $user_id = isset($_GET['delete']) ? $_GET['delete'] : '';
    $queryDelete = mysqli_query($config, "UPDATE users SET deleted_at = 1 WHERE user_id = '$user_id'");
    if ($queryDelete) {
        header("location:?page=/usr/user&delete=success");
    } else {
        header("location:?page=/usr/user&delete=failed");
    }
}

$id_user = isset($_GET['add-user-role']) ? $_GET['add-user-role'] : '';
$queryRoles = mysqli_query($config, "SELECT * FROM roles ORDER BY role_id Desc");
$rowRoles = mysqli_fetch_all($queryRoles, MYSQLI_ASSOC);

$queryUserRoles = mysqli_query($config, "SELECT user_roles.*, roles.role_name FROM user_roles
                              LEFT JOIN roles ON user_roles.id_role = roles.role_id
                              WHERE id_user = '$id_user'
                              ORDER BY user_roles.uR_id DESC");
$rowUserRoles = mysqli_fetch_all($queryUserRoles, MYSQLI_ASSOC);
// print_r($rowUserRoles);
// die;
if (isset($_POST['id_role'])) {
    $id_role = $_POST['id_role'];
    $queryInsert = mysqli_query($config, "INSERT INTO user_roles (id_role, id_user) VALUES ('$id_role', '$id_user')");
    header("location:?page=/usr/user&add-user-role=" . $id_user . "&add-role=success");
}

$queryProducts = mysqli_query($config, "SELECT * FROM products ORDER BY P_id DESC");
$rowProducts = mysqli_fetch_all($queryProducts, MYSQLI_ASSOC);
?>

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <?php if (isset($_GET['add-user-role'])):
                    $title = "Add User Role: ";
                elseif (isset($_GET['edit'])):
                    $title = "Edit User: ";
                else:
                    $title = "Add User: ";
                endif ?>
        <h5 class="card-title"><?= $title . $_name ?></h5>
        <?php if (isset($_GET['add-user-role'])): ?>
        <div align="right" class="mb-3">
          <button class="btn btn-primary" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Role
          </button>

        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Number</th>
              <th>Role</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rowUserRoles as $index => $uR): ?>
            <tr>
              <td><?= $index += 1 ?></td>
              <td><?= $uR['role_name'] ?></td>
              <td>
                <a href="?page=/usr/add_user&edit=<?= $uR['uR_id'] ?>" class="btn btn-primary me-2 ms-2">Edit</a>
                <a href="?page=/usr/add_user&delete=<?= $user['uR_id'] ?>" class="btn btn-danger me-2 ms-2">Delete</a>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <?php else: ?>
        <form action="" method="post">
          <div class="row">
            <div class="col-sm-4">
              <div class="mb-3">
                <label for="" class="form-label">Transaction *</label>
                <input type="text" class="form-control" name="no_transaction"
                  value="<?= isset($_GET['edit']) ? $rowEdit['user_name'] : '' ?>">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Product *</label>
                <select name="" id="id_product" class="form-control">
                  <option value="">Select one</option>
                  <?php foreach($rowProducts as $rowProduct)  ?>
                  <option value="<?php echo $rowProduct['p_id'] ?>">
                    <?php echo $rowProduct['p_name'] ?>
                  </option>
                </select>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="mb-3">
                <label for="" class="form-label">Cashier Name *</label>
                <input type="text" class="form-control" name="no_transaction"
                  value="<?php echo $_SESSION['USER_NAME'] ?>">
                <input type="hidden" class="form-control" value="<?php $_SESSION['ID_USER'] ?>" readonly>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="mb-2">
                <label for="" class="form-label">Transaction *</label>
                <input type="text" class="form-control" name="no_transaction"
                  value="<?= isset($_GET['edit']) ? $rowEdit['user_name'] : '' ?>">
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="" class="form-label">Email *</label>
            <input type="email" class="form-control" name="user_email" placeholder="Enter your Email"
              value="<?= isset($_GET['edit']) ? $rowEdit['user_email'] : '' ?>" required>
          </div>

          <div class="mb-3">
            <label for="" class="form-label">Password *</label>
            <input type="password" class="form-control" name="user_password" placeholder="Enter your Password"
              <?= empty($userId) ? 'required' : ''; ?>>
            <?php if (isset($_GET['edit'])) : ?>
            <small>
              You can change your password by filling the above field
            </small>
            <?php endif ?>
          </div>

          <div class="mb-3">
            <input type="submit" class="btn btn-success"
              name="<?= isset($userId) && $userId != '' ? 'edit' : 'save'; ?>"
              value="<?= isset($userId) && $userId != '' ? 'Update' : 'Save'; ?>">
          </div>

        </form>
        <?php endif ?>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Role</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <label for="" class="form-label">Role Name</label>
            <select name="id_role" id="" class="form-control">
              <option value="">Select One</option>
              <?php foreach ($rowRoles as $rowRole): ?>
              <option value="<?= $rowRole['role_id'] ?>"><?= $rowRole['role_name'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="modaldivoter m-3" align="right">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="add-user-role" class="btn btn-primary">Save
            changes</button>
        </div>
      </form>
    </div>
  </div>
</div>