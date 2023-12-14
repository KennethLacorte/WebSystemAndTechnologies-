<?php

// Interface defining the common methods for all menu items
interface MenuItemInterface
{
    public function getMenuItemType();
    public function calculateTotalPrice($quantity);
}

// Abstract class implementing MenuItemInterface
abstract class MenuItem implements MenuItemInterface
{
    protected $itemId;
    protected $itemName;
    protected $itemImg;
    protected $itemPrice;
    protected $categoryID;
    protected $availability;

    public function __construct($itemId, $itemName, $itemImg, $itemPrice, $categoryID, $availability)
    {
        $this->itemId = $itemId;
        $this->itemName = $itemName;
        $this->itemImg = $itemImg;
        $this->itemPrice = $itemPrice;
        $this->categoryID = $categoryID;
        $this->availability = $availability;
    }

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

    public function getAvailability()
    {
        return $this->availability;
    }

    // Common method from the interface
    public function getMenuItemType()
    {
        return "Generic Menu Item";
    }

    // Abstract method to be implemented by child classes
    abstract public function getCategorySpecificInfo();

    // Common method to calculate total price
    public function calculateTotalPrice($quantity)
    {
        return $this->itemPrice * $quantity;
    }
}

// Concrete class implementing MenuItem for burgers
class Burger extends MenuItem
{
    private $burgerType;

    public function __construct($itemId, $itemName, $itemImg, $itemPrice, $categoryID, $availability, $burgerType)
    {
        parent::__construct($itemId, $itemName, $itemImg, $itemPrice, $categoryID, $availability);
        $this->burgerType = $burgerType;
    }

    // Override the abstract method to provide category-specific information
    public function getCategorySpecificInfo()
    {
        return "Burger Type: " . $this->burgerType;
    }

    // Override the common method to customize the menu item type
    public function getMenuItemType()
    {
        return "Burger";
    }
}

// Concrete class implementing MenuItem for drinks
class Drink extends MenuItem
{
    private $drinkType;

    public function __construct($itemId, $itemName, $itemImg, $itemPrice, $categoryID, $availability, $drinkType)
    {
        parent::__construct($itemId, $itemName, $itemImg, $itemPrice, $categoryID, $availability);
        $this->drinkType = $drinkType;
    }

    // Override the abstract method to provide category-specific information
    public function getCategorySpecificInfo()
    {
        return "Drink Type: " . $this->drinkType;
    }

    // Override the common method to customize the menu item type
    public function getMenuItemType()
    {
        return "Drink";
    }
}

// Function that demonstrates polymorphism
function printMenuItemDetails(MenuItemInterface $menuItem)
{
    echo "Item Type: " . $menuItem->getMenuItemType() . PHP_EOL;
    echo "Item ID: " . $menuItem->getItemId() . PHP_EOL;
    echo "Item Name: " . $menuItem->getItemName() . PHP_EOL;
    echo "Item Price: $" . number_format($menuItem->getItemPrice(), 2) . PHP_EOL;
    echo "Availability: " . $menuItem->getAvailability() . PHP_EOL;
    echo $menuItem->getCategorySpecificInfo() . PHP_EOL;
    echo PHP_EOL;
}

// Example usage
$cheeseburger = new Burger(101, "Cheeseburger", "BLOB - 4.9 KiB", 50.00, 1, "Available", "Cheese Burger");
$bottledWater = new Drink(102, "Bottled Water", "BLOB - ... KiB", 1.99, 2, "Available", "Bottled Water");

// Print details using polymorphism
echo "Cheeseburger Details:" . PHP_EOL;
printMenuItemDetails($cheeseburger);

echo "Bottled Water Details:" . PHP_EOL;
printMenuItemDetails($bottledWater);
?>
