<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_burgers";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data from the database
$sql = "SELECT item_name, item_img, item_price FROM tbl_items";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="add-order.css">

    <style>

    </style>
    <title>Angels Burger</title>
</head>

<body>
    <header>
    <div class="navbar">
    <div class="logo"><a href="#">Angel's Burger</a></div>
    <ul class="links">
         <li><a href="#" data-content-id="home-content">HOME</a></li>
        <li><a href="#" data-content-id="addorder-content">ADD ORDER</a></li>
        <li><a href="#" data-content-id="order-content">ORDERS</a></li>

        <li class="dropdown">
        <a href="#" onclick="toggleDropdown()" class="dropdown-toggle">MENU</a>
            <ul class="dropdown-menu">
            <li class="menu-items"><a href="#" data-content-id="hamburgers-content" style="color: black;">ABOUT US</a></li>
                <li class="menu-items"><a href="#" data-content-id="hamburgers-content" style="color: black;">HAMBURGERS</a></li>
                <li class="menu-items"><a href="#" data-content-id="hotdogs-content" style="color: black;">HOTDOG SANDWICHES</a></li>
                <li class="menu-items"><a href="#" data-content-id="hamsandwiches-content" style="color: black;">HAM SANDWICHES</a></li>
                <li class="menu-items"><a href="#" data-content-id="baconsandwiches-content" style="color: black;">BACON SANDWICHES</a></li>
                <li class="menu-items"><a href="#" data-content-id="drinks-content" style="color: black;">DRINKS</a></li>
            </ul>
        </li>
    </ul>
  
            <div class="search-bar">
                <input type="text" placeholder="Search...">
                <button type="button"><i class="fas fa-search"></i></button>
            </div>

            </div>

    </header>

    <main>
        <section id="hamburgers-content" class="content-section">
            <h2>Hamburgers</h2>
            <div class="hamburger-container">
                <div class="hamburger-item">
                    <div class="hamburger-details">
                        <img src="hamburger1.jpg" alt="BeefBurger">
                        <h3>Beef Burger Sandwich</h3>
                        <p>Price: ₱30.00 </p>
                    </div>
                </div>
                <!-- Add more hamburger items as needed -->
                <div class="hamburger-item">
                    <div class="hamburger-details">
                        <img src="hamburger1.jpg" alt="HamBurger">
                        <h3>Cheeseburger Sandwich</h3>
                        <p>Price: ₱40.00</p>
                    </div>
                </div>
        </section>

        <section id="hotdogs-content" class="content-section">
            <h2>Hotdog Sandwiches</h2>
            <div class="hotdogs-container">
                <div class="hotdogs-item">
                    <div class="hotdogs-details">
                        <img src="hamburger1.jpg" alt="CheesyHotdog">
                        <h3>Cheesy Hotdog Sandwich</h3>
                        <p>Price: ₱30.00</p>
                    </div>
                </div>
                <!-- Add more hotdog items as needed -->
                <div class="hotdogs-item">
                    <div class="hotdogs-details">
                        <img src="hamburger1.jpg" alt="Jumbo">
                        <h3>Jumbo Cheese Footlong Sandwich</h3>
                        <p>Price: ₱45.00</p>
                    </div>
                </div>
                <div class="hotdogs-item">
                    <div class="hotdogs-details">
                        <img src="hamburger1.jpg" alt="Hungarian">
                        <h3>Jumbo Cheese Hungarian Sandwich</h3>
                        <p>Price: ₱55.00</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="hamsandwiches-content" class="content-section">
            <h2>Ham Sandwiches</h2>
            <div class="hams-container">
                <div class="hams-item">
                    <div class="hams-details">
                        <img src="hamburger1.jpg" alt="HamSandwich">
                        <h3>Ham Sandwich</h3>
                        <p>Price: ₱18.00</p>
                    </div>
                </div>
                <div class="hams-item">
                    <div class="hams-details">
                        <img src="hamburger1.jpg" alt="HamAndCheese">
                        <h3>Ham and Cheese Sandwich</h3>
                        <p>Price: ₱23.00</p>
                    </div>
                </div>
                <div class="hams-item">
                    <div class="hams-details">
                        <img src="hamburger1.jpg" alt="HamAndEgg">
                        <h3>Ham and Egg Sandwich</h3>
                        <p>Price: ₱30.00</p>
                    </div>
                </div>
                <div class="hams-item">
                    <div class="hams-details">
                        <img src="hamburger1.jpg" alt="HamCheeseEgg">
                        <h3>Ham, Cheese and Egg Sandwich</h3>
                        <p>Price: ₱35.00</p>
                    </div>
                </div>
            </div>
        </section>



        <section id="baconsandwiches-content" class="content-section">
            <h2>Bacon Sandwiches</h2>
            <div class="bacon-container">
                <div class="bacon-item">
                    <div class="bacon-details">
                        <img src="hamburger1.jpg" alt="Bacon">
                        <h3>Bacon Sandwich</h3>
                        <p>Price: ₱25.00</p>
                    </div>
                </div>
                <div class="bacon-item">
                    <div class="bacon-details">
                        <img src="hamburger1.jpg" alt="BaconAndCheese">
                        <h3>Bacon and Cheese Sandwich</h3>
                        <p>Price: ₱30.00</p>
                    </div>
                </div>
                <div class="bacon-item">
                    <div class="bacon-details">
                        <img src="hamburger1.jpg" alt="BaconAndEgg">
                        <h3>Bacon and Egg Sandwich</h3>
                        <p>Price: ₱37.00</p>
                    </div>
                </div>
                <div class="bacon-item">
                    <div class="bacon-details">
                        <img src="hamburger1.jpg" alt="BaconCheeseEgg">
                        <h3>Bacon, Cheese and Egg Sandwich</h3>
                        <p>Price: ₱42.00</p>
                    </div>
                </div>
                <div class="bacon-item">
                    <div class="bacon-details">
                        <img src="hamburger1.jpg" alt="Egg">
                        <h3>Egg Sandwich</h3>
                        <p>Price: ₱16.00</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="addons-content" class="content-section">
            <h2>Add Ons</h2>
            <div class="addons-container">
                <!-- Add-ons items go here -->
            </div>
        </section>

        <section id="additional-items-content" class="content-section">
            <h2>Additional Items</h2>
            <div class="additional-items-container">
                <div class="additional-item">
                    <div class="additional-details">
                        <img src="egg.jpg" alt="Egg">
                        <h3>Egg Sandwich</h3>
                        <p>Price: ₱12.00</p>
                    </div>
                </div>
                <div class="additional-item">
                    <div class="additional-details">
                        <img src="cheese.jpg" alt="Cheese">
                        <h3>Cheese Sandwich</h3>
                        <p>Price: ₱15.00</p>
                    </div>
                </div>
                <!-- Add more additional items as needed -->
            </div>
        </section>






        <section id="drinks-content" class="content-section">
            <h2>Drinks</h2>
            <div class="drinks-container">
                <div class="drinks-item">
                    <div class="drinks-details">
                        <img src="lipton.jpg" alt="Lipton">
                        <h3>Lipton Iced Tea</h3>
                        <p>Price: ₱30.00</p>
                    </div>
                </div>

                <!-- Add more drinks items as needed -->

                <div class="drinks-item">
                    <div class="drinks-details">
                        <img src="water.jpg" alt="Water">
                        <h3>Bottled Water</h3>
                        <p>Price: ₱16.00</p>
                    </div>
                </div>

                <!-- Add more drinks items as needed -->

                <div class="drinks-item">
                    <div class="drinks-details">
                        <img src="mug.jpg" alt="Mug">
                        <h3>Mug</h3>
                        <p>Price: ₱18.00</p>
                    </div>
                </div>

                <!-- Add more drinks items as needed -->

                <div class="drinks-item">
                    <div class="drinks-details">
                        <img src="mirinda.jpg" alt="Mirinda">
                        <h3>Mirinda</h3>
                        <p>Price: ₱17.00</p>
                    </div>
                </div>

                <!-- Add more drinks items as needed -->

                <div class="drinks-item">
                    <div class="drinks-details">
                        <img src="pepsi.jpg" alt="Pepsi">
                        <h3>Pepsi</h3>
                        <p>Price: ₱17.00</p>
                    </div>
                </div>

                <!-- Add more drinks items as needed -->

                <div class="drinks-item">
                    <div class="drinks-details">
                        <img src="7-up.jpg" alt="7-Up">
                        <h3>7-Up</h3>
                        <p>Price: ₱16.00</p>
                    </div>
                </div>
            </div>
        </section>

        </main>

    <section class="content-section" id="home-content">
        <!-- Initial content when the page loads -->
        <h1>WELCOME!</h1>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit...</p>
    </section>



    <!-- ADD ORDER content-page -->
    <section class="content-section" id="addorder-content">
        <h3>ADD ORDER</h3>
        <!-- Form to add items to the order -->
        <form id="add-order-form" action="process_add_order.php" method="post">
            <!-- Display your products in a table -->
            <table class="content-table">
                <thead>
                    <tr>
                        <th colspan="4" class="table-title">Hamburger</th>
                    </tr>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <!-- Display product information in the table body -->
                <tbody class="text-center">
                    <?php
                    // Fetch and display products from the database
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['item_name']}</td>";
                        echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['item_img']) . "' alt='{$row['item_name']}' style='width: 50px; height: 50px;'></td>";
                        echo "<td>{$row['item_price']}</td>";
                        echo "<td><button class='add-to-order-button' data-product-name='{$row['item_name']}' data-product-img='" . base64_encode($row['item_img']) . "' data-product-price='{$row['item_price']}'>Add to Order</button></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </form>


