
<?php

require '../../classes/User.php';


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel - Youdemy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
  </head>
  <body>
    <div class="container my-5">
      <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
          <h4>User Management</h4>
        </div>
        <div class="card-body">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Client</th>
                <th>Role</th>
                <th>Date Joined</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <img src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixid=eyJhcHBfaWQiOjE3Nzg0fQ" alt="" class="rounded-circle" width="40" height="40">
                    <div class="ml-3">
                      <p class="font-weight-bold mb-1">Hans Burger</p>
                      <p class="text-muted mb-0">10x Developer</p>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="badge badge-primary">Teacher</span>
                </td>
                <td>
                  6/10/2020
                </td>
                <td>
                  <span class="badge badge-success">Active</span>
                </td>
                <td>
                  <button class="btn btn-warning btn-sm">Suspend</button>
                  <button class="btn btn-success btn-sm">Activate</button>
                  <button class="btn btn-danger btn-sm">Delete</button>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <img src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixid=eyJhcHBfaWQiOjE3Nzg0fQ" alt="" class="rounded-circle" width="40" height="40">
                    <div class="ml-3">
                      <p class="font-weight-bold mb-1">Jane Doe</p>
                      <p class="text-muted mb-0">Web Designer</p>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="badge badge-success">Student</span>
                </td>
                <td>
                  6/11/2020
                </td>
                <td>
                  <span class="badge badge-warning">Suspended</span>
                </td>
                <td>
                  <button class="btn btn-success btn-sm">Activate</button>
                  <button class="btn btn-danger btn-sm">Delete</button>
                </td>
              </tr>
              <!-- Add more rows as needed -->
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
