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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
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
                        <?php foreach($tags as $tag):?>
                        <tr>
                            <td><?= $index++;?></td>
                            <td><?= htmlspecialchars($tag['name']);?></td>
                            <td>
                                <a href="categorieManagement.php?id=<?=$tag['id'];?>" class="btn btn-primary btn-sm" data-bs-toggle="modal" onclick="loadCategoryData(this)" 
                                data-bs-target="#editTagModal" data-id="<?= $tag['id']; ?>">Modify</a>
                                <a class="btn btn-danger btn-sm suppression" data-id="<?= $tag['id']; ?>">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach;?>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/js/usersAjax.js" defer></script>
    <script src="../../../assets/js/deletebutt.js" defer></script>

</body>
</html>
