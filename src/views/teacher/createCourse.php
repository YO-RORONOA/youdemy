<?php

require_once __DIR__ . '/../../controllers/categorieController.php';
require_once __DIR__ . '/../../controllers/TagController.php';


if ($_SESSION['user_role'] != 'teacher')
{
    $_SESSION['acess'] = 'access_denied';
    header("Location: ../auth/login.php");
    exit();
}
if ($_SESSION['user_role'] == 'teacher' && $_SESSION['user_role'] == 'inactive' )
{
    $_SESSION['acess'] = 'your account is not active';
    header("Location: ../auth/login.php");
    exit();
}
if ($_SESSION['user_role'] == 'teacher' && $_SESSION['user_role'] == 'deleted' )
{
    $_SESSION['acess'] = 'your account is deleted';
    header("Location: ../auth/login.php");
    exit();
}
$controller = new CategorieController;
$categories = $controller->getAllCategories();

$tagcontroller = new TagController;
$tags = $tagcontroller->getAllTags();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course - Teacher Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../assets/styles/styles.css">
    <link rel="stylesheet" href="../../../assets/styles/checkbox.css">
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui-pro@5.9.0/dist/css/coreui.min.css" rel="stylesheet" integrity="sha384-Ve7hQpTs/xy/JZqnD4/SWFwF0wi2txt/YGb48ABl4PnkLahmKdTS0EMBgFX2v4Hr" crossorigin="anonymous">
    <link href="../../../assets/styles/teacherheader.css" rel="stylesheet">
    <link href="../../../assets/styles/allcourses.css" rel="stylesheet">




</head>

</head>
<body>
    <!-- Header with Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Course Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="./createCourse.php">Create Course</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./displaycourse.php">Manage Couses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./subscriptionManagment.php">subscription Management</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2 search-bar" type="search" placeholder="Search" aria-label="Search" />
            </form>
        </div>
    </nav>

    <div class="container my-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4>Create a New Course</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="../../controllers/teachercontroller/CourseController.php" id="createCourseForm">
                    <div class="form-group">
                        <label for="courseTitle">Course Title</label>
                        <input type="text" class="form-control" id="courseTitle" name="title" placeholder="Enter course title" required>
                    </div>
                    <div class="form-group">
                        <label for="courseDescription">Course Description</label>
                        <textarea class="form-control" id="courseDescription" name="description" rows="4" placeholder="Enter course description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="contentType">Content Type</label>
                        <select class="form-control" id="contentType" name="contentType" required>
                            <option value="video">Video</option>
                            <option value="document">Document</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="contentUrl">Content URL</label>
                        <input type="url" class="form-control" id="contentUrl" name="contentUrl" placeholder="Enter content URL" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="">Select a category</option>
                            <!-- Populate categories dynamically -->
                            <?php foreach ($categories as $categorie): ?>
                                <option value="<?= $categorie['id'] ?>"><?= $categorie['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group overflow-scrol" >
                        <label for="tags">Tags</label>
                        <div id="tags" class="checkbox-group overflow-scrol">
                            <?php foreach ($tags as $tag): ?>
                                <label class="checkbox-label">
                                    <input name="tags[]" type="checkbox" value="<?= $tag['id'] ?>"><?= $tag['name'] ?> </input>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="wallpaperUrl">Wallpaper URL</label>
                        <input type="url" class="form-control" id="wallpaperUrl" name="wallpaperUrl" placeholder="Enter wallpaper URL">
                    </div>
                    <div class="form-group">
                        <label for="videoHours">On-Demand Video Hours</label>
                        <input type="number" class="form-control" id="videoHours" name="videoHours" placeholder="Enter hours of video" required>
                    </div>
                    <div class="form-group">
                        <label for="articles">Number of Articles</label>
                        <input type="number" class="form-control" id="articles" name="articles" placeholder="Enter number of articles" required>
                    </div>
                    <div class="form-group">
                        <label for="resources">Downloadable Resources</label>
                        <input type="number" class="form-control" id="resources" name="resources" placeholder="Enter number of resources" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Course</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>