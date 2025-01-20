<?php
session_start();
require_once __DIR__ . '/../../controllers/admin/DashboardController.php';


if ($_SESSION['user_role'] != 'admin')
{
    $_SESSION['acess'] = 'access_denied';
    header("Location: ../auth/login.php");
    exit();
}

$dashboard = new DashboardController();
$totalCourses = $dashboard->getTotalCourses();
$coursesByCategory = $dashboard->getCoursesByCategory();
$mostPopularCourse = $dashboard->getMostPopularCourse();
$topTeachers = $dashboard->getTopTeachers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Youdemy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .stat-card {
            border-left: 4px solid #0d6efd;
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.08);
        }
        .category-list {
            max-height: 300px;
            overflow-y: auto;
        }
        .top-teacher {
            border-left: 4px solid #198754;
            margin-bottom: 1rem;
            padding: 1rem;
            background-color: #f8f9fa;
            transition: transform 0.2s;
        }
        .top-teacher:hover {
            transform: translateX(5px);
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
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

    <main class="container py-4">
        <!-- Total Courses Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Total Courses</h6>
                                <h2 class="mb-0"><?= $totalCourses ?></h2>
                            </div>
                            <div class="h1 text-primary">
                                <i class="bi bi-journal-text"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <!-- Course Categories -->
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-grid me-2"></i>
                            Courses by Category
                        </h5>
                    </div>
                    <div class="card-body category-list">
                        <div class="list-group list-group-flush">
                            <?php foreach($coursesByCategory as $category): ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span><?= htmlspecialchars($category['category_name']) ?></span>
                                <span class="badge bg-primary rounded-pill">
                                    <?= $category['course_count'] ?> courses
                                </span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Teachers -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-trophy me-2"></i>
                            Top Teachers
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php foreach($topTeachers as $index => $teacher): ?>
                        <div class="top-teacher">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1"><?= htmlspecialchars($teacher['teacher_name']) ?></h6>
                                <span class="badge bg-success">Rank #<?= $index + 1 ?></span>
                            </div>
                            <p class="text-muted mb-0">
                                <i class="bi bi-journal-text me-1"></i>
                                <?= $teacher['course_count'] ?> Courses
                                <span class="ms-3">
                                    <i class="bi bi-people me-1"></i>
                                    <?= $teacher['total_students'] ?> Students
                                </span>
                            </p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Most Popular Course -->
        <?php if ($mostPopularCourse): ?>
        <div class="row">
            <div class="col-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-star-fill me-2"></i>
                            Most Popular Course
                        </h5>
                        <h3><?= htmlspecialchars($mostPopularCourse['title']) ?></h3>
                        <p class="mb-0">
                            <i class="bi bi-person-circle me-2"></i>
                            <?= htmlspecialchars($mostPopularCourse['teacher_name']) ?>
                            <span class="ms-3">
                                <i class="bi bi-folder me-2"></i>
                                <?= htmlspecialchars($mostPopularCourse['category_name']) ?>
                            </span>
                            <span class="ms-3">
                                <i class="bi bi-people me-2"></i>
                                <?= htmlspecialchars($mostPopularCourse['student_count']) ?> Students
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>