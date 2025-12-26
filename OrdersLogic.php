<?php

function GetNumberOfOrders()
{
    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM orders");
    $stmt->execute();

    $total = $stmt->get_result()->fetch_assoc()['total'] ?? 0;

    $stmt->close();
    $conn->close();

    return $total;
}



 // to showing the recent orders in the home page
  function GetRecentOrdersLast7Days()
{
    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $sql = "
        SELECT
            o.order_id,
            CONCAT(u.first_name, ' ', u.last_name) AS full_name,
            u.email,
            u.phone,
            p.name AS product_name,
            oi.quantity,
            oi.price_at_purchase,
            o.created_at AS order_time
        FROM orders o
        INNER JOIN users u ON o.user_id = u.user_id
        INNER JOIN order_items oi ON o.order_id = oi.order_id
        INNER JOIN products p ON oi.product_id = p.product_id
        WHERE o.created_at >= DATE_SUB(NOW(), INTERVAL ? DAY)
        ORDER BY o.created_at DESC
    ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $days = 7;
    $stmt->bind_param("i", $days);

    $stmt->execute();

    $result = $stmt->get_result();

    // Fetch all rows as an associative array
    $orders = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    $conn->close();

    return $orders; // now it's an array you can loop easily
}



function ListAllOrdersData($start, $limit)
{
    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Count total orders for pagination
    $countResult = $conn->query("SELECT COUNT(*) AS total FROM orders");
    $totalOrders = $countResult->fetch_assoc()['total'];

    $sql = "
        SELECT
            CONCAT(u.first_name, ' ', u.last_name) AS full_name,
            u.email,
            u.phone,
            p.name AS product_name,
            o.created_at AS order_time,
            oi.quantity,
            oi.price_at_purchase
        FROM users u
        INNER JOIN orders o ON u.user_id = o.user_id
        INNER JOIN order_items oi ON o.order_id = oi.order_id
        INNER JOIN products p ON oi.product_id = p.product_id
        ORDER BY o.created_at DESC
        LIMIT ?, ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $start, $limit);
    $stmt->execute();
    $orders = $stmt->get_result();

    return [$orders, $totalOrders];
}
