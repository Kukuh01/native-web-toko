<?php
require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/items.php';

require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = $_POST['name'] ?? '';
    $desc  = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0;

    $image = null;
    if (!empty($_FILES['image']['name'])) {
        $filename = time() . '_' . basename($_FILES['image']['name']);
        $target = __DIR__ . '/uploads/' . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $image = $filename;
        }
    }

    create_item($name, $desc, $price, $image);
    header('Location: items.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Create Item</title>
</head>
<body>
  <h1>Create New Item</h1>
  <form method="post" enctype="multipart/form-data">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Description:</label><br>
    <textarea name="description"></textarea><br><br>

    <label>Price:</label><br>
    <input type="number" name="price" step="0.01"><br><br>

    <label>Image:</label><br>
    <input type="file" name="image" accept="image/*"><br><br>

    <button type="submit">Save</button>
  </form>
  <p><a href="items.php">Back to Items</a></p>
</body>
</html>
