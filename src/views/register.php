<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Bootstrap Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/styles/register.css">

</head>
<body class="bg-light">
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="card card-custom shadow-lg w-100 overflow-hidden overflow-scrollable">
            <div class="row g-0">
                <div class="col-md-6 d-none d-md-block">
                    <img src="../../assets/pics/login-office.jpeg" class="img-cover" alt="Office">
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <div class="card-body w-100">
                        <h1 class="card-title text-center mb-4">Register</h1>
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="John Doe">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="example@mail.com">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="********">
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" id="role">
                                    <option value="teacher">Teacher</option>
                                    <option value="student">Student</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="profilePicture" class="form-label">Profile Picture (URL)</label>
                                <input type="url" class="form-control" id="profilePicture" placeholder="https://example.com/profile.jpg">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Register</button>
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
