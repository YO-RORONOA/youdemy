<?php
// views/teacher/course-enrollments.php
// require_once '../../controllers/teachercontroller/enrollmentManagment.php';
require_once __DIR__ . '/../../controllers/teachercontroller/enrollmentManagmentController.php';


if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'teacher') {
    header('Location: ../auth/login.php');
    exit;
}

$controller = new enrollmentManagment();
$teacherId = $_SESSION['user_id'];
$courses = $controller->getTeacherCourses($teacherId);

// If a specific course is selected, get its enrolled students
$selectedCourseId = $_GET['course_id'] ?? null;
$enrolledStudents = [];
if ($selectedCourseId) {
    $enrolledStudents = $controller->getEnrolledStudents($selectedCourseId, $teacherId);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Enrollments - Teacher Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Course Enrollments</h2>
        
        <!-- Course Selection -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Select Course</h5>
                <form method="get" class="form-inline">
                    <select name="course_id" class="form-control mr-2" onchange="this.form.submit()">
                        <option value="">Choose a course...</option>
                        <?php foreach ($courses as $course): ?>
                            <option value="<?= htmlspecialchars($course['id']) ?>" 
                                    <?= $selectedCourseId == $course['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($course['title']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
        </div>

        <!-- Enrolled Students Table -->
        <?php if ($selectedCourseId && !empty($enrolledStudents)): ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Enrolled Students</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Enrollment Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($enrolledStudents as $student): ?>
                                    <tr id="student-row-<?= $student['id'] ?>">
                                        <td>
                                            <img src="<?= htmlspecialchars($student['profile_pic']) ?>" 
                                                 alt="Profile" 
                                                 class="rounded-circle"
                                                 width="40" 
                                                 height="40">
                                        </td>
                                        <td><?= htmlspecialchars($student['name']) ?></td>
                                        <td><?= htmlspecialchars($student['email']) ?></td>
                                        <td><?= date('M d, Y', strtotime($student['enrollment_date'])) ?></td>
                                        <td>
                                            <button class="btn btn-danger btn-sm remove-student"
                                                    data-student-id="<?= $student['id'] ?>"
                                                    data-course-id="<?= $selectedCourseId ?>">
                                                <i class="fas fa-user-minus"></i> Remove
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php elseif ($selectedCourseId): ?>
            <div class="alert alert-info">No students enrolled in this course yet.</div>
        <?php endif; ?>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/js/subManagment.js">
    </script>
</body>
</html>