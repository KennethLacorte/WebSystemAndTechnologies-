<?php
class count {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getTotalProducts() {
        $queryProducts = "SELECT COUNT(*) as totalProducts FROM tbl_items";
        $resultProducts = $this->conn->query($queryProducts);
        $rowProducts = $resultProducts->fetch_assoc();
        return $rowProducts['totalProducts'];
    }

    public function getTotalSales() {
        $querySales = "SELECT COUNT(*) as totalSales FROM tbl_orders";
        $resultSales = $this->conn->query($querySales);
        $rowSales = $resultSales->fetch_assoc();
        return $rowSales['totalSales'];
    }
}
?>
