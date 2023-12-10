<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
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
        <a href="#dashboard-content" class="list-group-item list-group-item-action bg-transparent second-text active" onclick="navigateTo('dashboard')">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
        </a>
        <a href="#add-products-content" class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="navigateTo('add-products')">
            <i class="fas fa-project-diagram me-2"></i>Add/Update/Delete Products
        </a>
        <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="navigateTo('order-history')">
            <i class="fas fa-chart-line me-2"></i>View Order History
        </a>
        <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="navigateTo('view-account')">
            <i class="fas fa-paperclip me-2"></i>View Account
        </a>
        <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="navigateTo('products')">
            <i class="fas fa-gift me-2"></i>Products
        </a>
        <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold" onclick="navigateTo('logout')">
            <i class="fas fa-power-off me-2"></i>Logout
        </a>
    </div>
</div>

        <div class="content-container" id="page-content-wrapper" id="dashboard-content" >
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
            include '../db/connection.php';
            include '../db/count.php';

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


<div class="content-container" id="page-content-wrapper" id="add-products-content" style="display: none;">
        <!-- Add/Update/Delete Products content goes here -->
        <h1>Add/Update/Delete Products Content</h1>
        
    </div>












        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
       <script defer src="../JS/sidebar-admin.js" ></script>
       <script defer src="../JS/navigate-admin.js" ></script>


</body>

</html>