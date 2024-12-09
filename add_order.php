<?php

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $order_id = $_POST['order_id'];
    $customer_name = $_POST['customer_name'];
    $order_date = $_POST['order_date'];
    $order_total = $_POST['order_total'];

    $sql = "INSERT INTO orders (order_id, customer_name, order_date, order_total) 
            VALUES ('$order_id', '$customer_name', '$order_date', '$order_total')";

    if ($conn->query($sql) === TRUE) {

        echo "<script>
                alert('New order has been added.');
                window.location.href = 'order.php';
              </script>";
    } else {

        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
