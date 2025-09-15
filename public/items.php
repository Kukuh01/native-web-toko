<?php
require_once __DIR__.'/../src/auth.php';
require_once __DIR__.'/../src/items.php';
require_login();
$items = get_all_items();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Items</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
    <body>
        <h2>List Items</h2>

        <p>Halo, <?php echo htmlspecialchars($_SESSION['user_email']); ?> — <a
        href="/logout.php">Logout</a>
        </p>

        <p>
            <a href="/item_create.php">Create New Item</a>
        </p>

        <table border="1" cellpadding="6">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            <?php foreach($items as $it): ?>
            <tr>
                <td><?php echo $it['id']; ?></td>
                <td><?php echo htmlspecialchars($it['name']); ?></td>
                <td><?php echo $it['price']; ?></td>
                <td>
                <a href="/item_edit.php?id=<?php echo $it['id']; ?>">Edit</a> |
                <a href="/item_delete.php?id=<?php echo $it['id']; ?>" onclick="return
                confirm('Yakin?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>