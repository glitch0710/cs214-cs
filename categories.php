<?php

include "connection.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
</head>
<body>
    <h1>Categories</h1>
    <form action="" method="GET">
        <label for="q">Search: </label>
        <input type="text" name="q" id="q" />
        <button type="submit">Search</button>
    </form>
    <br><br>
    <?php

        if (isset($_GET['q'])){
            $sql = "SELECT * FROM categories WHERE CategoryName LIKE ?";
            $stmt = $conn->prepare($sql);
            $search = '%'.$_GET['q'].'%';
            $stmt->bind_param("s", $search);
        }else{
            $sql = "SELECT * FROM categories";

            $stmt = $conn->prepare($sql);
        }
        
        $stmt->execute();
    ?>
    <table border="2">
        <thead>
            <th>CategoryID</th>
            <th>CategoryName</th>
            <th>Description</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
            ?>
            <tr>
                <td><?php echo $row["CategoryID"] ?></td>
                <td><?php echo $row["CategoryName"] ?></td>
                <td><?php echo $row["Description"] ?></td>
                <td><a href="#">Edit</a></td>
            </tr>
        </tbody>
        <?php } ?>
    </table>
    <br><br>
    <a href="index.php">Go Back</a>
    &emsp;
    <a href="addcategory.php">Add Category</a>
    <?php
        }
    
        $stmt->close();
    ?>
</body>
</html>