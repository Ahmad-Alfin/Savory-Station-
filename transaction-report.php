<?php
include('koneksi.php');  
require_once("dompdf/autoload.inc.php");  

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$query = mysqli_query($koneksi, "SELECT * FROM orders");

$html = '<center><h3>Data Orders</h3></center><hr/><br>';
$html .= '<table border="1" width="100%">
            <tr>
                <th>No</th>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Order Date</th>
                <th>Order Total</th>
                <th>Actions</th>
            </tr>';

$no = 1;
while ($order = mysqli_fetch_array($query)) {
    $html .= "<tr>
                <td>" . $no . "</td>
                <td>" . $order['order_id'] . "</td>
                <td>" . $order['customer_name'] . "</td>
                <td>" . $order['order_date'] . "</td>
                <td>Rp. " . number_format($order['order_total'], 0, ',', '.') . "</td>
                <td>" . $order['actions'] . "</td>
            </tr>";
    $no++;
}

$html .= "</table>";

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'potrait');

$dompdf->render();

$dompdf->stream('laporan-orders.pdf');
?>
