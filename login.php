<?php
session_start();
if (isset($_SESSION['email'])) {
    // Jika sudah login, arahkan ke halaman utama
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Savorystation - Sign In</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: white;
        }
    </style>
</head>
<body class="bg-white">

<header class="bg-[#f5e9dc] py-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center">
            <img src="asset/logo.png" alt="Sunny Kitchen Logo" class="h-12 w-12" width="50" height="50">
        </div>
        <nav class="space-x-8">
            <a href="index.php" class="text-black">Menu</a>
            <a href="#" class="text-black">Reservations</a>
            <a href="#" class="text-black">Contact Us</a>
            <a href="login.php" class="text-black">Login</a>
        </nav>
    </div>
</header>

<main class="flex justify-center items-center h-screen bg-cover bg-center" style="background-image: url('asset/bg.png');">
    <div class="form-container bg-white bg-opacity-75 p-8 rounded-lg shadow-lg flex">
        <div class="w-1/2">
            <img src="https://storage.googleapis.com/a1aa/image/tewoxADHXelvfoCXx9chIXeAKaI76tuA9xCxDxJRh5IcaRWOB.jpg" alt="Delicious food dishes" class="rounded-lg" width="400" height="400">
        </div>
        <div class="form-content w-1/2 pl-8 flex flex-col items-center">
            <h2 class="text-3xl font-bold text-green-800 mb-4 text-center">Sign In</h2>
            <form action="login-proses.php" method="post">
                <div class="input-group mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <div class="relative">
                        <input type="email" id="email" name="email" placeholder="Email" class="w-full p-2 border border-gray-300 rounded-lg pl-10" required>
                        <i class="fas fa-user absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
                <div class="input-group mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="Password" class="w-full p-2 border border-gray-300 rounded-lg pl-10" required>
                        <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
                <button type="submit" class="w-full bg-green-800 text-white p-2 rounded-lg">Submit</button>
            </form>
            <a href="register.php" class="register-link text-blue-600 mt-4 inline-block">belum mempunyai akun</a>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (!empty($message)): ?>
    <script>
        // Jika $message berisi pesan, tampilkan dengan SweetAlert
        Swal.fire({
            icon: 'info',
            title: 'Message',
            text: '<?php echo $message; ?>'
        });
    </script>
<?php endif; ?>

</body>
</html>
