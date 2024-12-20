<?php
session_start(); 

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "savory_station";

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$query_users = "SELECT COUNT(*) AS total_users FROM users";
$result_users = mysqli_query($koneksi, $query_users);
$row_users = mysqli_fetch_assoc($result_users);
$total_users = $row_users['total_users'];

mysqli_close($koneksi);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
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
  <title>
    Savory Station
  </title>
</head>
<body>
  <div class="sidebar">
   <div class="logo-details">
    <i class="bx bx-store"></i>
    <span class="logo_name">Savory Station</span>
   </div>
   <ul class="nav-links">
    <li>
     <a class="active" href="dashboard.php">
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
      <h2 id="text"></h2>
      <h3 id="date"></h3>
    <section class="mb-8">
     <h2 class="text-3xl font-bold mb-4 ml-4">Dashboard</h2>
     <div class="grid grid-cols-3 gap-8">
      <div class="bg-white p-6 rounded-lg shadow-md ml-4">
       <h3 class="text-xl font-bold mb-2">Total Orders</h3>
       <p class="text-2xl font-bold">120</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-md ml-4">
       <h3 class="text-xl font-bold mb-2">Total Revenue</h3>
       <p class="text-2xl font-bold">Rp 3.000.000,00</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-md ml-4">
       <h3 class="text-xl font-bold mb-2">Total Reservations</h3>
       <p class="text-2xl font-bold">45</p>
      </div>
     </div>
    
    </section>
    <div class="bg-white p-6 rounded-lg shadow-md ml-4">
    <h3 class="text-xl font-bold mb-2">Total Users</h3>
    <p class="text-2xl font-bold"><?php echo $total_users; ?></p>
</div>
   </div>
  </section>

  <script>
    window.onload = function () {
        let nama = prompt("Masukkan Nama Anda : ", "Admin");
        let jam = new Date().getHours();
        if (nama != null) {
            if (jam >= 4 && jam <= 10) {
                document.getElementById("text").innerHTML = `Selamat Pagi ${nama}`;
            } else if (jam >= 11 && jam <= 14) {
                document.getElementById("text").innerHTML = `Selamat Siang ${nama}`;
            } else if (jam >= 15 && jam <= 18) {
                document.getElementById("text").innerHTML = `Selamat Sore ${nama}`;
            } else {
                document.getElementById("text").innerHTML = `Selamat Malam ${nama}`;
            }
        }
        myFunction();
    };
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function () {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
            sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    };
  </script>
</body>
</html>
