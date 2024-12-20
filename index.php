<?php
// Pastikan session dimulai jika ingin melakukan pengecekan login
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reservations & Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/menu.css" /> <!-- Assuming your custom CSS file is included here -->
</head>
<body class="bg-white text-gray-800">
    <header class="bg-[#f5e8d8] p-4 flex justify-between items-center">
        <div class="flex items-center">
            <img src="asset/logo.png" alt="logo" class="h-10 w-10" />
        </div>
        <nav class="space-x-4">
            <a href="menu.php" class="text-gray-800 hover:text-gray-600">Menu</a>
            <a href="reservations.php" class="text-gray-800 hover:text-gray-600">Reservations</a>
            <a href="#" class="text-gray-800 hover:text-gray-600">Contact Us</a>

            <!-- Pengecekan apakah user sudah login atau belum -->
            <?php if (!isset($_SESSION['email'])): ?>
                <a href="login.php" class="text-gray-800 hover:text-gray-600">Login</a>
            <?php else: ?>
                <!-- Jika sudah login, tampilkan menu logout atau halaman lainnya -->
                <a href="logout.php" class="text-gray-800 hover:text-gray-600">Logout</a>
            <?php endif; ?>
        </nav>
    </header>
    <main class="p-8">
        <div class="flex justify-between">
            <div class="w-2/3">
                <img src="asset/foto1.png" alt="img" class="rounded-lg w-full" />
            </div>
            <div class="w-1/3 pl-8">
                <h2 class="text-xl font-bold mb-4">Reservations</h2>
                <form class="space-y-4" method="POST" action="login.php"> <!-- Action can be a PHP file that processes the form -->
                    <input type="text" name="name" placeholder="Name" class="form-input" />
                    <input type="email" name="email" placeholder="Email" class="form-input" />
                    <input type="tel" name="phone" placeholder="Phone" class="form-input" />
                    <input type="date" name="date" placeholder="Date" class="form-input" />
                    <input type="time" name="time" placeholder="Time" class="form-input" />
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg">Submit Reservation</button>
                </form>
            </div>
        </div>
        <section class="mt-18">
            <h2 class="text-2xl font-bold mb-4">Menu</h2>
            <div class="flex space-x-4 mb-4">
                <a href="#" class="text-gray-800 font-bold border-b-2 border-yellow-500">All</a>
                <a href="#" class="text-gray-800 hover:text-gray-600">Dinner</a>
                <a href="#" class="text-gray-800 hover:text-gray-600">Dessert</a>
                <a href="#" class="text-gray-800 hover:text-gray-600">Beverage</a>
            </div>
            <div class="space-y-4">
                <!-- Menu Items Section -->
                <div class="menu-item">
                    <div class="flex items-center">
                        <img src="https://storage.googleapis.com/a1aa/image/GvlvsSZ8RaoeHSxcqpio4OxeScnMFoXDOqy4MIgtZtmxLSlTA.jpg" alt="Souffle Pancake" class="h-12 w-12 rounded-lg" />
                        <div class="ml-4">
                            <h3 class="text-lg font-bold">Classic Breakfast</h3>
                            <p class="text-gray-600">Souffle Pancake</p>
                        </div>
                    </div>
                    <div class="menu-item-right">
                        <span class="text-lg font-bold">Rp 25.000,00</span>
                        <button class="order-button">Order Now</button>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="flex items-center">
                        <img src="https://storage.googleapis.com/a1aa/image/DcJ4a6NyMhJrGNlLbYCCJAWvc8qZzVfm67cAlslyBIa6FpyJA.jpg" alt="Crispy Chicken, Waffle, and Syrup" class="h-12 w-12 rounded-lg" />
                        <div class="ml-4">
                            <h3 class="text-lg font-bold">Chicken & Waffle</h3>
                            <p class="text-gray-600">Crispy Chicken, Waffle, and Syrup</p>
                        </div>
                    </div>
                    <div class="menu-item-right">
                        <span class="text-lg font-bold">Rp 40.000,00</span>
                        <button class="order-button">Order Now</button>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="flex items-center">
                        <img src="https://storage.googleapis.com/a1aa/image/FtLO0f0lDtSXAi6vgMr7biLrtK2shVpdf9ipLn73OIUuLSlTA.jpg" alt="Spaghetti" class="h-12 w-12 rounded-lg" />
                        <div class="ml-4">
                            <h3 class="text-lg font-bold">Spaghetti</h3>
                            <p class="text-gray-600">Spaghetti</p>
                        </div>
                    </div>
                    <div class="menu-item-right">
                        <span class="text-lg font-bold">Rp 35.000,00</span>
                        <button class="order-button">Order Now</button>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
