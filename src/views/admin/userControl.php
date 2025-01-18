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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../../../assets/styles/sidebarAdmin.css" rel="stylesheet" />
    <style>
        .navbar {
            background-color: rgb(0, 128, 255);
        }

        .navbar .nav-link {
            color: #fff;
        }

        .navbar .nav-link:hover {
            background-color: rgb(28, 114, 194);
            border-radius: 5px;
        }

        .navbar-brand {
            color: #fff;
            font-weight: bold;
        }

        .search-bar {
            width: 100%;
            max-width: 400px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        @media (max-width: 768px) {
            .navbar .nav-link {
                display: block;
                margin: 5px 0;
            }

            .search-bar {
                margin-top: 10px;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Header with Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./userControl.php">User Control</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./tagsControl.php">Tag Control</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./categorieControl.php">Category Control</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Courses Control</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2 search-bar" type="search" placeholder="Search" aria-label="Search" />
            </form>
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
                                        <span class="badge badge-primary"><?= htmlspecialchars($user['role']) ?></span>
                                    </td>
                                    <td><?= date('m/d/Y', strtotime($user['created_at'])) ?></td>
                                    <td>
                                        <span class="statub badge badge-<?= $user['status'] === 'active' ? 'success' : ($user['status'] === 'suspended' ? 'warning' : 'secondary') ?>">
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
