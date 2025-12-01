<?php

include "connection.php";


if (isset($_GET['categoryid'])){
    $categoryid = $_GET['categoryid']; // i

    $sql = "SELECT * FROM categories WHERE CategoryID = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false){
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt->bind_param("i", $categoryid);

    if ($stmt->execute() === false){
        echo "<script type='text/javascript'>alert('An error has been encountered: ".$conn->error."');</script>";
    }

    $result = $stmt->get_result();

    if ($result->num_rows == 0){
        echo "<script type='text/javascript'>alert('Category does not exist!'); window.location.href = 'categories.php';</script>";
    }

    $row = $result->fetch_assoc();
}else{
    echo "<script type='text/javascript'>alert('Invalid Category'); window.location.href = 'categories.php';</script>";
}

if(isset($_POST['submitdata'])){
    $categoryname = $_POST['categoryname']; // s
    $desc = $_POST['description']; // s

    $sql = "UPDATE categories SET CategoryName = ?, Description = ? WHERE CategoryID = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false){
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt->bind_param("ssi", $categoryname, $desc, $categoryid);

    if ($stmt->execute()){
        echo "<script type='text/javascript'>alert('Category ".$categoryid." has been updated.'); window.location.href = 'categories.php';</script>";
    }else{
        echo "<script type='text/javascript'>alert('An error has been encountered: ".$conn->error."');</script>";
    }
}

$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category <?php echo $categoryid ?></title>
</head>
<body>
    <h1>Edit Category</h1>
    <br>
    <form action="" method="POST">
        <label for="categoryname">Category Name </label><br>
        <input type="text" name="categoryname" value="<?php echo $row['CategoryName']?>" id="categoryname" />
        <br><br>
        <label for="description">Description</label><br>
        <textarea name="description" id="description" rows="5"><?php echo $row['Description']?></textarea><br><br>
        <button type="submit" name="submitdata">Save Category</button>
        <a href="categories.php">Cancel</a>
    </form>
</body>
</html>