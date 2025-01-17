<?php
session_start();
require '../../controllers/student/coursesController.php';
require '../../controllers/student/Enrollment.php';

// $controller = new CourseController;
// $allcourses = $controller->fetchAllCourse('video');
// $course = $allcourses[1];
$course;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['course_id'])) {
    $_SESSION['course_id'] = $_POST['course_id'];
    $controller = new CoursesController;
    $course = $controller->fetchCourseById($_SESSION['course_id']);
}

$enrollmentController = new EnrollmentController();
$isEnrolled = false;
if (isset($_SESSION['user_id'])) {
    $isEnrolled = $enrollmentController->isEnrolled($_SESSION['user_id'], $course['id']);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($course['title']); ?> - Youdemy</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui-pro@5.9.0/dist/css/coreui.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="../../../assets/styles/course.css" rel="stylesheet">


</head>

<body>
    <!-- Navigation Header -->
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
                        <a class="nav-link" href="#">Courses</a>
                    </li>
                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'student'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Your Courses</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <div class="navbar-nav ml-auto">
                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'student'): ?>
                        <!-- Logged in state -->
                        <a class="btn btn-outline-danger" href="../../controllers/auth/logout.php">Logout</a>
                    <?php else: ?>
                        <!-- Logged out state -->
                        <a class="nav-link" href="../auth/login.php">Login</a>
                        <a class="btn btn-primary" href="../auth/register.php">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>


    <!-- Rest of the existing content -->
    <div class="course-header">
        <div class="container">
            <h2><?php echo htmlspecialchars($course['title']); ?></h2>

            <!-- Mobile-first pricing section -->
            <div class="pricing-card d-md-none">
                <div class="price-tag">$10.00<span class="text-muted" style="font-size: 1rem;"> /month</span></div>
                <button class="btn btn-primary btn-lg btn-block">Start Your Free Trial</button>
                <small class="d-block text-center text-muted mt-2">Starting at $10.00 per month after trial</small>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="video-container my-4">
                    <iframe src="https://www.youtube.com/watch?v=LqYIKYEnX7Y&list=RDLqYIKYEnX7Y&start_radio=1" allowfullscreen></iframe>
                </div>

                <div class="card my-4">
                    <div class="card-body">
                        <h3>What you'll learn</h3>
                        <ul class="course-list">
                            <li>Dive into animated videos, 50 writing assignments and 60 interactive quizzes in our comprehensive, updated copywriting course.</li>
                            <li>Mastering ChatGPT for Content Creation: Learn to use ChatGPT for generating creative content, effective SEO, social media, and complete blog concepts.</li>
                            <li>Advanced Copywriting Skills: Develop the ability to convert website visitors into buyers using persuasive techniques and overcoming customer objections.</li>
                            <li>ChatGPT for E-Commerce & Local SEO: Utilize ChatGPT for innovative e-commerce solutions and local SEO, including crafting Google My Business descriptions.</li>
                            <li>Content Creation with Expert Guidance: Transform into a skilled content creator with input, templates, and walkthroughs from an experienced copywriter.</li>
                        </ul>
                    </div>
                </div>

                <div class="card my-4">
                    <div class="card-body">
                        <h3>Course Details</h3>
                        <ul class="course-list">
                            <li>Video hours: <?php echo htmlspecialchars($course['video_hours']); ?> hours</li>
                            <li>Number of articles: <?php echo htmlspecialchars($course['nb_articles']); ?></li>
                            <li>Number of resources: <?php echo htmlspecialchars($course['nb_resources']); ?></li>
                        </ul>
                    </div>
                </div>

                <div class="tags-container mb-4">
                    <strong>Explore Related Topics:</strong>
                    <?php
                    $tags = explode(',', $course['tag_names']);
                    foreach ($tags as $tag) {
                        echo '<button class="tag-btn">' . htmlspecialchars(trim($tag)) . '</button> ';
                    }
                    ?>
                </div>

                <div class="mb-4">
                    <h4>Description</h4>
                    <p><?php echo htmlspecialchars($course['description']); ?></p>
                </div>
            </div>

            <!-- Desktop pricing section -->
            <div class="col-md-4 d-none d-md-block">
                <div class="pricing-card sticky-top" style="top: 76px;"> <!-- Adjusted for navbar height -->
                    <div class="price-tag">$10.00<span class="text-muted" style="font-size: 1rem;"> /month</span></div>

                    <div class="subscription-info">
                        <h3>Subscribe to Youdemy's top courses</h3>
                        <p>Get unlimited access to 12,000+ of our top-rated courses</p>
                    </div>


                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'student'): ?>
                        <button id="enrollButton"
                            class="btn btn-lg btn-block <?php echo $isEnrolled ? 'btn-danger' : 'btn-primary'; ?>"
                            data-course-id="<?= htmlspecialchars($course['id']); ?>">
                            <?php echo $isEnrolled ? 'Unsubscribe from Course' : 'Subscribe to Course'; ?>
                        </button>
                    <?php elseif (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'teacher'): ?>
                        <div class="alert alert-info">
                            Teacher accounts cannot subscribe to courses
                        </div>
                    <?php else: ?>
                        <button class="btn btn-lg btn-block btn-primary" disabled>
                            Please Login to Subscribe
                        </button>
                    <?php endif; ?>


                    <small class="d-block text-center text-muted mt-2">Starting at $10.00 per month after trial</small>

                    <hr>

                    <ul class="feature-list">
                        <li>Lifetime access to all course materials</li>
                        <li>Expert instructor guidance</li>
                        <li>Course completion certificate</li>
                        <li>Regular content updates</li>
                    </ul>

                    <div class="guarantee-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <span>30-day money-back guarantee</span>
                    </div>

                    <button class="btn btn-primary btn-lg btn-block">Subscribe to this Course</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../../assets/js/Enrollment.js"></script>
</body>

</html>