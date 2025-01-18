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
    <style>
        :root {
            --primary-dark: #1a1c2e;
            --secondary-dark: #252942;
            --accent-blue: #3498db;
            --text-light: #e4e6f1;
        }

        body {
            background: linear-gradient(135deg, var(--primary-dark), var(--secondary-dark));
            min-height: 100vh;
            color: var(--text-light);
        }

        .admin-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }

        .logo-area {
            text-align: center;
            margin-bottom: 2rem;
        }

        .lock-icon {
            width: 60px;
            height: 60px;
            background: var(--accent-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-light);
            padding: 0.8rem;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--accent-blue);
            color: var(--text-light);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }

        .btn-primary {
            background: var(--accent-blue);
            border: none;
            padding: 0.8rem;
        }

        .error-message {
            background: rgba(231, 76, 60, 0.1);
            border-left: 4px solid #e74c3c;
            padding: 1rem;
            margin-bottom: 1rem;
            display: none;
        }

        .loading .btn-primary {
            position: relative;
            pointer-events: none;
            opacity: 0.8;
        }

        .loading .btn-primary::after {
            content: "";
            width: 20px;
            height: 20px;
            border: 2px solid #ffffff;
            border-top: 2px solid transparent;
            border-radius: 50%;
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: translateY(-50%) rotate(0deg); }
            100% { transform: translateY(-50%) rotate(360deg); }
        }

        .form-label {
            color: var(--text-light);
            opacity: 0.9;
        }

        .alert {
            border-radius: 10px;
        }
    </style>
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