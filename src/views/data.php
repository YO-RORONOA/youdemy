<?php

require '../controllers/teachercontroller/courseController.php';



$controller = new CourseController;
$allcourses = $controller->fetchAllCourse('video');
$course = $allcourses[4];
print_r($course);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Title - Youdemy</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui-pro@5.9.0/dist/css/coreui.min.css" rel="stylesheet">
    <link href="../../assets/styles/styles.css" rel="stylesheet">
   
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h2>Course Title</h2>
                <iframe src="https://www.fs-umi.ac.ma/wp-content/uploads/2017/12/cour-chimie-organique-S2-2017-2018.pdf" allowfullscreen></iframe>

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

                <div class="tags-container">
                    <strong>Explore Related Topics:</strong>
                    <button class="tag-btn">Copywriting</button>
                    <button class="tag-btn">SEO</button>
                    <button class="tag-btn">Content Creation</button>
                    <button class="tag-btn">E-Commerce</button>
                    <button class="tag-btn">ChatGPT</button>
                </div>

                <div>
                    <h4>Description</h4>
                    <p>Course description goes here...</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="side-panel">
                    <!-- <iframe 
                        class="preview-video"
                        src="https://www.youtube.com/embed/LqYIKYEnX7Y" 
                        allowfullscreen>
                    </iframe> -->
                    
                    <div class="panel-content">
                        <div class="price-tag">$10.00<span class="text-muted" style="font-size: 1rem;"> /month</span></div>
                        
                        <div class="subscription-info">
                            <h3>Subscribe to Youdemy's top courses</h3>
                            <p>Get unlimited access to 12,000+ of our top-rated courses</p>
                        </div>

                        <button class="btn btn-primary w-100">Start Your Free Trial</button>
                        <small class="d-block text-center text-muted mt-2">Starting at $10.00 per month after trial</small>

                        <div class="divider"></div>

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

                        <button class="btn btn-primary w-100">Subscribe to this Course</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>





















<?php

require '../../controllers/teachercontroller/courseController.php';

$controller = new CourseController;
$allcourses = $controller->fetchAllCourse('video');
$course = $allcourses[1];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($course['title']); ?> - Youdemy</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui-pro@5.9.0/dist/css/coreui.min.css" rel="stylesheet">
    <link href="../../../assets/styles/styles.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h2><?= htmlspecialchars($course['title']); ?></h2>
                <iframe src="<?php echo htmlspecialchars($course['content']); ?>" allowfullscreen></iframe>

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
                        <h3>What you'll learn</h3>
                        <ul class="course-list">
                            <li>Video hours: <?php echo htmlspecialchars($course['video_hours']); ?> hours</li>
                            <li>Number of articles: <?php echo htmlspecialchars($course['nb_articles']); ?></li>
                            <li>Number of resources: <?php echo htmlspecialchars($course['nb_resources']); ?></li>
                        </ul>
                    </div>
                </div>

                <div class="tags-container">
                    <strong>Explore Related Topics:</strong>
                    <?php
                    $tags = explode(',', $course['tag_names']);
                    foreach ($tags as $tag) {
                        echo '<button class="tag-btn">' . htmlspecialchars(trim($tag)) . '</button> ';
                    }
                    ?>
                </div>

                <div>
                    <h4>Description</h4>
                    <p><?php echo htmlspecialchars($course['description']); ?></p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="side-panel">
                    <div class="panel-content">
                        <div class="price-tag">$10.00<span class="text-muted" style="font-size: 1rem;"> /month</span></div>

                        <div class="subscription-info">
                            <h3>Subscribe to Youdemy's top courses</h3>
                            <p>Get unlimited access to 12,000+ of our top-rated courses</p>
                        </div>

                        <button class="btn btn-primary w-100">Start Your Free Trial</button>
                        <small class="d-block text-center text-muted mt-2">Starting at $10.00 per month after trial</small>

                        <div class="divider"></div>

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

                        <button class="btn btn-primary w-100">Subscribe to this Course</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
