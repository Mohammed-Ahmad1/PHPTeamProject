<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/PHPLogicPages/ProductsLogic.php';
require_once __DIR__ . '/PHPLogicPages/OrdersLogic.php';
require_once __DIR__ . '/PHPLogicPages/UsersLogic.php';
require_once __DIR__ . '/PHPLogicPages/PaymentsLogic.php';

$totalSales    = GetTotalSales();
$totalProducts = GetNumberOfProducts();
$totalUsers    = GetNumberOfUsers();
$totalOrders   = GetNumberOfOrders();
$RecentOrders  = GetRecentOrdersLast7Days();

// Process orders to get totals per order
$orders = [];

foreach ($RecentOrders as $item) {
    $orderId = $item['order_id'];

    if (!isset($orders[$orderId])) {
        $orders[$orderId] = [
            'order_id' => $orderId,
            'order_time' => $item['order_time'],
            'total_quantity' => 0,
            'total_price' => 0
        ];
    }

    $orders[$orderId]['total_quantity'] += $item['quantity'];
    $orders[$orderId]['total_price'] += $item['quantity'] * $item['price_at_purchase'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FELUX</title>
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
                <a href="dashboard.php" class="nav-link d-flex align-items-center active">
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
                <a href="edit_profile.php" class="nav-link d-flex align-items-center">
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
        <h1 class="mb-4">Dashboard</h1>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-primary rounded-circle p-3 me-3">
                            <i class="fas fa-calendar-check text-white fs-4"></i>
                        </div>
                        <div>
                            <h3 class="mb-0"><?= $totalProducts ?></h3>
                            <p class="mb-0 text-muted">products added</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-warning rounded-circle p-3 me-3">
                            <i class="fas fa-users text-white fs-4"></i>
                        </div>
                        <div>
                            <h3 class="mb-0"><?= $totalUsers ?></h3>
                            <p class="mb-0 text-muted">Number of users</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-orange rounded-circle p-3 me-3">
                            <i class="fas fa-shopping-cart text-white fs-4"></i>
                        </div>
                        <div>
                            <h3 class="mb-0"><?= $totalOrders ?></h3>
                            <p class="mb-0 text-muted">Number of Orders</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-success rounded-circle p-3 me-3">
                            <i class="fas fa-dollar-sign text-white fs-4"></i>
                        </div>
                        <div>
                            <h3 class="mb-0"><?= $totalSales ?></h3>
                            <p class="mb-0 text-muted">Total Sales</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders Table -->
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Orders</h5>
                <div class="d-flex">
                    <!-- 🔍 Search Input (Added) -->
                    <input type="text" id="orderSearch" class="form-control form-control-sm me-2" 
                           placeholder="Search orders..." style="max-width: 200px;">
                    <!-- Optional: Make search icon focus the input -->
                    <button class="btn btn-sm btn-outline-secondary me-2" 
                            onclick="document.getElementById('orderSearch').focus();">
                        <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="recentOrdersTable">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Date Order</th>
                                <th>Total Quantity</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($orders)) : ?>
                                <?php foreach ($orders as $order) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($order['order_id']) ?></td>
                                        <td><?= htmlspecialchars($order['order_time']) ?></td>
                                        <td><?= htmlspecialchars($order['total_quantity']) ?></td>
                                        <td>JD<?= number_format($order['total_price'], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4" class="text-center">No recent orders</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- ✅ Search functionality script -->
    <script src="assets/js/orderSearch.js"></script>
</body>
</html>