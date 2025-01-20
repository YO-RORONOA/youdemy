<?php
session_start();
require_once __DIR__ . '/controllers/home/homepage.php';


$homePage = new HomePage();
$stats = $homePage->getStatistics();
$featuredCourses = $homePage->getFeaturedCourses();
$topCategories = $homePage->getTopCategories();
$bestTeachers = $homePage->getBestTeachers();
$popularTags = $homePage->getPopularTags();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Learn From The Best</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="../assets/styles/home.css" rel="stylesheet">
    <link href="../assets/styles/allcourses.css" rel="stylesheet">
   
</head>
<body>
    <!-- Your existing navbar here -->
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
                        <a class="nav-link" href="./views/user/allCourses.php">all courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./displaycourse.php">Manage Courses</a>
                    </li>
                </ul>

                <div class="navbar-nav ml-auto">
                    <?php if (isset($_SESSION['user_role'])): ?>
                        <a class="btn btn-outline-danger" href="./controllers/auth/logout.php">Logout</a>
                    <?php else: ?>
                        <a class="nav-link" href="login.php">Login</a>
                        <a class="btn btn-primary" href="register.php">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>



    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4 mb-4">Unlock Your Potential</h1>
                    <p class="lead mb-4">Learn from industry experts and advance your career with our comprehensive courses.</p>
                    <a href="courses.php" class="btn btn-light btn-lg">Explore Courses</a>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6 mb-4">
                            <div class="stats-card">
                                <h3><?= number_format($stats['total_courses']) ?></h3>
                                <p class="mb-0">Courses</p>
                            </div>
                        </div>
                        <div class="col-6 mb-4">
                            <div class="stats-card">
                                <h3><?= number_format($stats['total_students']) ?></h3>
                                <p class="mb-0">Students</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stats-card">
                                <h3><?= number_format($stats['total_teachers']) ?></h3>
                                <p class="mb-0">Instructors</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stats-card">
                                <h3><?= number_format($stats['total_hours']) ?>+</h3>
                                <p class="mb-0">Hours of Content</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Courses -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Featured Courses</h2>
            <div class="row">
                <?php foreach ($featuredCourses as $course): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card course-card">
                            <img src="<?= htmlspecialchars($course['wallpaper_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($course['title']) ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($course['title']) ?></h5>
                                <p class="card-text"><?= substr(htmlspecialchars($course['description']), 0, 100) ?>...</p>
                                <div class="d-flex align-items-center mb-3">
                                    <img src="<?= htmlspecialchars($course['teacher_profile']) ?>" alt="<?= htmlspecialchars($course['teacher_name']) ?>" class="rounded-circle mr-2" style="width: 30px; height: 30px;">
                                    <span><?= htmlspecialchars($course['teacher_name']) ?></span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge badge-primary"><?= htmlspecialchars($course['category_name']) ?></span>
                                    <div>
                                        <i class="far fa-clock"></i> <?= $course['video_hours'] ?> hours
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Top Categories -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Top Categories</h2>
            <div class="row">
                <?php foreach ($topCategories as $category): ?>
                    <div class="col-md-3 mb-4">
                        <div class="category-card">
                            <i class="fas fa-laptop-code fa-2x mb-3"></i>
                            <h4><?= htmlspecialchars($category['name']) ?></h4>
                            <p class="mb-0"><?= $category['course_count'] ?> Courses</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Best Teachers -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Meet Our Best Teachers</h2>
            <div class="row">
                <?php foreach ($bestTeachers as $teacher): ?>
                    <div class="col-md-3 mb-4">
                        <div class="teacher-card">
                            <img src="<?= htmlspecialchars($teacher['profil']) ?>" alt="<?= htmlspecialchars($teacher['name']) ?>">
                            <h5><?= htmlspecialchars($teacher['name']) ?></h5>
                            <p class="text-muted"><?= $teacher['course_count'] ?> Courses</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Popular Tags -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Popular Topics</h2>
            <div class="tag-cloud">
                <?php foreach ($popularTags as $tag): ?>
                    <a href="courses.php?tag=<?= urlencode($tag['name']) ?>" class="tag text-decoration-none text-dark">
                        <?= htmlspecialchars($tag['name']) ?> (<?= $tag['usage_count'] ?>)
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5" style="background: #2c3e50; color: white;">
        <div class="container text-center">
            <h2 class="mb-4">Ready to Start Learning?</h2>
            <p class="lead mb-4">Join thousands of students already learning on Youdemy</p>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="register.php" class="btn btn-light btn-lg mr-3">Sign Up Now</a>
                <a href="courses.php" class="btn btn-outline-light btn-lg">Browse Courses</a>
            <?php else: ?>
                <a href="courses.php" class="btn btn-light btn-lg">Browse Courses</a>
            <?php endif; ?>
        </div>
    </section>







    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5>About Youdemy</h5>
                    <p>Youdemy is a leading online learning platform that helps anyone, anywhere learn the skills they need to succeed in their career and life.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>For Students</h5>
                    <ul class="footer-links">
                        <li><a href="#">All Courses</a></li>
                        <li><a href="#">My Learning</a></li>
                        <li><a href="#">Wishlist</a></li>
                        <li><a href="#">Student Resources</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>For Teachers</h5>
                    <ul class="footer-links">
                        <li><a href="#">Teach on Youdemy</a></li>
                        <li><a href="#">Teacher Resources</a></li>
                        <li><a href="#">Become an Instructor</a></li>
                        <li><a href="#">Teacher Guidelines</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Support</h5>
                    <ul class="footer-links">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Categories</h5>
                    <ul class="footer-links">
                        <?php foreach (array_slice($topCategories, 0, 4) as $category): ?>
                            <li><a href="#"><?= htmlspecialchars($category['name']) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom text-center">
                <p class="mb-0">&copy; <?= date('Y') ?> Youdemy. All rights reserved.</p>
            </div>
        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>