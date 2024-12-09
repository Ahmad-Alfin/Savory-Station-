<?php
// Menghubungkan ke database
include 'db.php';

// Mengambil data dari tabel orders
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
?>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
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
    </style>
    <title>Savory Station</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class="bx bx-store"></i>
            <span class="logo_name">Savory Station</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="dashboard.php">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="order.php" class="active">
                    <i class="bx bx-receipt"></i>
                    <span class="links_name">Recent Orders</span>
                </a>
            </li>
            <li>
                <a href="menumanagement.php">
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
                <h2 class="text-3xl font-bold mb-4 ml-4">Recent Orders</h2>
                <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                    <h3 class="text-xl font-bold mb-4">Add New Order</h3>
                    <form class="space-y-4" id="add-order-form" action="add_order.php" method="POST">
                        <div>
                            <label class="block text-gray-700" for="order-id">Order ID</label>
                            <input class="w-full p-2 border rounded-lg bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500" id="order-id" name="order_id" placeholder="Order ID" type="text"/>
                        </div>
                        <div>
                            <label class="block text-gray-700" for="customer-name">Customer Name</label>
                            <input class="w-full p-2 border rounded-lg bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500" id="customer-name" name="customer_name" placeholder="Customer Name" type="text"/>
                        </div>
                        <div>
                            <label class="block text-gray-700" for="order-date">Order Date</label>
                            <input class="w-full p-2 border rounded-lg bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500" id="order-date" name="order_date" placeholder="Order Date" type="date"/>
                        </div>
                        <div>
                            <label class="block text-gray-700" for="order-total">Order Total</label>
                            <input class="w-full p-2 border rounded-lg bg-gray-100 border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500" id="order-total" name="order_total" placeholder="Order Total" type="text"/>
                        </div>
                        <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg" type="submit">Add Order</button>
                    </form>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="text-left py-2">Order ID</th>
                                <th class="text-left py-2">Customer Name</th>
                                <th class="text-left py-2">Order Date</th>
                                <th class="text-left py-2">Order Total</th>
                                <th class="text-left py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="order-items">
                        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                    <a href="transaction-report.php" class="bg-green-500 text-white px-4 py-2 rounded-lg">
                        Print Transaction Report
                    </a>
                </div>           
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

        document.getElementById('add-order-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const orderId = document.getElementById('order-id').value;
            const customerName = document.getElementById('customer-name').value;
            const orderDate = document.getElementById('order-date').value;
            const orderTotal = document.getElementById('order-total').value;

            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td class="py-2">${orderId}</td>
                <td class="py-2">${customerName}</td>
                <td class="py-2">${orderDate}</td>
                <td class="py-2">${orderTotal}</td>
                <td class="py-2">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg edit-btn">Edit</button>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg delete-btn">Delete</button>
                </td>
            `;

            document.getElementById('order-items').appendChild(newRow);

            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', confirmDelete);
            });

            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', openEditModal);
            });

            Swal.fire({
                title: "Success!",
                text: "New order has been added.",
                icon: "success"
            });

            document.getElementById('add-order-form').reset();
        });

        function openEditModal(event) {
            const row = event.target.closest('tr');
            const orderId = row.children[0].textContent;
            const customerName = row.children[1].textContent;
            const orderDate = row.children[2].textContent;
            const orderTotal = row.children[3].textContent;

            Swal.fire({
                title: 'Edit Order',
                html: `
                    <input id="edit-order-id" class="swal2-input" placeholder="Order ID" value="${orderId}">
                    <input id="edit-customer-name" class="swal2-input" placeholder="Customer Name" value="${customerName}">
                    <input id="edit-order-date" class="swal2-input" placeholder="Order Date" value="${orderDate}" type="date">
                    <input id="edit-order-total" class="swal2-input" placeholder="Order Total" value="${orderTotal}">
                `,
                showCancelButton: true,
                confirmButtonText: 'Save',
                preConfirm: () => {
                    const newOrderId = document.getElementById('edit-order-id').value;
                    const newCustomerName = document.getElementById('edit-customer-name').value;
                    const newOrderDate = document.getElementById('edit-order-date').value;
                    const newOrderTotal = document.getElementById('edit-order-total').value;

                    row.children[0].textContent = newOrderId;
                    row.children[1].textContent = newCustomerName;
                    row.children[2].textContent = newOrderDate;
                    row.children[3].textContent = newOrderTotal;
                }
            });
        }

        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', openEditModal);
        });
    </script>
</body>
</html>