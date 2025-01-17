<?php

require '../../controllers/student/coursesController.php';


$controller = new CoursesController;
$allcourses = $controller->fetchAllCourses();
// print_r($allcourses);
// $course = $allcourses[1];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Listing - Youdemy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- <link href="../../../assets/styles/sidebarAdmin.css" rel="stylesheet"> -->
    <link href="../../../assets/styles/allcourses.css" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Youdemy</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <form class="search-form">
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Search for courses...">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="./createCourse.php">Create Course</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./displaycourse.php">Manage Courses</a>
                    </li>
                </ul>

                <div class="navbar-nav ml-auto">
                    <?php if (isset($_SESSION['user_role'])): ?>
                        <a class="btn btn-outline-danger" href="logout.php">Logout</a>
                    <?php else: ?>
                        <a class="nav-link" href="login.php">Login</a>
                        <a class="btn btn-primary" href="register.php">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <h1 class="text-center mb-4">Your Courses</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($allcourses as $course): ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="../../../assets/pics/2020_05_software-development-i1.jpg" class="card-img-top" alt="Course Image">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($course['title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($course['description']) ?></p>
                            <button class="btn btn-primary subscribe-btn" data-id="<?= $course['id'] ?>">Subscribe to Course</button>
                            <form action="./course.php" method="POST" style="display:inline;">
                                <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                                <button type="submit" class="btn btn-outline-primary check-course-btn">Check Course</button>
                            </form>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">4.5 (200 reviews)</small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>