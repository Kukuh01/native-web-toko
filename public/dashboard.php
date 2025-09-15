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
    <link rel="stylesheet" href="assets/style/dashboard.css">
</head>
    <body>
        <!-- START NAVBAR -->
        <div class="navbar">
            <!-- START TILTE -->
            <div class="title">
                <h1>Panel Admin</h1>
            </div>
            <!-- END TILTE -->

            <!-- START PROFILE -->
            <div class="profile">
                <div>
                    <p>Halo, <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
                </div>
                <img src="assets/img/defaultProfile.jpg" alt="">
                <a href="/logout.php">Logout</a>
            </div>
            <!-- END PROFILE -->
        </div>
        <!-- END NAVBAR -->

        <!-- START MAIN -->
        <div class="main">
            <!-- START SIDEBAR-->
            <div class="sidebar">
                
            </div>
            <!-- END SIDEBAR-->

            <!-- START CONTENT-->
            <div class="content">
                <h2>List Items</h2>
                    <p>
                        <a href="create.php" class="btn-create">Create New Item</a>
                    </p>

                <table border="1" cellpadding="6">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Pitcure</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                        $no =0;
                    ?>
                    <?php foreach($items as $it): ?>
                    <tr>
                        <?php
                            $no = $no + 1;
                        ?>
                        <td><?php echo $no; ?></td>
                        <td><?php echo htmlspecialchars($it['name']); ?></td>
                        <td>
                            <?php if (!empty($it['image'])): ?>
                            <img src="/uploads/<?php echo htmlspecialchars($it['image']); ?>" style="max-width:100px;">
                            <?php endif; ?>
                        </td>
                        <td><?php echo $it['price']; ?></td>
                        <td>
                        <a href="/item_edit.php?id=<?php echo $it['id']; ?>" class="btn-action">Edit</a> |
                        <a href="/item_delete.php?id=<?php echo $it['id']; ?>" onclick="return
                        confirm('Yakin?')" class="btn-action">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <!-- END CONTENT-->
        </div>
        <!-- END MAIN -->

        <!-- START FOOTER -->
        <div class="footer">
            <p>Copyright@divisi jaringan 2025</p>
        </div>
        <!-- END FOOTER -->
    </body>
</html>