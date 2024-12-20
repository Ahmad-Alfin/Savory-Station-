<?php

session_start();

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "savory_station"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    $sql = "INSERT INTO users (first_name, last_name, email, password) 
            VALUES ('$first_name', '$last_name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Form submitted successfully!";
        header('Location: login.php');
        exit();
    } else {
        $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
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
        }

        header {
            background-color: #f5e9dc;
            padding: 1rem 0;
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header img {
            height: 3rem;
            width: 3rem;
        }

        header nav a {
            color: black;
            margin-left: 2rem;
            text-decoration: none;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-size: cover;
        }

        main .bg-white {
            background-color: rgba(255, 255, 255, 0.9);
        }

        main .p-8 {
            padding: 2rem;
        }

        main .rounded-lg {
            border-radius: 0.5rem;
        }

        main .shadow-lg {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        main .pl-8 {
            padding-left: 2rem;
        }

        main .text-3xl {
            font-size: 1.875rem;
        }

        main .font-bold {
            font-weight: 700;
        }

        main .text-green-800 {
            color: #006400;
        }

        main .mb-4 {
            margin-bottom: 1rem;
        }

        main form .mb-4 {
            margin-bottom: 1rem;
        }

        main form .relative {
            position: relative;
        }

        main form input {
            width: 100%;
            padding: 0.5rem 0.75rem 0.5rem 2.5rem;
            border: 1px solid #ccc;
            border-radius: 0.5rem;
        }

        main form i {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        main form button[type="submit"] {
            width: 100%;
            background-color: #006400;
            color: white;
            padding: 0.75rem;
            border-radius: 0.5rem;
            cursor: pointer;
            border: none;
            font-size: 1rem;
        }

        main a {
            color: #007bff;
            text-decoration: none;
            margin-top: 1rem;
        }

        main a:hover {
            text-decoration: underline;
        }

        #snackbar {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
        }

        #snackbar.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from {bottom: 0; opacity: 0;} 
            to {bottom: 30px; opacity: 1;}
        }

        @keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }

        @-webkit-keyframes fadeout {
            from {bottom: 30px; opacity: 1;} 
            to {bottom: 0; opacity: 0;}
        }

        @keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }
    </style>
</head>
<body class="bg-white">

    <header class="bg-[#f5e9dc] py-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <img src="asset/logo.png" alt="Savory Station" class="h-12 w-12" width="50" height="50">
            </div>
            <nav class="space-x-8">
                <a href="menu.html" class="text-black">Menu</a>
                <a href="#" class="text-black">Reservations</a>
                <a href="#" class="text-black">Contact Us</a>
                <a href="index.php" class="text-black">Login</a>
            </nav>
        </div>
    </header>

    <main class="flex justify-center items-center h-screen bg-cover" style="background-image: url('asset/bg.png');">
        <div class="bg-white bg-opacity-90 p-8 rounded-lg shadow-lg flex">
            <div class="w-1/2">
                <img src="https://storage.googleapis.com/a1aa/image/tewoxADHXelvfoCXx9chIXeAKaI76tuA9xCxDxJRh5IcaRWOB.jpg" alt="Delicious food dishes" class="rounded-lg" width="400" height="400">
            </div>
            <div class="w-1/2 pl-8 flex flex-col items-center">
                <h2 class="text-3xl font-bold text-green-800 mb-4">Sign Up</h2>
                <form action="register-proses.php" method="post">
                    <div class="mb-4">
                        <label for="first_name" class="sr-only">First Name</label>
                        <div class="relative">
                            <input type="text" id="first_name" name="first_name" placeholder="First Name" class="w-full p-2 border border-gray-300 rounded-lg pl-10" required>
                            <i class="fas fa-user-circle absolute left-3 top-5 text-gray-400"></i>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="last_name" class="sr-only">Last Name</label>
                        <div class="relative">
                            <input type="text" id="last_name" name="last_name" placeholder="Last Name" class="w-full p-2 border border-gray-300 rounded-lg pl-10" required>
                            <i class="fas fa-user-circle absolute left-3 top-5 text-gray-400"></i>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="sr-only">Email</label>
                        <div class="relative">
                            <input type="email" id="email" name="email" placeholder="Email" class="w-full p-2 border border-gray-300 rounded-lg pl-10" required>
                            <i class="fas fa-user absolute left-3 top-5 text-gray-400"></i>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="sr-only">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Password" class="w-full p-2 border border-gray-300 rounded-lg pl-10" required>
                            <i class="fas fa-lock absolute left-3 top-5 text-gray-400"></i>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-green-800 text-white p-2 rounded-lg">Submit</button>
                </form>
                <a href="register.php" class="text-blue-600 mt-4 inline-block">belum mempunyai akun</a>
            </div>
        </div>
    </main>

    <div id="snackbar"><?= isset($_SESSION['message']) ? $_SESSION['message'] : ''; ?></div>
    <script>
        function showSnackbar() {
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }
    </script>

</body>
</html>
