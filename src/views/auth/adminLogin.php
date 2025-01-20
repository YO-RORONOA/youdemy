<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Admin Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/styles/adminlogin.css">

</head>
<body>
    <div class="container min-vh-100 d-flex justify-content-center align-items-center py-5">
        <div class="admin-card p-4 p-md-5 w-100" style="max-width: 450px;">
            <div class="logo-area">
                <div class="lock-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white" viewBox="0 0 16 16">
                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                    </svg>
                </div>
                <h2 class="mb-1">Admin Portal</h2>
                <p class="text-muted">Youdemy Management System</p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($_SESSION['error']); ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <div class="error-message" id="errorMessage"></div>

            <form id="adminLoginForm" method="POST" action="../../controllers/admin/adminloginController.php" novalidate>
                <!-- CSRF Token -->
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">
                
                <div class="mb-4">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required minlength="8">
                    <div class="invalid-feedback">Password must be at least 8 characters long.</div>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3" name="admin_login">
                    Sign In to Dashboard
                </button>

                <p class="text-center mb-0">
                    <a href="../index.php" class="text-light opacity-75">Back to Homepage</a>
                </p>
            </form>
        </div>
    </div>

    <script src="../../../assets/js/admin.js">
       
    </script>
</body>
</html>