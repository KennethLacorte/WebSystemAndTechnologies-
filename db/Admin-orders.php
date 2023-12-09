<?php
include '../db/connect.php';

class Orders {
    public $conn;

    // Declare constants for table column names
    const ORDER_ID = 'o.order_id';
    const CUSTOMER_NAME = 'c.customer_name';
    const ORDER_DATE = 'o.order_date';
    const ORDER_NUMBER = 'o.order_number';
    const TOTAL_QUANTITY = 'SUM(oi.quantity) as total_quantity';
    const TOTAL_AMOUNT = 'SUM(oi.quantity * oi.price) as total_amount';

    public function __construct() {
        $database = new Connect();
        $this->conn = $database->conn;
    }

    public function getRecentOrders() {
        $query = "
            SELECT
                " . self::ORDER_ID . ",
                " . self::CUSTOMER_NAME . ",
                " . self::ORDER_DATE . ",
                " . self::ORDER_NUMBER . ",
                " . self::TOTAL_QUANTITY . ",
                " . self::TOTAL_AMOUNT . "
            FROM
                tbl_orders o
                JOIN tbl_customers c ON o.customer_id = c.customer_id
                JOIN tbl_order_items oi ON o.order_id = oi.order_id
            GROUP BY
                o.order_id
            ORDER BY
                o.order_date DESC
            LIMIT 10
        ";

        $result = $this->conn->query($query);

        if ($result !== false && $result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
}
?>
