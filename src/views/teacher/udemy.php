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
            <button class="btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#courseModal" data-id="<?= $course['id'] ?>">Modify Course</button>
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














  <div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="courseModalLabel">Create or Edit Course</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="../../controllers/teachercontroller/CourseController.php" id="createCourseForm">
            <input type="hidden" id="courseId" name="courseId">
            <div class="form-group">
              <label for="courseTitle">Course Title</label>
              <input type="text" class="form-control" id="courseTitle" name="title" required>
            </div>
            <div class="form-group">
              <label for="courseDescription">Course Description</label>
              <textarea class="form-control" id="courseDescription" name="description" rows="4" required></textarea>
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
              <input type="url" class="form-control" id="contentUrl" name="contentUrl" required>
            </div>
            <div class="form-group">
              <label for="category">Category</label>
              <select class="form-control" id="category" name="category" required>
                <?php foreach ($categories as $categorie): ?>
                  <option value="<?= $categorie['id'] ?>"> <?= $categorie['name'] ?> </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="tags">Tags</label>
              <div id="tags">
                <?php foreach ($tags as $tag): ?>
                  <label><input name="tags[]" type="checkbox" value="<?= $tag['id'] ?>"> <?= $tag['name'] ?> </label>
                <?php endforeach; ?>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Course</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

