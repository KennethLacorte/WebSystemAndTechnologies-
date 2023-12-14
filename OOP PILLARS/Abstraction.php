<?php

// Abstract class defining the common properties and methods for all menu items
abstract class MenuItem
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

    // Abstract method to get the type of the menu item
    abstract public function getMenuItemType();

    // Abstract method to calculate the total price for the menu item
    abstract public function calculateTotalPrice($quantity);

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

// Concrete class implementing MenuItem for burgers
class Burger extends MenuItem
{
    protected $burgerType;

    public function __construct($itemId, $itemName, $itemImg, $itemPrice, $categoryId, $availability, $burgerType)
    {
        parent::__construct($itemId, $itemName, $itemImg, $itemPrice, $categoryId, $availability);
        $this->burgerType = $burgerType;
    }

    // Implementation of abstract method
    public function getMenuItemType()
    {
        return "Burger";
    }

    // Implementation of abstract method
    public function calculateTotalPrice($quantity)
    {
        return $this->itemPrice * $quantity;
    }

    // Additional method specific to burgers
    public function getBurgerType()
    {
        return $this->burgerType;
    }
}

// Concrete class implementing MenuItem for drinks
class Drink extends MenuItem
{
    protected $drinkType;

    public function __construct($itemId, $itemName, $itemImg, $itemPrice, $categoryId, $availability, $drinkType)
    {
        parent::__construct($itemId, $itemName, $itemImg, $itemPrice, $categoryId, $availability);
        $this->drinkType = $drinkType;
    }

    // Implementation of abstract method
    public function getMenuItemType()
    {
        return "Drink";
    }

    // Implementation of abstract method
    public function calculateTotalPrice($quantity)
    {
        return $this->itemPrice * $quantity;
    }

    // Additional method specific to drinks
    public function getDrinkType()
    {
        return $this->drinkType;
    }
}

// Example usage
$cheeseburger = new Burger(101, "Cheeseburger", "BLOB - 4.9 KiB", 50.00, 1, "Available", "Cheese Burger");
$bottledWater = new Drink(102, "Bottled Water", "BLOB - ... KiB", 1.99, 2, "Available", "Bottled Water");

echo $cheeseburger->getMenuItemType(); // Output: Burger
echo $bottledWater->getMenuItemType(); // Output: Drink

echo $cheeseburger->calculateTotalPrice(2); // Output: 100.00
echo $bottledWater->calculateTotalPrice(3); // Output: 5.97
?>
