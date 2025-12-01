<?php

include "connection.php";

if (isset($_POST['submitdata'])){
    $productname = $_POST['productname']; //s
    $supplierid = $_POST['supplierid']; // i
    $categoryid = $_POST['categoryid']; // i
    $unit = $_POST['unit']; // s
    $price = $_POST['price']; // d

    $sql = "INSERT INTO products (ProductName, SupplierID, CategoryID, Unit, Price) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false){
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt->bind_param("siisd", $productname, $supplierid, $categoryid, $unit, $price);

    if ($stmt->execute()){
        echo "<script type='text/javascript'>alert('New product has been added.'); window.location.href = 'products.php';</script>";
    }else{
        echo "<script type='text/javascript'>alert('An error has been encountered: ".$conn->error."');</script>";
    }

    $stmt->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <h1>Add New Product</h1>
    <form action="" method="POST">
        <label for="productname">Product Name</label><br>
        <input type="text" name="productname" id="productname" /><br>
        <label for="supplierid">Supplier ID</label><br>
        <input type="text" name="supplierid" id="supplierid" /><br>
        <label for="categoryid">Category ID</label><br>
        <input type="text" name="categoryid" id="categoryid" /><br>
        <label for="unit">Unit</label><br>
        <input type="text" name="unit" id="unit" /><br>
        <label for="price">Price</label><br>
        <input type="number" step="0.1" name="price" id="price" /><br><br>
        <button type="submit" name="submitdata">Save Product</button>
        <a href="products.php">Cancel</a>
    </form>
</body>
</html>