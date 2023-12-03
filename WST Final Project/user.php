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
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="add-order.css">
    <link rel="stylesheet" type="text/css" href="order.css">
    <link rel="stylesheet" type="text/css" href="Home.css">
    <link rel="stylesheet" type="text/css" href="order-content.css">
    <script src="sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">



    <style>

    </style>
    <title>Angels Burger</title>
</head>

<body>
    <header>
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><h3>Angels Burger</h3></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-pills mb-3" id="pills-tab" role="tablist"">
        <li class="nav-item ps-3 role="presentation">
          <a  class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" href="#" onclick="loadPage('home-content')" style="color: white;">HOME</a>
        </li>
        <li class="nav-item ps-3">   
          <a  class="nav-link " id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" href="#" onclick="loadPage('addorder-content')" style="color: white;">ADD ORDER</a></li>
        </li>
        <li class="nav-item ps-3">
          <a  class="nav-link " id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" href="#" onclick="loadPage('order-content')" style="color: white;">ORDERS</a>
        </li>
        
        <li class="dropdown ps-3" data-bs-theme="dark">
          <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              MENU
          </button>
          <ul class="dropdown-menu">
            <li class="menu-items"><a href="#" data-content-id="hamburgers-content" >ABOUT US</a></li>
            <li class="menu-items"><a href="#" data-content-id="hamburgers-content" >HAMBURGERS</a></li>
            <li class="menu-items"><a href="#" data-content-id="hotdogs-content" >HOTDOG SANDWICHES</a></li>
            <li class="menu-items"><a href="#" data-content-id="hamsandwiches-content" >HAM SANDWICHES</a></li>
            <li class="menu-items"><a href="#" data-content-id="baconsandwiches-content" >BACON SANDWICHES</a></li>
            <li class="menu-items"><a href="#" data-content-id="drinks-content" >DRINKS</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex "  role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

    </header>

    <section class="content-section" id="home-content">
        <h1><strong>ANGELS BURGER!</strong></h1>


        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
      <img src="angelsbg.jpg" class="d-block" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img src="angelsbg.jpg" class="d-block" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="angelsbg.jpg" class="d-block" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

    </section>


    <script src="crud.js"></script>
    <section class="content-section" id="addorder-content">
        <h1>ADD ORDER</h1>

        <!-- Fetch all categories -->
        <?php
        $category_query = "SELECT category_id, category_name FROM tbl_category";
        $category_result = $conn->query($category_query);
        ?>

        <!-- Form to add items to the order -->
        <form id="add-order-form" action="" method="post">
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
                            <th colspan="4" class="tabl          e-title">
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const addToOrderButtons = document.querySelectorAll('.add-to-order-button');
                const orderItemsContainer = document.getElementById('order-items');
                const customerInfoForm = document.getElementById('confirm-order-form');
                const overallTotalElement = document.getElementById('overall-total');

                // Hide the customer information form initially
                customerInfoForm.style.display = 'none';

                // Variable to store the overall total
                let overallTotal = 0.00;

                addToOrderButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Check if the button is not disabled
                        if (!button.disabled) {
                            const productName = button.dataset.productName;
                            const productPrice = parseFloat(button.dataset.productPrice); // Parse as float

                            // Call a function to add the item to the order form and update the overall total
                            addToOrder(productName, productPrice);

                            // Disable the button to prevent further clicks
                            button.disabled = true;

                            // Show customer information fields and submit button
                            showCustomerInfoForm();
                        }
                    });
                });

                // Function to add items to the order form
                function addToOrder(productName, productPrice) {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td>${productName}</td><td>${productPrice.toFixed(2)}</td><td><input type="number" name="quantity[]" value="1" min="1"></td><td><button class="remove-item-button" >Remove</button></td>`;
                    orderItemsContainer.appendChild(row);

                    // Calculate the total for the current item and update the overall total
                    const quantityInput = row.querySelector('input[name="quantity[]"]');
                    quantityInput.addEventListener('input', function() {
                        updateItemTotal(row, productPrice);
                    });

                    updateItemTotal(row, productPrice);

                    // Add event listener to the newly added remove button
                    const removeButton = row.querySelector('.remove-item-button');
                    removeButton.addEventListener('click', function() {
                        // Remove the item from the order
                        row.remove();

                        // Enable the corresponding "Add to Order" button
                        const correspondingAddButton = Array.from(addToOrderButtons).find(btn => btn.dataset.productName === productName);
                        if (correspondingAddButton) {
                            correspondingAddButton.disabled = false;
                        }

                        // Check if there are no items in the order, then hide the customer information form
                        if (orderItemsContainer.children.length === 0) {
                            customerInfoForm.style.display = 'none';
                        }

                        // Update the overall total after removing an item
                        overallTotal -= parseFloat(row.dataset.itemTotal);
                        overallTotalElement.textContent = overallTotal.toFixed(2);
                    });
                }

                // Function to update the item total and overall total
                function updateItemTotal(row, productPrice) {
                    const quantityInput = row.querySelector('input[name="quantity[]"]');
                    const quantity = parseInt(quantityInput.value, 10);
                    const itemTotal = productPrice * quantity;

                    // Update the data attribute with the item total
                    row.dataset.itemTotal = itemTotal;

                    // Update the total for the current item
                    row.querySelector('td:nth-child(2)').textContent = productPrice.toFixed(2);

                    // Update the overall total
                    overallTotal = Array.from(orderItemsContainer.children).reduce((total, item) => total + parseFloat(item.dataset.itemTotal), 0);
                    overallTotalElement.textContent = overallTotal.toFixed(2);
                }

                // Function to show customer information fields and submit button
                function showCustomerInfoForm() {
                    customerInfoForm.style.display = 'block';
                }
            });
        </script>

        <script src="search.js"></script>
        <script src="add-order.js"></script>

    </section>



    <section class="content-section" id="order-content">
        <h1>ORDER PAGE</h1>
        <p>This is the content for the ORDER page...</p>

        <form id="confirm-order-form" action="" method="post">
            <label for="customer-name">Customer Name:</label>
            <input type="text" id="customer-name" name="customerName" required>
            <label for="order-date">Order Date:</label>
            <input type="date" id="order-date" name="orderDate" required>
            <label for="order-number">Order Number:</label>
            <input type="text" id="order-number" name="orderNumber" readonly>

            <table class="content-table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center" id="order-items">
                    <!-- Add your order items here if needed -->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total: </td>
                        <td id="overall-total" colspan="1">0.00</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <br><br>
            <button type="button" id="submit-btn" onclick="confirmOrder()">Confirm Order</button>
        </form>


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- ... existing code ... -->

        <!-- ... existing code ... -->

        <script>
            class OrderConfirmation {
                constructor() {
                    // Set the current date when an instance is created
                    this.setCurrentDate();
                }

                setCurrentDate() {
                    var currentDate = new Date().toISOString().split('T')[0];
                    this.orderDate = currentDate;
                    document.getElementById('order-date').value = currentDate;
                }

                async confirmOrder() {
                    // Get customer name from the form
                    var customerName = document.getElementById('customer-name').value;

                    // Validate customer name (you may add more validation as needed)
                    if (customerName.trim() === '') {
                        // Display SweetAlert for validation error
                        this.showValidationError('Please enter customer name.');
                        return;
                    }

                    // Generate an auto-generated order number
                    var orderNumber = this.generateOrderNumber();

                    // Display SweetAlert with customer details and order confirmation
                    const result = await Swal.fire({
                        title: 'Order Confirmation',
                        html: `
            <p><strong>Customer Name:</strong> ${customerName}</p>
            <p><strong>Order Date:</strong> ${this.orderDate}</p>
            <p><strong>Order Number:</strong> ${orderNumber}</p>
            <p><strong>Total Price:</strong> $${this.calculateTotalPrice()}</p>
            <p>Order confirmed! Thank you for your purchase.</p>
        `,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });

                    if (result.isConfirmed) {
                        // Reset the form after confirmation
                        document.getElementById('confirm-order-form').reset();

                        // Perform additional actions here, such as making an AJAX request to confirm the order on the server
                        // Example:
                        const response = await fetch('confirm_order.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                customerName,
                                orderDate: this.orderDate,
                                orderNumber,
                                totalPrice: this.calculateTotalPrice(),
                                // Add other data if needed
                            }),
                        });

                        // Handle the response as needed
                        if (response.ok) {
                            const data = await response.json();
                            console.log('Server response:', data);
                            // You can add more handling based on the server response
                        } else {
                            console.error('Error confirming order on the server');
                            // You can display an error message to the user if needed
                        }
                    }
                }
                x

                generateOrderNumber() {
                    return Math.floor(Math.random() * 1000000) + 1;
                }

                calculateTotalPrice() {
                    let total = 0;
                    const orderItems = document.querySelectorAll('#order-items tr');

                    orderItems.forEach((item) => {
                        const price = parseFloat(item.querySelector('td:nth-child(2)').innerText);
                        const quantity = parseInt(item.querySelector('td:nth-child(3) input').value, 10);
                        total += price * quantity;
                    });

                    return total.toFixed(2);
                }


                showValidationError(message) {
                    Swal.fire({
                        title: 'Validation Error',
                        text: message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }

                updateItemTotal(row, productPrice) {
                    const quantityInput = row.querySelector('input[name="quantity[]"]');
                    const quantity = parseInt(quantityInput.value, 10);
                    const itemTotal = productPrice * quantity;

                    // Update the data attribute with the item total
                    row.dataset.itemTotal = itemTotal;

                    // Update the total for the current item
                    row.querySelector('td:nth-child(2)').textContent = itemTotal.toFixed(2);

                    // Update the overall total
                    overallTotal = Array.from(orderItemsContainer.children).reduce((total, item) => total + parseFloat(item.dataset.itemTotal), 0);
                    overallTotalElement.textContent = overallTotal.toFixed(2);
                }

                showCustomerInfoForm() {
                    // Assuming you have a customerInfoForm variable, you can toggle its display
                    const customerInfoForm = document.getElementById('customer-info-form');
                    customerInfoForm.style.display = 'block';
                }
            }

            // Create an instance of the OrderConfirmation class
            const orderConfirmation = new OrderConfirmation();

            // Attach the confirmOrder method to the button click event
            document.getElementById('submit-btn').addEventListener('click', () => orderConfirmation.confirmOrder());
        </script>


    </section>






    <script src="loadPage.js"></script>



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
            document.addEventListener('DOMContentLoaded', function() {
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
                menuItems.forEach(function(menuItem) {
                    menuItem.addEventListener('click', function(event) {
                        event.preventDefault();
                        var contentId = this.getAttribute('data-content-id');
                        loadPage(contentId);
                    });
                });
            });
        </script>
    </main>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>


</body>

</html>