<?php
require '../../controllers/teachercontroller/courseController.php';

$controller = new CourseController;
$allcourses = $controller->fetchAllCourse('video');
//print_r($allcourses);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Course Listing - Udemy Style</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container my-4">
    <h1 class="text-center mb-4">Available Courses</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach ($allcourses as $course): ?>
      <div class="col">
        <div class="card h-100">
          <img src="<?= htmlspecialchars($course['wallpaper_url']) ?>" class="card-img-top" alt="Course Image">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($course['title']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($course['description']) ?></p>
            <a href="#" class="btn btn-primary">Modify Course</a>
            <a href="#" class="btn btn-danger">Delete Course</a>
          </div>
          <div class="card-footer">
            <small class="text-muted">4.5 (200 reviews)</small>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
      <!-- Add more courses as needed -->
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

