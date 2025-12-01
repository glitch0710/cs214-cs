<?php

include "connection.php";

$categoryid = $_GET['categoryid'];

$sql = "DELETE FROM categories WHERE CategoryID = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false){
    die("Connection failed: " . $conn->connect_error);
}

$stmt->bind_param("i", $categoryid);

if ($stmt->execute()){
    echo "<script type='text/javascript'>alert('Category ".$categoryid." has been deleted.'); window.location.href = 'categories.php';</script>";
}else{
    echo "<script type='text/javascript'>alert('An error has been encountered: ".$conn->error."');</script>";
}

$stmt->close();
$conn->close();

?>