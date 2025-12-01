<?php

include "connection.php";

if (isset($_POST['submitdata'])) {
    $categoryname = $_POST['categoryname']; // s
    $desc = $_POST['description']; // s

    $sql = "INSERT INTO categories (CategoryName, Description) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false){
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt->bind_param("ss", $categoryname, $desc);

    if ($stmt->execute()){
        echo "<script type='text/javascript'>alert('New category has been added.'); window.location.href = 'categories.php';</script>";
    }else{
        echo "<script type='text/javascript'>alert('An error has been encountered: ".$conn->error."');</script>";
    }

    $conn->close();
    $stmt->close();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
</head>
<body>
    <h1>Add New Category</h1>
    <br>
    <form action="" method="POST">
        <label for="categoryname">Category Name </label><br>
        <input type="text" name="categoryname" id="categoryname" />
        <br><br>
        <label for="description">Description</label><br>
        <textarea name="description" id="description" rows="5"></textarea><br><br>
        <button type="submit" name="submitdata">Save Category</button>
        <a href="categories.php">Cancel</a>
    </form>
</body>
</html>