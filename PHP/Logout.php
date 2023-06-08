<?php

session_start();

$conn = new mysqli('localhost', 'root', '', 'serveja');

$codigo = $_GET['code'];
$status = "Livre";
// $sql = "SELECT `id` FROM `mesa` WHERE `codigo` = '$codigo'";
// $stmt = $conn->prepare($sql);
// $stmt->execute();
// $stmt->store_result();

// while ($row = $result->fetch_assoc()) {
//     $id= $row["id"];
// }

$query = " UPDATE mesa SET status = '$status', nome_cliente = '' WHERE codigo='$codigo' ";

$query_run = mysqli_query($conn, $query);

session_start();
session_unset();
session_destroy();

header("Location: /serveja/login.php");
