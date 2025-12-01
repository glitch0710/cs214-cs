<?php

include "connection.php";

if (isset($_GET['q'])){
    $sql = "SELECT * FROM products a INNER JOIN categories b ON a.categoryID = b.categoryID INNER JOIN suppliers c ON a.supplierId = c.supplierID WHERE ProductName LIKE ? ORDER BY ProductID";
    $stmt = $conn->prepare($sql);
    $search = '%'.$_GET['q'].'%';
    $stmt->bind_param("s", $search);
}else{
    $sql = "SELECT * FROM products a INNER JOIN categories b ON a.categoryID = b.categoryID INNER JOIN suppliers c ON a.supplierId = c.supplierID ORDER BY ProductID";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    <h1>Products</h1>
    <form action="" method="GET">
        <label for="q">Search: </label>
        <input type="text" name="q" id="q" />
        <button type="submit">Search</button>
    </form>
    <br><br>
    <a href="index.php">Go Back</a>
    &emsp;
    <a href="addproduct.php">Add New Product</a>
    <br><br>
    <table border=1>
        <thead>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Supplier</th>
            <th>Category</th>
            <th>Unit</th>
            <th>Price</th>
        </thead>
        <tbody>
            <?php
                $result = $stmt->get_result();
                if ($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>".$row["ProductID"]."</td>";
                        echo "<td>".$row["ProductName"]."</td>";
                        echo "<td>".$row["SupplierName"]."</td>";
                        echo "<td>".$row["CategoryName"]."</td>";
                        echo "<td>".$row["Unit"]."</td>";
                        echo "<td>".$row["Price"]."</td>";
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>
    <?php
        $stmt->close();
    ?>
</body>
</html>