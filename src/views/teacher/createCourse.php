<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course - Teacher Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4>Create a New Course</h4>
            </div>
            <div class="card-body">
                <form id="createCourseForm">
                    <div class="form-group">
                        <label for="courseTitle">Course Title</label>
                        <input type="text" class="form-control" id="courseTitle" name="courseTitle" placeholder="Enter course title" required>
                    </div>
                    <div class="form-group">
                        <label for="courseDescription">Course Description</label>
                        <textarea class="form-control" id="courseDescription" name="courseDescription" rows="4" placeholder="Enter course description" required></textarea>
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
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <select class="form-control" id="tags" name="tags" multiple required>
                            <!-- Populate tags dynamically -->
                        </select>
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
                    <div class="form-group">
                        <label for="access">Access Options</label>
                        <input type="text" class="form-control" id="access" name="access" placeholder="Enter access options (e.g., mobile, TV)" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Course</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
