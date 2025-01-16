<?php

require_once __DIR__ . '/../../controllers/TagController.php';

$controller = new TagController;
$tags = $controller->getAllTags();
$index = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tags Management - Youdemy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../assets/styles/sidebarAdmin.css" rel="stylesheet">
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
                    <a class="nav-link" href="./dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./userControl.php">User Control</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./tagsControl.php">Tag Control</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./categorieControl.php">Category Control</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Courses Control</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2 search-bar" type="search" placeholder="Search" aria-label="Search">
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Manage Tags</h4>
            </div>
            <div class="card-body">
                <form action="../../controllers/TagController.php" method="POST" class="mb-4">
                    <div class="mb-3">
                        <label for="tag_name" class="form-label">Tag Name:</label>
                        <input type="text" class="form-control" id="tag_name" name="nametag" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success">Add Tag</button>
                </form>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tag Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tags as $tag): ?>
                            <tr>
                                <td><?= $index++; ?></td>
                                <td><?= htmlspecialchars($tag['name']); ?></td>
                                <td>
                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editTagModal" onclick="loadData('Tagcontroller', '<?= $tag['id'] ?>')">Modify</a>
                                <a onclick="fetchdata('Tagcontroller', '<?= $tag['id'] ?>', 'tag')" class="btn btn-danger btn-sm tag-del" data-id="<?= $tag['id']; ?>">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editTagModal" tabindex="-1" aria-labelledby="editTagModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTagModalLabel">Edit Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../controllers/TagController.php" method="POST">
                        <div class="mb-3">
                            <label for="tag_name" class="form-label">Tag Name:</label>
                            <input type="text" class="form-control" id="tag_modal" name="nametag" required>
                        </div>
                        <input type="hidden" name="tag_id" id="tag_id">
                        <button type="submit" name="submit" class="btn btn-success">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../../assets/js/edit.js" defer></script>
    <script src="../../../assets/js/deletebutt.js" defer></script>
</body>

</html>
