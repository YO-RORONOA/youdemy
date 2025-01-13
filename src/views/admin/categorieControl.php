<?php

require_once __DIR__ . '/../../controllers/categorieController.php';

$controller = new CategorieController;
$categories = $controller->getAllCategories();
$index = 1;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories Management - Youdemy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Manage Categories</h4>
            </div>
            <div class="card-body">
                <form action="../../controllers/CategorieController.php" method="POST" class="mb-4">
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category Name:</label>
                        <input type="text" class="form-control" id="category_name" name="namecategorie" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success">Add Category</button>
                </form>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($categories as $categorie):?>
                        <tr>
                            <td><?= $index++;?></td>
                            <td><?= htmlspecialchars($categorie['name']);?></td>
                            <td>
                                <a href="categorieManagement.php?id=<?=$categorie['id'];?>" class="btn btn-primary btn-sm" data-bs-toggle="modal" onclick="loadCategoryData(this)" 
                                data-bs-target="#editCategoryModal" data-id="<?= $categorie['id']; ?>">Modify</a>
                                <a onclick= "fetchdata('Categoriecontroller', '<?= $categorie['id']; ?>', 'category')" class="btn btn-danger btn-sm suppression" data-id="<?= $categorie['id']; ?>">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>

                <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../controllers/CategorieController.php" method="POST">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name:</label>
                            <input type="text" class="form-control" id="category_modal" name="namecategorie" required>
                        </div>
                        <input type="hidden" name="category_id" id="category_id">
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
