<?php

$host = 'localhost';
$db = 'savory_station';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_item'])) {
    $itemName = $_POST['item_name'];
    $itemDescription = $_POST['item_description'];
    $itemPrice = $_POST['item_price'];

    if (isset($_FILES['item_image'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["item_image"]["name"]);
        move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file);
        $imagePath = $target_file;
    }

    $sql = "INSERT INTO menu_items (name, description, price, image) VALUES ('$itemName', '$itemDescription', '$itemPrice', '$imagePath')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>Swal.fire({ title: 'Success!', text: 'New menu item has been added.', icon: 'success' });</script>";
    } else {
        echo "<script>Swal.fire({ title: 'Error!', text: 'There was an error adding the item.', icon: 'error' });</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_item'])) {
    $itemId = $_POST['item_id'];
    $sql = "DELETE FROM menu_items WHERE id = $itemId";
    if ($conn->query($sql) === TRUE) {
        echo "<script>Swal.fire({ title: 'Deleted!', text: 'Item has been deleted.', icon: 'success' });</script>";
    } else {
        echo "<script>Swal.fire({ title: 'Error!', text: 'There was an error deleting the item.', icon: 'error' });</script>";
    }
}

$sql = "SELECT * FROM menu_items";
$result = $conn->query($sql);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .sidebar {
            width: 250px;
            height: 100%;
            background: #11101d;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            transition: all 0.5s ease;
        }
        .sidebar.active {
            width: 60px;
        }
        .sidebar .logo-details {
            height: 80px;
            display: flex;
            align-items: center;
        }
        .sidebar .logo-details i {
            font-size: 28px;
            color: #fff;
            height: 50px;
            min-width: 60px;
            text-align: center;
            line-height: 50px;
        }
        .sidebar .logo-details .logo_name {
            color: #fff;
            font-size: 24px;
            font-weight: 600;
            transition: 0.3s ease;
        }
        .sidebar.active .logo-details .logo_name {
            opacity: 0;
            pointer-events: none;
        }
        .sidebar .nav-links {
            margin-top: 10px;
        }
        .sidebar .nav-links li {
            position: relative;
            list-style: none;
            height: 50px;
        }
        .sidebar .nav-links li a {
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.4s ease;
        }
        .sidebar .nav-links li a.active {
            background: #1d1b31;
        }
        .sidebar .nav-links li a:hover {
            background: #1d1b31;
        }
        .sidebar .nav-links li i {
            min-width: 60px;
            text-align: center;
            font-size: 18px;
            color: #fff;
        }
        .sidebar .nav-links li a .links_name {
            color: #fff;
            font-size: 15px;
            font-weight: 400;
            white-space: nowrap;
        }
        .sidebar.active .nav-links li a .links_name {
            opacity: 0;
            pointer-events: none;
        }
        .home-section {
            position: relative;
            background: #f5f5f5;
            min-height: 100vh;
            width: calc(100% - 250px);
            left: 250px;
            transition: all 0.5s ease;
        }
        .sidebar.active ~ .home-section {
            width: calc(100% - 60px);
            left: 60px;
        }
        .home-section nav {
            display: flex;
            justify-content: space-between;
            height: 80px;
            background: #fff;
            display: flex;
            align-items: center;
            position: fixed;
            width: calc(100% - 250px);
            left: 250px;
            z-index: 100;
            padding: 0 20px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            transition: all 0.5s ease;
        }
        .sidebar.active ~ .home-section nav {
            left: 60px;
            width: calc(100% - 60px);
        }
        .home-section nav .sidebar-button {
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: 500;
        }
        nav .sidebar-button i {
            font-size: 35px;
            margin-right: 10px;
        }
        .home-section nav .profile-details {
            display: flex;
            align-items: center;
            font-size: 14px;
            font-weight: 500;
        }
        .home-section nav .profile-details .admin_name {
            font-size: 15px;
            font-weight: 500;
            color: #333;
        }
        .home-content {
            position: relative;
            padding-top: 104px;
        }

        #menu-items {
            width: 100%;
            border-collapse: collapse;
        }

        #menu-items tr {
            border-bottom: 1px solid #e5e7eb; 
        }

        #menu-items td {
            text-align: left;
            padding: 30px;
        }

        #menu-items img {
            border-radius: 8px; 
            margin-left: 8px;
        }

        button {
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            filter: brightness(90%);
        }

        .bg-blue-500 {
            background-color: #3b82f6;
        }

        .bg-blue-500:hover {
            background-color: #2563eb;
        }

        .bg-red-500 {
            background-color: #ef4444;
        }

        .bg-red-500:hover {
            background-color: #dc2626; 
        }

        button {
            padding: 8px 12px;
            border-radius: 6px;
            color: white;
            border: none;
        }

        button:focus {
            outline: 2px solid #60a5fa; 
            outline-offset: 2px;
        }

    </style>
    <title>Savory Station</title>
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class="bx bx-store"></i>
            <span class="logo_name">Savory Station</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="../dashboard.php">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="order.php">
                    <i class="bx bx-receipt"></i>
                    <span class="links_name">Recent Orders</span>
                </a>
            </li>
            <li>
                <a class="active" href="menumanagement.php">
                    <i class="bx bx-food-menu"></i>
                    <span class="links_name">Menu Management</span>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class="bx bx-log-out"></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class="bx bx-menu sidebarBtn"></i>
            </div>
            <div class="profile-details">
                <span class="admin_name">SS Admin</span>
            </div>
        </nav>
        <div class="home-content">
            <section>
                <h2 class="text-3xl font-bold mb-4 ml-4">Menu Management</h2>
                <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                    <h3 class="text-xl font-bold mb-4">Add New Menu Item</h3>
                    <form class="space-y-4" id="add-item-form" method="POST" enctype="multipart/form-data">
                        <div>
                            <label class="block text-gray-700" for="item-name">Item Name</label>
                            <input class="w-full p-2 border rounded-lg bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500" id="item-name" name="item_name" placeholder="Item Name" type="text" required/>
                        </div>
                        <div>
                            <label class="block text-gray-700" for="item-description">Description</label>
                            <input class="w-full p-2 border rounded-lg bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500" id="item-description" name="item_description" placeholder="Description" type="text" required/>
                        </div>
                        <div>
                            <label class="block text-gray-700" for="item-price">Price</label>
                            <input class="w-full p-2 border rounded-lg bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500" id="item-price" name="item_price" placeholder="Price" type="text" required/>
                        </div>
                        <div>
                            <label class="block text-gray-700" for="item-image">Choose Image</label>
                            <input class="w-full p-2 border rounded-lg bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500" id="item-image" name="item_image" type="file" required/>
                        </div>
                        <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg" name="add_item" type="submit">Add Item</button>
                    </form>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">Image</th>
                                <th class="py-2 px-4 border-b">Name</th>
                                <th class="py-2 px-4 border-b">Description</th>
                                <th class="py-2 px-4 border-b">Price</th>
                                <th class="py-2 px-4 border-b">Actions</th>
                            </tr>
                            <tbody id="menu-items">
                            <tr>
                            </tr>
                             </tbody>
                        </thead>
                        
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td class="py-2 px-4 border-b"><img src="<?php echo $row['image']; ?>" alt="Image of <?php echo $row['name']; ?>" class="w-16 h-16 object-cover"></td>
                                    <td class="py-2 px-4 border-b"><?php echo $row['name']; ?></td>
                                    <td class="py-2 px-4 border-b"><?php echo $row['description']; ?></td>
                                    <td class="py-2 px-4 border-b"><?php echo $row['price']; ?></td>
                                    <td class="py-2 px-4 border-b">
                                        <form action="menu_management.php" method="POST" style="display:inline;">
                                            <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="delete_item" class="bg-red-500 text-white px-4 py-2 rounded-lg">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </section>
    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function () {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        };

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });

        function confirmDelete(event) {
            const row = event.target.closest('tr');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    row.remove();
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                }
            });
        }

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', confirmDelete);
        });

        document.getElementById('add-item-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const itemName = document.getElementById('item-name').value;
            const itemDescription = document.getElementById('item-description').value;
            const itemPrice = document.getElementById('item-price').value;
            const itemImage = document.getElementById('item-image').files[0];

            const newRow = document.createElement('tr');
            const reader = new FileReader();
            reader.onload = function (e) {
                newRow.innerHTML = `
                    <td class="py-2"><img src="${e.target.result}" alt="Image of ${itemName}" class="w-16 h-16 object-cover"></td>
                    <td class="py-2">${itemName}</td>
                    <td class="py-2">${itemDescription}</td>
                    <td class="py-2">${itemPrice}</td>
                    <td class="py-2">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg edit-btn">Edit</button>
                        <button class="bg-red-500 text-white px-4 py-2 rounded-lg delete-btn">Delete</button>
                    </td>
                `;

                document.getElementById('menu-items').appendChild(newRow);

                document.querySelectorAll('.delete-btn').forEach(button => {
                    button.addEventListener('click', confirmDelete);
                });

                document.querySelectorAll('.edit-btn').forEach(button => {
                    button.addEventListener('click', openEditModal);
                });

                Swal.fire({
                    title: "Success!",
                    text: "New menu item has been added.",
                    icon: "success"
                });

                document.getElementById('add-item-form').reset();
            };
            reader.readAsDataURL(itemImage);
        });

        function openEditModal(event) {
            const row = event.target.closest('tr');
            const itemName = row.children[1].textContent;
            const itemDescription = row.children[2].textContent;
            const itemPrice = row.children[3].textContent;
            const itemImageSrc = row.children[0].children[0].src;

            Swal.fire({
                title: 'Edit Menu Item',
                html: `
                    <input id="edit-item-name" class="swal2-input" placeholder="Item Name" value="${itemName}">
                    <input id="edit-item-description" class="swal2-input" placeholder="Description" value="${itemDescription}">
                    <input id="edit-item-price" class="swal2-input" placeholder="Price" value="${itemPrice}">
                    <input id="edit-item-image" class="swal2-file" type="file">
                    <img id="edit-item-image-preview" src="${itemImageSrc}" class="w-16 h-16 object-cover mt-2">
                `,
                showCancelButton: true,
                confirmButtonText: 'Save',
                preConfirm: () => {
                    const newItemName = document.getElementById('edit-item-name').value;
                    const newItemDescription = document.getElementById('edit-item-description').value;
                    const newItemPrice = document.getElementById('edit-item-price').value;
                    const newItemImage = document.getElementById('edit-item-image').files[0];

                    row.children[1].textContent = newItemName;
                    row.children[2].textContent = newItemDescription;
                    row.children[3].textContent = newItemPrice;

                    if (newItemImage) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            row.children[0].children[0].src = e.target.result;
                        };
                        reader.readAsDataURL(newItemImage);
                    }
                }
            });

            document.getElementById('edit-item-image').addEventListener('change', function () {
                const file = this.files[0];
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('edit-item-image-preview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            });
        }

        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', openEditModal);
        });
    </script>
</body>
</html>
