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
    <title>Dashboard Admin</title>
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
                <a href="/logout.php" class="btn-logout">Logout</a>
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
                <button id="createOpenModal" class="btn-create">Create New Item</button>

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
                        <a href="#" 
                            class="btn-action btn-edit" 
                            data-id="<?php echo $it['id']; ?>"
                            data-name="<?php echo htmlspecialchars($it['name']); ?>"
                            data-description="<?php echo htmlspecialchars($it['description']); ?>"
                            data-price="<?php echo $it['price']; ?>"
                            data-image="<?php echo htmlspecialchars($it['image']); ?>"
                        >Edit</a> |
                        <a href="/delete.php?id=<?php echo $it['id']; ?>" onclick="return
                        confirm('Yakin?')" class="btn-action">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <!-- END CONTENT-->


            <!-- START CREATE MODAL -->
            <div id="createModal" class="modal">
                <div class="create-modal-content">
                    <span id="createCloseModal" class="close">&times;</span>
                    <h2>Create New Item</h2>
                    <form method="post" enctype="multipart/form-data" action="create.php">
                    <label>Name:</label><br>
                    <input type="text" name="name" required><br><br>

                    <label>Description:</label><br>
                    <textarea name="description"></textarea><br><br>

                    <label>Price:</label><br>
                    <input type="number" name="price" step="0.01"><br><br>

                    <label>Image:</label><br>
                    <input type="file" name="image" accept="image/*"><br><br>

                    <button type="submit" class="btn-save">Save</button>
                    </form>
                </div>
            </div>
            <!-- END CREATE MODAL -->


            <!-- START EDIT MODAL -->
            <div id="editModal" class="modal">
            <div class="edit-modal-content">
                <span id="editCloseModal" class="close">&times;</span>
                <h2>Edit Item</h2>
                <form method="post" enctype="multipart/form-data" action="edit.php" id="editForm">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="container">
                        <div>
                            <label>Name:</label><br>
                            <input type="text" name="name" id="edit-name" required><br><br>

                            <label>Description:</label><br>
                            <textarea name="description" id="edit-description"></textarea><br><br>

                            <label>Price:</label><br>
                            <input type="number" name="price" step="0.01" id="edit-price"><br><br>
                        </div>
                        <div>
                            <label>Current Image:</label><br>
                            <img id="edit-current-image" src="" style="max-width:150px;"><br>

                            <label>Upload New Image (optional):</label><br>
                            <input type="file" name="image" accept="image/*"><br><br>
                        </div>
                    </div>

                    <button type="submit" class="btn-save">Save</button>
                </form>
            </div>
            </div>
            <!-- END EDIT MODAL -->

        </div>
        <!-- END MAIN -->

        <!-- START FOOTER -->
        <div class="footer">
            <p>Copyright@divisi jaringan 2025</p>
        </div>
        <!-- END FOOTER -->


        <script>
        // CREATE MODAL
        const createModal = document.getElementById("createModal");
        const createBtn   = document.getElementById("createOpenModal");
        const createSpan  = document.getElementById("createCloseModal");

        createBtn.onclick = () => createModal.style.display = "block";
        createSpan.onclick = () => createModal.style.display = "none";
        window.onclick = (e) => { if (e.target == createModal) createModal.style.display = "none"; }

        // EDIT MODAL
        const editModal = document.getElementById("editModal");
        const editSpan  = document.getElementById("editCloseModal");

        document.querySelectorAll(".btn-edit").forEach(btn => {
            btn.addEventListener("click", (e) => {
                e.preventDefault();

                document.getElementById("edit-id").value = btn.dataset.id;
                document.getElementById("edit-name").value = btn.dataset.name;
                document.getElementById("edit-description").value = btn.dataset.description;
                document.getElementById("edit-price").value = btn.dataset.price;

                if (btn.dataset.image) {
                    document.getElementById("edit-current-image").src = "/uploads/" + btn.dataset.image;
                    document.getElementById("edit-current-image").style.display = "block";
                } else {
                    document.getElementById("edit-current-image").style.display = "none";
                }

                editModal.style.display = "block";
            });
        });

        editSpan.onclick = () => editModal.style.display = "none";
        window.addEventListener("click", (e) => {
            if (e.target == editModal) editModal.style.display = "none";
        });
        </script>
    </body>
</html>