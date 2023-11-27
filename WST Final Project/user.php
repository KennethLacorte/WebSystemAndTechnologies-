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
    <link rel="stylesheet" type="text/css" href="sweet-alert.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>



    
    <title>Angels Burger</title>
</head>

<body>
    <header>
    <div class="navbar">
            <div class="logo"><a href="#">Angel's Burger</a></div>
            <ul class="links">
                <li><a href="#" onclick="loadPage('home-content')">HOME</a></li>
                <li><a href="#" onclick="loadPage('addorder-content')">ADD ORDER</a></li>
                <li><a href="#" onclick="loadPage('order-content')">ORDERS</a></li>

                <li class="dropdown">
                    <a data-toggle="dropdown" href="#." class="dropdown-toggle">MENU</a>
                    <ul class="dropdown-menu"> 
                        <li class="menu-items"><a href="#" data-content-id="hamburgers-content"
                                style="color: black;">HAMBURGERS</a></li>
                        <li class="menu-items"><a href="#" data-content-id="hotdogs-content"
                                style="color: black;">HOTDOG SANDWICHES</a></li>
                        <li class="menu-items"><a href="#" data-content-id="hamsandwiches-content"
                                style="color: black;">HAM SANDWICHES</a></li>
                        <li class="menu-items"><a href="#" data-content-id="baconsandwiches-content"
                                style="color: black;">BACON SANDWICHES</a></li>
                        <li class="menu-items"><a href="#" data-content-id="drinks-content"
                                style="color: black;">DRINKS</a></li>
                    </ul>
                </li>
            </ul>




            <div class="search-bar">
                <input type="text" placeholder="Search...">
                <button type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </header>

    <section class="content-section" id="home-content">
        <!-- Initial content when the page loads -->
        <h1>WELCOME!</h1>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit...</p>
    </section>


    <!-- ADD ORDER content-page -->
    <section class="content-section" id="addorder-content">
        <h1>ADD ORDER</h1>

        <!-- Fetch all categories -->
        <?php
        $category_query = "SELECT category_id, category_name FROM tbl_category";
        $category_result = $conn->query($category_query);
        ?>

        <!-- Form to add items to the order -->
        <form id="add-order-form" action="process_add_order.php" method="post">
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search...">
            </div>

            <?php
            // Loop through categories
            while ($category_row = $category_result->fetch_assoc()) {
                $category_id = $category_row['category_id'];
                $category_name = $category_row['category_name'];

                // Fetch products for the current category
                $product_query = "SELECT item_name, item_img, item_price FROM tbl_items WHERE category_id = $category_id";
                $product_result = $conn->query($product_query);
                ?>

                <table class="content-table">
                    <thead>
                        <tr>
                            <!-- Set the table title dynamically -->
                            <th colspan="4" class="table-title">
                                <?php echo $category_name; ?>
                            </th>
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
                        while ($row = $product_result->fetch_assoc()) {
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

                <?php
            }
            ?>
        </form>

    </section>




    <section class="content-section" id="order-content">
        <!-- Content for the "ORDER HISTORY" page -->
        <h1>ORDER PAGE</h1>
        <p>This is the content for the ORDER page...</p>

        <form id="confirm-order-form">
        <label for="customer-name">Customer Name:</label>
        <input type="text" id="customer-name" name="customer-name" required>
        <br>
        <label for="customer-email">Customer Email:</label>
        <input type="email" id="customer-email" name="customer-email" required>
        <br>
        <button type="button" id="Submit" class="confirm-order-btn">Confirm Order</button>
    </form>
</section>







    <script>
        function loadPage(pageId) {
            // Get the content sections
            var contentSections = document.getElementsByClassName('content-section');

            // Hide all content sections
            for (var i = 0; i < contentSections.length; i++) {
                contentSections[i].style.display = 'none';
            }

            // Show the selected content section
            var selectedSection = document.getElementById(pageId);
            if (selectedSection) {
                selectedSection.style.display = 'block';
            }
        }
    </script>



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




        <script>
            document.addEventListener('DOMContentLoaded', function () {
                function loadPage(contentId) {
                    // Get the content sections
                    var contentSections = document.getElementsByClassName('content-section');

                    // Hide all content sections
                    for (var i = 0; i < contentSections.length; i++) {
                        contentSections[i].style.display = 'none';
                    }

                    // Show the selected content section
                    var selectedSection = document.getElementById(contentId);
                    if (selectedSection) {
                        selectedSection.style.display = 'block';
                    }
                }

                // Add click event listeners to your menu items
                var menuItems = document.querySelectorAll('.menu-items a');
                menuItems.forEach(function (menuItem) {
                    menuItem.addEventListener('click', function (event) {
                        event.preventDefault();
                        var contentId = this.getAttribute('data-content-id');
                        loadPage(contentId);
                    });
                });
            });
        </script>
    </main>






</body>

</html>