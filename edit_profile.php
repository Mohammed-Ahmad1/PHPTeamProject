<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - FELUX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar bg-light p-3 vh-100 position-fixed">
        <div class="d-flex align-items-center mb-4">
            <i class="fas fa-store fa-2x me-2 text-success"></i>
            <h4 class="m-0">FELUX</h4>
        </div>
        <p class="text-danger fw-bold mb-4">Welcome, ahmad_zytoon</p>
        <hr>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="dashboard.php" class="nav-link d-flex align-items-center">
                    <i class="fas fa-home me-2"></i> Home
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="orders.php" class="nav-link d-flex align-items-center">
                    <i class="fas fa-box me-2"></i> Orders
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="products.php" class="nav-link d-flex align-items-center">
                    <i class="fas fa-tag me-2"></i> Product
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="categories.php" class="nav-link d-flex align-items-center">
                    <i class="fas fa-folder me-2"></i> Category
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="users.php" class="nav-link d-flex align-items-center">
                    <i class="fas fa-users me-2"></i> Users
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="admins.php" class="nav-link d-flex align-items-center">
                    <i class="fas fa-user-shield me-2"></i> Admins
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="edit_profile.php" class="nav-link d-flex align-items-center active">
                    <i class="fas fa-user-edit me-2"></i> Edit Profile
                </a>
            </li>
            <li class="nav-item mt-0">
                <a href="#" class="nav-link d-flex align-items-center text-danger">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1 class="mb-4">Edit Profile</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <form id="editProfileForm">
                    <div class="mb-3">
                        <input type="text" class="form-control" value="ahmad_zytoon" readonly>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Current Password" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Enter New Password" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Confirm New Password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Update Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>