<!-- JavaScript to handle adding items to the order -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {
        // Additional check for the selection of buttons
        var addToOrderButtons = $('.add-to-order-button');
        console.log(addToOrderButtons); // Check if buttons are selected

        addToOrderButtons.on('click', function () {
            // Your existing click event handler
            const productName = $(this).data('product-name');
            const productImg = $(this).data('product-img');
            const productPrice = $(this).data('product-price');

            addToOrder(productName, productImg, productPrice);

            // Scroll to the 'order-content' section
            $('html, body').animate({
                scrollTop: $("#order-content").offset().top + 'px'
            }, 1000);

            return false; // Prevent default link behavior
        });
    });

    function addToOrder(name, img, price) {
        var contentTable = $("#content-table");

        var newRow = $("<tr>");
        newRow.append("<td>" + name + "</td>");
        newRow.append("<td><img src='data:image/jpeg;base64," + img + "' alt='" + name + "' style='width: 50px; height: 50px;'></td>");
        newRow.append("<td>" + price + "</td>");

        contentTable.append(newRow);
    }
</script>


    </section>



   <section class="content-section" id="order-content">
        <!-- Content for the "ORDER HISTORY" page -->
        <h1>ORDER PAGE</h1>
        <p>This is the content for the ORDER page...</p>
        <form id="confirm-order-form" action="process_confirm_order.php" method="post">
            <!-- Display items added to the order in a table -->
            <table class="content-table">
                <!-- ... Your order table header ... -->

                <tbody class="text-center" id="order-items">
                    <!-- Dynamically populated with JavaScript -->
                </tbody>
            </table>

            <!-- Customer information fields -->
            <label for="customer-name">Customer Name:</label>
            <input type="text" id="customer-name" name="customer_name" required>

            <label for="customer-email">Customer Email:</label>
            <input type="email" id="customer-email" name="customer_email" required>

            <!-- ... Add more customer information fields as needed ... -->

            <button type="submit">Confirm Order</button>
        </form>
    </section>
    <script>
        // JavaScript to handle displaying items in the order form
        document.addEventListener('DOMContentLoaded', function () {
            // Function to add items to the order form
            function addToOrder(productName, productPrice, quantity) {
                const orderItemsContainer = document.getElementById('order-items');
                const row = document.createElement('tr');
                row.innerHTML = `<td>${productName}</td><td>${productPrice}</td><td>${quantity}</td>`;
                orderItemsContainer.appendChild(row);
            }

            // Example: Add items to the order form
            addToOrder('Product 1', '$10.00', 2);
            addToOrder('Product 2', '$15.00', 1);
            // ...

            // TODO: Add functionality to dynamically add items to the order form
        });
    </script>
    


    


    




        <script>
    document.addEventListener('DOMContentLoaded', function () {
        function loadPage(contentId) {
            var contentSections = document.querySelectorAll('.content-section');

            contentSections.forEach(function (section) {
                section.style.display = 'none';
            });

            var selectedSection = document.getElementById(contentId);
            if (selectedSection) {
                selectedSection.style.display = 'block';
            }
        }

        function toggleDropdown() {
            var dropdownMenu = document.querySelector('.dropdown-menu');
            dropdownMenu.classList.toggle('show');
        }

        var menuItems = document.querySelectorAll('.navbar li a');
        menuItems.forEach(function (menuItem) {
            menuItem.addEventListener('click', function (event) {
                event.preventDefault();
                var contentId = this.getAttribute('data-content-id');
                loadPage(contentId);
            });
        });

        var dropdownToggle = document.querySelector('.dropdown-toggle');
        dropdownToggle.addEventListener('click', function () {
            toggleDropdown();
        });
    });
</script>











</body>

</html>