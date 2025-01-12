<?php

// require '../../classes/User.php';
require '../../controllers/userController.php';

$dashUser = new Usercontroller;
$allusers = $dashUser->getAllusers();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $action = $_POST['action'];

    $result = $dashUser->handleRequest($action, $userId);

    echo json_encode(['success' => $result]);
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel - Youdemy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container my-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4>User Management</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Role</th>
                            <th>Date Joined</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allusers as $user): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?= htmlspecialchars($user['profil']) ?>" alt="<?= htmlspecialchars($user['profil']) ?>" class="rounded-circle" width="40" height="40">
                                        <div class="ml-3">
                                            <p class="font-weight-bold mb-1"><?= htmlspecialchars($user['name']) ?></p>
                                            <p class="text-muted mb-0"><?= htmlspecialchars($user['email']) ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary"><?= htmlspecialchars($user['role']) ?></span>
                                </td>
                                <td>
                                    <?= date('m/d/Y', strtotime($user['created_at'])) ?>
                                </td>
                                <td>
                                    <span class="statub badge badge-<?= $user['status'] === 'active' ? 'success' : ($user['status'] === 'suspended' ? 'warning' : 'secondary') ?>">
                                        <?= ucfirst($user['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <button data-id="<?= $user['id']; ?>"
                                        class="btn btn-success btn-sm activate-btn"
                                        style="<?= $user['status'] === 'active' ? 'display:none;' : 'display:inline-block;' ?>">
                                        Activate
                                    </button>

                                    <button data-id="<?= $user['id']; ?>"
                                        class="btn btn-warning btn-sm suspend-btn"
                                        style="<?= $user['status'] === 'suspended' ? 'display:none;' : 'display:inline-block;' ?>">
                                        Suspend
                                    </button>

                                    <button data-id="<?= $user['id']; ?>"
                                        class="btn btn-danger btn-sm delete-btn">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="../../../assets/js/usersAjax.js"></script>


</body>

</html>