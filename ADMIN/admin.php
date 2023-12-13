<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/admin.css">
    <title>Admin</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <i class="fas fa-user-secret me-2"></i>Admin
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="#dashboard-content" class="list-group-item list-group-item-action bg-transparent second-text active" onclick="showContent('dashboard')">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a href="#edit-product-content" class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="showContent('edit-product')">
                    <i class="fas fa-project-diagram me-2"></i>Update/Delete Products
                </a>
                <a href="#add-product-content" class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="showContent('add-product')">
                    <i class="fas fa-chart-line me-2"></i>Add Products
                </a>
                <a href="#view-account-content" class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="showContent('view-account')">
                    <i class="fas fa-paperclip me-2"></i>View Account
                </a>
                <a href="#products-content" class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="showContent('products-list')">
                    <i class="fas fa-gift me-2"></i>Products
                </a>

                <a href="#logout-content" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold" onclick="showContent('logout')">
                    <i class="fas fa-power-off me-2"></i>Logout
                </a>
            </div>
        </div>


        <div id="dashboard-content" class="dashboard container-lg">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashboard</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>Admin
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="#">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <?php
            include '../ADMIN/connection.php';
            include '../ADMIN/count.php';

            $database = new Database();
            $conn = $database->conn;

            $statistics = new count($conn);
            $totalProducts = $statistics->getTotalProducts();
            $totalSales = $statistics->getTotalSales();

            echo "
                    <div class='container-fluid px-4'>
                        <div class='row g-3 my-2'>
                            <div class='col-md-3'>
                                <div class='p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded'>
                                    <div>
                                        <h3 class='fs-2'>$totalProducts</h3>
                                        <p class='fs-5'>Products</p>
                                    </div>
                                    <i class='fas fa-gift fs-1 primary-text border rounded-full secondary-bg p-3'></i>
                                </div>
                            </div>

                            <div class='col-md-3'>
                                <div class='p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded'>
                                    <div>
                                        <h3 class='fs-2'>$totalSales</h3>
                                        <p class='fs-5'>Sales</p>
                                    </div>
                                    <i class='fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3'></i>
                                </div>
                            </div>
                        </div>
                    </div>";
            ?>



            <!-- /#Recent order -->

            <div class="row my-5">
                <h3 class="fs-4 mb-3">Recent Orders</h3>
                <div class="col">
                    <table class="table bg-white rounded shadow-sm table-hover">
                        <thead>
                            <tr>
                                <th scope="col" width="100">Order ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Order ID</th> <!-- Updated column header -->
                                <th scope="col">Quantity</th>
                                <th scope="col">Totals</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Assuming you have a database connection established
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "db_burgers";

                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            function fetchRecentOrders()
                            {
                                global $conn;

                                $sql = "
                        SELECT tbl_customers.customer_name, tbl_customers.order_date, tbl_orders.order_id, tbl_order_items.quantity, tbl_orders.totals
                        FROM tbl_orders
                        JOIN tbl_customers ON tbl_orders.customer_id = tbl_customers.customer_id
                        JOIN tbl_order_items ON tbl_orders.order_id = tbl_order_items.order_id
                        ORDER BY tbl_customers.order_date DESC
                        LIMIT 10;  -- You can adjust the limit as needed
                    ";

                                $result = $conn->query($sql);

                                if (!$result) {
                                    die("Error: " . $conn->error); // Display the error message and exit
                                }

                                if ($result->num_rows > 0) {
                                    // Output data in table rows
                                    while ($row = $result->fetch_assoc()) {
                                        echo "
                                <tr>
                                    <th scope='row'>{$row['order_id']}</th> <!-- Updated line -->
                                    <td>{$row['customer_name']}</td>
                                    <td>{$row['order_date']}</td>
                                    <td>{$row['order_id']}</td> <!-- Updated line -->
                                    <td>{$row['quantity']}</td>
                                    <td>{$row['totals']}</td>
                                </tr>
                            ";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No recent orders found.</td></tr>";
                                }
                            }

                            // Call the function to fetch and display recent orders
                            fetchRecentOrders();

                            // Close the database connection
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="edit-product-content" class="products container-lg" style="display:none">
            <div class="row my-5">
                <h3 class="fs-4 mb-3">Add/Delete</h3>
                <div class="col">
                    <table class="table bg-white rounded shadow-sm table-hover">
                        <thead>
                            <tr>
                                <th scope="col" width="100">Item ID</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Item Image</th>
                                <th scope="col">Item Price</th>
                                <th scope="col">Category ID</th>
                                <th scope="col">Availability</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="itemsTableBody">
                            <?php
                            // Include your database connection file
                            include '../ADMIN/connection-product.php';

                            // Fetch all data from the database
                            $query = "SELECT * FROM tbl_items";
                            $result = mysqli_query($conn, $query);

                            // Display data in the table
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr id='row{$row['item_id']}'>";
                                echo "<td>{$row['item_id']}</td>";
                                echo "<td>{$row['item_name']}</td>";

                                // Check if the key 'item_img' exists before accessing it
                                $itemImage = isset($row['item_img']) ? $row['item_img'] : '';
                                $imageData = base64_encode($itemImage);
                                echo "<td><img src='data:image/jpeg;base64,{$imageData}' alt='Product Image' width='50'></td>";

                                echo "<td>{$row['item_price']}</td>";
                                echo "<td>{$row['category_id']}</td>";
                                echo "<td>{$row['availability']}</td>";
                                echo "<td>";
                                echo "<button class='btn btn-primary' onclick='showUpdateForm({$row['item_id']})'>Update</button>";
                                echo "<button class='btn btn-danger' onclick='deleteItem({$row['item_id']})'>Delete</button>";
                                echo "</td>";
                                echo "</tr>";
                            }

                            // Close the database connection
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <div id="add-product-content" class="products container-lg" style="display: none">
            <div class="container-sm mt-5">
                <div class="container-fluid bg-dark w-50 text-light">
                    <h3 class="fs-10 mb-4">ADD PRODUCTS</h3>
                    <form id="add-product-form" class="row g-3" method="post" enctype="multipart/form-data" action="add-products-admin.php">
                        <div class="mb-3 row">
                            <label for="itemId" class="col-sm-2 col-form-label">Item ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="itemId" name="itemId" placeholder="Item ID">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="itemName" class="col-sm-2 col-form-label">Item Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="itemName" name="itemName" placeholder="Item Name">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="formFile" class="col-sm-2 col-form-label">Item Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="formFile" name="itemImage">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="itemPrice" class="col-sm-2 col-form-label">Item Price</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="itemPrice" name="itemPrice" placeholder="Item Price">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="categoryId" class="col-sm-2 col-form-label">Category Name</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="categoryId" aria-label="Default select example">
                                    <?php
                                    // Include your database connection file
                                    include '../ADMIN/connection-product.php';

                                    // Fetch categories from the database
                                    $categoryQuery = "SELECT * FROM tbl_category";
                                    $categoryResult = mysqli_query($conn, $categoryQuery);

                                    // Check if categories are retrieved successfully
                                    if ($categoryResult) {
                                        // Loop through categories and create options
                                        while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                                            $categoryId = $categoryRow['category_id'];
                                            $categoryName = $categoryRow['category_name'];
                                            echo "<option value='$categoryId'>$categoryName</option>";
                                        }
                                    } else {
                                        echo "<option value='' disabled selected>No categories available</option>";
                                    }

                                    // Close the database connection
                                    mysqli_close($conn);
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="availability" class="col-sm-2 col-form-label">Availability</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="availability" aria-label="Default select example">
                                    <option value="Available">Available</option>
                                    <option value="Not Available">Not Available</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-5 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const form = document.getElementById("add-product-form");

                form.addEventListener("submit", function(event) {
                    event.preventDefault(); // Prevent default form submission

                    // Perform AJAX form submission
                    fetch(form.action, {
                            method: form.method,
                            body: new FormData(form),
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Check the response and show SweetAlert accordingly
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: data.message,
                                }).then((result) => {
                                    // Redirect or perform other actions if needed
                                    window.location.href = 'admin.php';
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: data.message,
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'An unexpected error occurred. Please try again.',
                            });
                        });
                });
            });
        </script>













    </div>
    <script defer src="../JS/update.js"></script>
    <script defer src="../JS/add-update-delete.js"></script>
    <script defer src="../JS/sidebar-toggle.js"></script>
    <script defer src="../JS/sidebarfunction.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>


</body>

</html>