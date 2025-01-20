<?php
session_start();

$errors = isset($_SESSION['text_error']) ? $_SESSION['text_error'] : [];
unset($_SESSION['text_error']);

$acess = isset($_SESSION['acess']) ? $_SESSION['acess'] : [];
unset($_SESSION['acess']);

if(isset($_SESSION['user_id']))
{
    header('Location: ../../index.php');
}
?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?= implode('<br>', $errors); ?>

    </div>
<?php endif; ?>
<?php if (!empty($acess)): ?>
    <div class="alert alert-danger">
        <?= $acess; ?>

    </div>
<?php endif; ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bootstrap Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/styles/login.css">

</head>
<body class="bg-light">
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="card card-custom shadow-lg w-100">
            <div class="row g-0 h-100">
                <div class="col-md-6">
                    <img src="../../../assets/pics/login-office.jpeg" class="img-fluid rounded-start img-cover" alt="Office">
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">Login</h1>
                        <form method="POST" action="../../controllers/loginController.php">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" class="form-control" id="email" placeholder="Jane Doe">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input name="password" type="password" class="form-control" id="password" placeholder="***************">
                            </div>
                            <button name="submit" type="submit" class="btn btn-primary w-100">Log in</button>
                        </form>
                        <p class="text-center mt-4"><a href="./forgot-password.html">Forgot your password?</a></p>
                        <p class="text-center"><a href="./create-account.html">Create account</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
