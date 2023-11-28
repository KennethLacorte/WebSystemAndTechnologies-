<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="confirm_order.css">

    <title>Confirm Order</title>
</head>

<body>

    <div class="container">

        <form id="confirm-order" method="POST" action="user.php" enctype="multipart/form-data">

            <p class="title">Customer Information: </p>
          


            <a href="org.php">
                <div class="home-icon">
                    <i class='bx bx-home'></i>
                </div>
            </a>

            <div class="input-customer-name">
                <label for="customerName">Customer Name:</label>
                <input type="text" name="customerName" id="customerName" required />
            </div>

            <div class="input-order-date">
                <label for="orderDate">Order Date:</label>
                <input type="date" name="orderDate" id="orderDate" required />
            </div>
        
 
            <input type="button" value="Cancel" class="cancel-button" onclick="window.location.href='user.php'">
            <input type="confirm" value="Confirm Order" class="confirm-button">

        </form>
    </div>
</body>

</html>