<?php
class MenuItem
{
    protected $itemId;
    protected $itemName;
    protected $itemImg;
    protected $itemPrice;
    protected $categoryId;
    protected $availability;

    public function __construct($itemId, $itemName, $itemImg, $itemPrice, $categoryId, $availability)
    {
        $this->itemId = $itemId;
        $this->itemName = $itemName;
        $this->itemImg = $itemImg;
        $this->itemPrice = $itemPrice;
        $this->categoryId = $categoryId;
        $this->availability = $availability;
    }

    // Additional methods common to all items
    public function getItemId()
    {
        return $this->itemId;
    }

    public function getItemName()
    {
        return $this->itemName;
    }

    public function getItemImg()
    {
        return $this->itemImg;
    }

    public function getItemPrice()
    {
        return $this->itemPrice;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function getAvailability()
    {
        return $this->availability;
    }
}

class Burger extends MenuItem
{
    protected $burgerType;

    public function __construct($itemId, $itemName, $itemImg, $itemPrice, $categoryId, $availability, $burgerType)
    {
        parent::__construct($itemId, $itemName, $itemImg, $itemPrice, $categoryId, $availability);
        $this->burgerType = $burgerType;
    }

    // Additional methods specific to burgers
    public function getBurgerType()
    {
        return $this->burgerType;
    }
}

class Drink extends MenuItem
{
    protected $drinkType;

    public function __construct($itemId, $itemName, $itemImg, $itemPrice, $categoryId, $availability, $drinkType)
    {
        parent::__construct($itemId, $itemName, $itemImg, $itemPrice, $categoryId, $availability);
        $this->drinkType = $drinkType;
    }

    // Additional methods specific to drinks
    public function getDrinkType()
    {
        return $this->drinkType;
    }
}

// Example usage
$cheeseburger = new Burger(101, "Cheeseburger", "BLOB - 4.9 KiB", 50.00, 1, "Available", "Cheese Burger");
$bottledWater = new Drink(102, "Bottled Water", "BLOB - ... KiB", 1.99, 2, "Available", "Bottled Water");

echo $cheeseburger->getItemName(); // Output: Cheeseburger
echo $bottledWater->getItemName(); // Output: Bottled Water
echo $cheeseburger->getBurgerType(); // Output: Cheese Burger
echo $bottledWater->getDrinkType(); // Output: Bottled Water
?>
