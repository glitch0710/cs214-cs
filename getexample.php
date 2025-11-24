<?php

if (isset($_GET['submitform'])){
    echo "Email: ". $_GET['firstname'];
    echo "<br>";
    echo "Password: ". $_GET['lastname'];
}else{
    echo "parameters does not exist yet.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GET Example</title>
</head>
<body>
    <form action="" method="GET">
        <label for="firstname">Email: </label>
        <input type="text" name="firstname" id="firstname" />
        <label for="lastname">Password: </label>
        <input type="text" name="lastname" id="lastname" />
        <button type="submit" name="submitform">Submit</button>
    </form>
</body>
</html>