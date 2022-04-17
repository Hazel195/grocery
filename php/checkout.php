<?php
    session_start();
    $total_cost = $_SESSION["total"]["cost"];
    $total_number = $_SESSION["total"]["number"];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
    <h1> Checkout <?php echo $total_number ?> items : $ <?php echo $total_cost ?> </h1>


    <form action="order--complete.php" method="post">
        <table>
            <tr>
                <th>Name</th>
                <th>
                    <input type="text" id="f--name" name="f--name" placeholder="first name" required> 
                    <input type="text" id="l--name" name="l--name"  placeholder="last name" required>
                </th>
            </tr>
            <tr>
            <th>Address</th>
                <th>
                    <input type="text" id="address" name="address" placeholder="unit/street" required> 
                    <input type="text" id="suburb" name="suburb"  placeholder="suburb" required>
                </th>
            </tr>
            <tr>
                <th>
                    <input type="text" id="state" name="state" placeholder="state" required> 
                    <input type="text" id="country" name="country"  placeholder="country" required>
                </th>
            </tr>
            <tr>
                <th></th>
                <td></td>
            </tr>
        </table>
    </form>
</body>
</html>