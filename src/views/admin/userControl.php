<?php

session_start();

require '../../controllers/userController.php';

$dashUser = new Usercontroller;
$allusers = $dashUser->getAllusers();

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $userId = $_POST['user_id'];
//     $action = $_POST['action'];

//     $result = $dashUser->handleRequest($action, $userId);

//     echo json_encode(['success' => $result]);
//     exit;
// }

// if ($_SESSION['user_role'] != 'admin')
// {
//     $_SESSION['acess'] = 'access_denied';
//     header("Location: ../login.php");
//     exit();
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel - Youdemy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="../../../assets/styles/sidebarAdmin.css" rel="stylesheet" />
  
</head>

<body>
    <!-- Header with Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="bi bi-mortarboard-fill me-2"></i>
                Youdemy Admin
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./userControl.php">
                            <i class="bi bi-people me-1"></i> Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./tagsControl.php">
                            <i class="bi bi-tags me-1"></i> Tags
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./categorieControl.php">
                            <i class="bi bi-grid me-1"></i> Categories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/allCourses.php">
                            <i class="bi bi-collection-play me-1"></i> Courses
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../controllers/auth/logout.php">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4>User Management</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
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
                                            <img src="<?= htmlspecialchars($user['profil']) ?>" alt="<?= htmlspecialchars($user['profil']) ?>" class="rounded-circle" width="40" height="40" />
                                            <div class="ml-3">
                                                <p class="font-weight-bold mb-1"><?= htmlspecialchars($user['name']) ?></p>
                                                <p class="text-muted mb-0"><?= htmlspecialchars($user['email']) ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary"><?= htmlspecialchars($user['role']) ?></span>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                                    <td>
                                        <span class="statub badge bg-<?= $user['status'] === 'active' ? 'success' : ($user['status'] === 'suspended' ? 'warning' : 'secondary') ?>">
                                            <?= ucfirst($user['status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button data-id="<?= $user['id']; ?>" class="btn btn-success btn-sm activate-btn" style="<?= $user['status'] === 'active' ? 'display:none;' : 'display:inline-block;' ?>">Activate</button>
                                        <button data-id="<?= $user['id']; ?>" class="btn btn-warning btn-sm suspend-btn" style="<?= $user['status'] === 'suspended' ? 'display:none;' : 'display:inline-block;' ?>">Suspend</button>
                                        <button data-id="<?= $user['id']; ?>" class="btn btn-danger btn-sm delete-btn">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../../assets/js/usersAjax.js"></script>
</body>

</html>
