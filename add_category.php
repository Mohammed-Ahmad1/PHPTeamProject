<?php
require_once __DIR__ . '/includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['categoryName'] ?? '');
    $description = trim($_POST['categoryDescription'] ?? '');

    if ($name === '') {
        $error = "Category name is required.";
    } else {
        $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) die("DB error");

        $stmt = $conn->prepare("
            INSERT INTO categories (name, description, created_at)
            VALUES (?, ?, NOW())
        ");
        $stmt->bind_param("ss", $name, $description);

        if ($stmt->execute()) {
            header('Location: categories.php?success=' . urlencode('Category added successfully'));
            exit;
        } else {
            $error = "Database error";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Category</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="main-content" style="margin-left:260px; padding:20px">
<h1>Add Category</h1>

<?php if (!empty($error)): ?>
<div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" action="add_category.php">
    <div class="mb-3">
        <label>Category Name *</label>
        <input type="text" name="categoryName" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="categoryDescription" class="form-control" rows="4"></textarea>
    </div>

    <button class="btn btn-success">➕ Add Category</button>
    <a href="categories.php" class="btn btn-secondary">Cancel</a>
</form>
</div>

<script src="assets/js/form-fix.js"></script>
</body>
</html>
