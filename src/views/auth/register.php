<?php
session_start();

$errors = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : [];
$formData = isset($_SESSION['formdata']) ? $_SESSION['formdata'] : [];
unset($_SESSION['error_message'], $_SESSION['formdata']);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Bootstrap Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/styles/register.css">

</head>
<body class="bg-light">
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="card card-custom shadow-lg w-100 overflow-hidden overflow-scrollable">
            <div class="row g-0">
                <div class="col-md-6 d-none d-md-block">
                    <img src="../../../assets/pics/register-logo.jpg" class="img-cover" alt="Office">
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <div class="card-body w-100">
                        <h1 class="card-title text-center mb-4">Register</h1>
                        <form method="POST" action="../../controllers/RegisterController.php">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input name="name" type="text" class="form-control" id="name" placeholder="John Doe"value="<?php echo isset($formData['name']) ? $formData['name'] : ''; ?>">
                            <?php if (isset($errors['name'])): ?>
                                <small class="text-danger"><?php echo $errors['name']; ?></small>
                            <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" class="form-control" id="email" placeholder="example@mail.com"value="<?php echo isset($formData['email']) ? $formData['email'] : ''; ?>">
                            <?php if(isset($errors['email'])): ?>
                                <small class="text-danger"><?php echo $errors['email']; ?></small>
                            <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input name="password" type="password" class="form-control" id="password" placeholder="********"value="<?php isset($formData['password']) ? $formData['password']: ''; ?>">
                            <?php if(isset($errors['password'])):?>
                                <small class="text-danger"><?php echo $errors['password'];?></small>
                            <?php endif;?>

                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" class="form-select" id="role">
                                    <option value="teacher">Teacher</option>
                                    <option value="student">Student</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="profilePicture" class="form-label">Profile Picture (URL)</label>
                                <input name="profil" type="url" class="form-control" id="profilePicture" placeholder="https://example.com/profile.jpg"
                                    value="<?php isset($formData['profil']) ? $formData['profil']: ''; ?>">
                            <?php if(isset($errors['profil'])):?>
                                <small class="text-danger"><?php echo $errors['profil'];?></small>
                            <?php endif;?>
                            </div>
                            <button name="submit" type="submit" class="btn btn-primary w-100">Register</button>
                        </form>
                        <p class="text-center mt-4"><a href="./login.html">Already have an account? Log in</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
