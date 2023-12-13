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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="icon" href="logo.ico" type="image/x-icon">
    <link rel="shortcut icon" href="logo.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <link rel="stylesheet" type="text/css" href="../CSS/add-order.css">
    <link rel="stylesheet" type="text/css" href="../CSS/order.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Home.css">
    <link rel="stylesheet" type="text/css" href="../CSS/order-content.css">
    <link rel="stylesheet" type="text/css" href="../CSS/bestseller.css">
    <link rel="stylesheet" type="text/css" href="../CSS/banner.css">
    <link rel="stylesheet" type="text/css" href="../CSS/map.css">
    <link rel="stylesheet" type="text/css" href="../CSS/contactus.css">
    <link rel="stylesheet" type="text/css" href="../CSS/footer.css">
    <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="path/to/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="path/to/slick/slick-theme.css" />
    <script type="text/javascript" src="path/to/slick/slick.min.js"></script>
    <script type="text/javascript" src="../JS/reset.js"></script>
    <script type="text/javascript" src="../JS/receipt.js"></script>
    <script src="https://cdn.jsdelivr.net/md5/2.9.0/md5.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../CSS/receipt.css" />

    <style>

    </style>
    <title>Michelle's Burger</title>
</head>

<body>
    <div id="container-background">
        <nav class="navbar navbar-expand-md navbar-dark bg-danger fixed-top">
            <!-- Brand -->
            <a class="navbar-brand" href="#" id="logo-color"><i><img src="../icon/logo.png" alt=""></i>Burger</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span><i><img src="../icon/menu.png" alt="" id="menu-color"></i></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#Main-content" onclick="onNavButtonClick('Main-content')" style="color: white;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#bestSeller-content" onclick="onNavButtonClick('bestSeller-content')" style="color: white;">Best Seller</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#addorder-content" onclick="onNavButtonClick('addorder-content')" style="color: white;">Add Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#order-content" onclick="onNavButtonClick('order-content')" style="color: white;">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#vieworder-content" onclick="onNavButtonClick('vieworder-content')" style="color: white;">Order Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about" onclick="onNavButtonClick('about')" style="color: white;">Visit Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contactus" onclick="onNavButtonClick('contactus')" style="color: white;">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.facebook.com/angelsburgerph/" target="_blank"><i class="fab fa-facebook-square" style="color: white;"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.tiktok.com/@angelsburgerph/" target="_blank"><i class="fab fa-tiktok" style="color: white;"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.instagram.com/angelsburgerph/" target="_blank"><i class="fab fa-instagram" style="color: white;"></i></a>
                    </li>
                    <button type="submit" class="btnLogin-popup" onclick="redirectToNextPage()">Login</button>
                    <script>
                        function redirectToNextPage() {
                            // Use window.location.href to navigate to the next page
                            window.location.href = '../ADMIN/login.php'; // Replace 'next_page.php' with the actual URL
                        }
                    </script>
                </ul>
            </div>
        </nav>

        <script src="../JS/buttonclicked.js"></script>
        <section class="main-content content-section" id="Main-content">
            <div class="home-content">
                <h1>BEST DEAL</h1>
                <h2>BURGER</h2>
                <div id="btn1">
                    <a href="#addorder-content" class="card-link" onclick="onNavButtonClick('addorder-content')">
                        <button>Order Now</button>
                    </a>
                </div>
            </div>
        </section>



    </div>


    <section class="BestSeller content-section" id="bestSeller-content">
        <div class="container">
            <div class="best-card">
                <div class="row" style="margin-top: 20px;">
                    <!-- First Column -->
                    <div class="col-md-4 py-3 py-md-0">
                        <a href="#addorder-content" class="card-link" onclick="onNavButtonClick('addorder-content')">
                            <div class="card">
                                <img class="card-image-top" src="../images/CheesyBurger.jpg" alt="">
                                <div class="card-img-overlay">
                                    <h1 class="card-title">Cheesy Burger Sandwich</h1>
                                    <p class="card-text">BUY 1 TAKE 1</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Second Column -->
                    <div class="col-md-4 py-3 py-md-0">
                        <a href="#addorder-content" class="card-link" onclick="onNavButtonClick('addorder-content')">
                            <div class="card">
                                <video class="card-image-top" autoplay loop muted>
                                    <source src="../images/angelsvideo.mp4" type="video/mp4">
                                </video>
                                <div class="card-img-overlay">
                                    <h1 class="card-title">BURGER NG BAYAN</h1>
                                    <!-- Add appropriate content for video -->
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Third Column -->
                    <div class="col-md-4 py-3 py-md-0">
                        <a href="#addorder-content" class="card-link" onclick="onNavButtonClick('addorder-content')">
                            <div class="card">
                                <img class="card-image-top" src="../images/Footlong.jpg" alt="">
                                <div class="card-img-overlay">
                                    <h1 class="card-title">Jumbo Cheese Footlong Sandwich</h1>
                                    <p class="card-text">Wow na Wow!</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container text-center">
            <div class="banner">
                <h1>Angels Burger <span class="change-content"></span></h1>
                <h2>BUY 1 TAKE 1</h2>
                <div id="btn2"><button>Order Now</button></div>
            </div>
        </div>
    </section>
    <script>
        function showAddOrderContent() {
            // Toggle the display property of the addorder-content
            var addOrderContent = document.getElementById("addorder-content");
            addOrderContent.style.display = (addOrderContent.style.display === "none" || addOrderContent.style.display === "") ? "block" : "none";
        }
    </script>




    <section class="ADDORDER content-section" id="addorder-content">

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
                $product_query = "SELECT item_id, item_name, item_img, item_price, availability FROM tbl_items WHERE category_id = $category_id";
                $product_result = $conn->query($product_query);

            ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-dark table-hover">
                        <thead class="table-dark">
                            <tr>

                                <td colspan="6" class="table-title">
                                    <?php echo $category_name; ?>
                                    </th>
                            </tr>
                            <tr>
                                <th class="align-middle">Product ID</th>
                                <th class="align-middle">Product Name</th>
                                <th class="align-middle">Product Image</th>
                                <th class="align-middle">Price</th>
                                <th class="align-middle">Quantity</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                </div>
                <!-- Display product information in the table body -->
                <tbody class="text-center">
                    <?php
                    // Inside the while loop where you display products
                    while ($row = $product_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['item_id']}</td>"; // Add the Product ID column
                        echo "<td>{$row['item_name']}</td>";
                        echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['item_img']) . "' alt='{$row['item_name']}' style='width: 50px; height: 50px;'></td>";
                        echo "<td>{$row['item_price']}</td>";

                        // Check availability using enum values
                        $availability = $row['availability'];
                        if ($availability == 'Available') {
                            echo "<td><input type='number' id='quantity-{$row['item_id']}' value='1' min='1' class='quantity' style='width: 100px; height: 50px; text-align: center;'></td>";
                            echo "<td><button class='action-button add-to-order-button' data-product-id='{$row['item_id']}' data-product-name='{$row['item_name']}' data-product-img='" . base64_encode($row['item_img']) . "' data-product-price='{$row['item_price']}' data-item-id='{$row['item_id']}'>Add to Order</button></td>";
                        } elseif ($availability == 'Not Available') {
                            echo "<td><input type='text' value='Not Available' readonly class='not-available-input' style='width: 100px; height: 50px; text-align: center;'></td>";
                            echo "<td><button class='action-button not-available-button' disabled>Not Available</button></td>";
                        } else {
                            // Handle other availability cases if needed
                            echo "<td colspan='2'>Unknown Availability</td>";
                        }

                        echo "</tr>";
                    }
                    ?>
                </tbody>
                </table>

            <?php
            }
            ?>
        </form>

        <script defer src="../JS/add-order.js"></script>
        <script defer src="../JS/search.js"></script>
    </section>




    <section class="ORDERS content-section" id="order-content">
        <p>This is the content for the ORDER page...</p>
        <h2 class="all-heading" style="color: black;">Order</h2>

        <form id="confirm-order-form" action="" method="post" onsubmit="confirmOrder(); return false;">
            <label for="customer-name">Customer Name:</label>
            <input type="text" id="customer-name" name="customerName" required>
            <label for="order-date">Order Date:</label>
            <input type="date" id="order-date" name="orderDate" required>

            <br>
            <br>
            <table class="table table-striped table-bordered table-dark table-hover">
                <thead class="table-dark">
                    <tr>
                        <th class="product-name-heading">Product Name</th>
                        <th class="price-heading">Price</th>
                        <th class="quantity-heading">Quantity </th>
                        <th class="action-heading">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center" id="order-items">
                <tfoot>
                    <tr>
                        <td colspan="2">Total: </td>
                        <td id="overall-total" colspan="1"> 0.00</td>
                        <td></td>
                    </tr>
                </tfoot>
                </tbody>

            </table>
            <br><br>
            <button type="button" id="submit-btn" onclick="confirmOrder()">Confirm Order</button>
        </form>


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script defer src="../JS/order.js"></script>
    </section>



    <section class="VIEWORDER content-section" id="vieworder-content">
        <div id="order-details" class="card-body">
            <!-- Display order details here -->
        </div>
    </section>



    <section class="ABOUT content-section" id="about">
        <br>
        <br>
        <div class="about-us">
            <div class="row">
                <div class="col-md-6">
                    <div class="card" style="height: 450px; margin-top:80px;">
                        <!-- Replace the existing image with the Google Maps iframe -->
                        <iframe src="https://www.google.com/maps/embed?pb=!3m2!1sen!2sph!4v1702392400831!5m2!1sen!2sph!6m8!1m7!1s-tm3iBfJDv2hld--elAJ6A!2m2!1d13.92966285934027!2d121.1893492700615!3f73.14729409802008!4f3.6113415464581635!5f0.7820865974627469"height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card" style="height: 450px;margin-top:80px;">
                        <img src="../images/burgers.jpg" style="width: 100%; height: 100%;" alt="Store Image">
                    </div>
                </div>
            </div>
        </div>
    </section>




    <section class="Contact-Us content-section" id="contactus">
        <br>
        <br>
        <br>
        <div class="container">
            <h1 class="text-center" style="font-weight: bold; margin-top:50px">System Developers:</h1>
            <div class="border-container">
                <img src="../images/od.jpeg" alt="Your Image" class="content-image">
                <h3>Hi I'm Odlanyer</h3>
                <p>Contact Me here</p>
                <a href="https://www.facebook.com/Imodlanyer" target="_blank"><i class="fab fa-facebook-square icon"></i></a>
                <a href="https://www.instagram.com/imodlanyer/" target="_blank"><i class="fab fa-instagram-square icon"></i></a>
                <a href="mailto:odparker14@gmail.com?subject=Subject%20Here" target="_blank"><i class="fas fa-envelope icon"></i></a>
            </div>
            <div class="border-container">
                <img src="../images/kanuto.jpeg" alt="Your Image" class="content-image">
                <h3>Hi I'm Kenneth</h3>
                <p>Contact Me here</p>
                <a href="https://www.facebook.com/lacortekennet" target="_blank"><i class="fab fa-facebook-square icon"></i></a>
                <a href="https://www.instagram.com/lacortejohnkanuto?subject=Subject%20Here/" target="_blank"><i class="fab fa-instagram-square icon"></i></a>
                <a href="mailto:johnkennethlacorte@gmail.com" target="_blank"><i class="fas fa-envelope icon"></i></a>
            </div>
        </div>
    </section>






    </section>



    <footer id="footer">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-6 text-lg-left text-center">
                    <div class="copyright">
                        &copy; Copyright <strong>Burger</strong>. All Rights Reserved
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0">
                        <a href="#" class="scrollto">Home</a>
                        <a href="#" class="scrollto">Best Seller</a>
                        <a href="#" class="scrollto">Add Order</a>
                        <a href="#" class="scrollto">Order<a>
                                <a href="#" class="scrollto">View Order<a>
                                        <a href="#" class="scrollto">Visit Us</a>
                                        <a href="#" class="scrollto">Contact Us</a>
                    </nav>
                </div>
            </div>
        </div>

    </footer>











    <script defer src="../JS/navbar.js"></script>
    <script defer src="../JS/location.js"></script>
    <script defer src="../JS/contactus.js"></script>
    <script defer src="../JS/login.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>