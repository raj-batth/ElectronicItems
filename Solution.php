<?php
include './Exception/MyException.php';
include 'ElectronicItems.php';
include './Item/ElectronicItem.php';
include './Item/Console.php';
include './Item/Television.php';
include './Item/Microwave.php';
include './Item/Controller.php';
include './Factories/ItemFactory.php';
class Solution
{

    private float $WIRED_CONTROLLER_PRICE;
    private float $WIRELESS_CONTROLLER_PRICE;
    private float $CONSOLE_PRICE;
    private float $TELEVISION_ONE_PRICE;
    private float $TELEVISION_TWO_PRICE;
    private float $MICROWAVE_PRICE;

    private Console $console;
    private Television $televisionOne;
    private Television $televisionTwo;
    private Microwave $microwave;
    private array $itemsToPurchase;
    private array $sortedItems;
    private float $totalPrice;

    public function __construct() 
    {
        $this->WIRED_CONTROLLER_PRICE = 50.99;
        $this->WIRELESS_CONTROLLER_PRICE = 70.99;
        $this->CONSOLE_PRICE = 599;
        $this->TELEVISION_ONE_PRICE = 999;
        $this->TELEVISION_TWO_PRICE = 1499;
        $this->MICROWAVE_PRICE = 249;

        $this->itemsToPurchase = [];
        $this->sortedItems = [];
        $this->totalPrice = 0.0;
    }

    private function initialize(): void
    {
        $this->console = ItemFactory::create("console", $this->CONSOLE_PRICE, false, [
            ItemFactory::create("controller", $this->WIRED_CONTROLLER_PRICE, false),
            ItemFactory::create("controller", $this->WIRED_CONTROLLER_PRICE, false),
            ItemFactory::create("controller", $this->WIRELESS_CONTROLLER_PRICE, true),
            ItemFactory::create("controller", $this->WIRELESS_CONTROLLER_PRICE, true),
        ]);

        $this->televisionOne = ItemFactory::create("television", $this->TELEVISION_ONE_PRICE, true, [
            ItemFactory::create("controller", $this->WIRELESS_CONTROLLER_PRICE, true),
            ItemFactory::create("controller", $this->WIRED_CONTROLLER_PRICE, false),
        ]);

        $this->televisionTwo = ItemFactory::create("television", $this->TELEVISION_TWO_PRICE, true, [
            ItemFactory::create("controller", $this->WIRELESS_CONTROLLER_PRICE, true),
        ]);

        $this->microwave = ItemFactory::create("microwave", $this->MICROWAVE_PRICE, true);
    }

    private function mainItemToPurchase(): void
    {
        $this->itemsToPurchase = [$this->console, $this->televisionOne, $this->televisionTwo, $this->microwave];
    }

    private function getExtraItems(): void
    {
        foreach ($this->console->extras as $extraWithConsole) {
            array_push($this->itemsToPurchase, $extraWithConsole);
        }
        foreach ($this->televisionOne->extras as $extraWithTelevisionOne) {
            array_push($this->itemsToPurchase, $extraWithTelevisionOne);
        }
        foreach ($this->televisionTwo->extras as $extraWithTelevisionTwo) {
            array_push($this->itemsToPurchase, $extraWithTelevisionTwo);
        }
    }

    private function sortedItems(): void
    {
        $electronicItems = new ElectronicItems($this->itemsToPurchase);
        $this->sortedItems = $electronicItems->getSortedItems('ASC');
    }

    private function displayResultAndCalTotalPrice(): void
    {
        foreach ((array) $this->sortedItems as $electronicItem) {
            $type = $electronicItem->getType();
            $isWired = $electronicItem->getWired();
            $price = $electronicItem->getPrice();
            $isWiredController = '';
            
            if ($type === 'controller' && $isWired) {
              $isWiredController = '(Wired)';
            } elseif ($type === 'controller' && !$isWired) {
              $isWiredController = '(Wireless)';
            }

            echo "$isWiredController $type ------> $$price</br>";
            $this->totalPrice = $this->totalPrice + $price;
        }
    }

    public function run(): void
    {
        $this->initialize();
        $this->mainItemToPurchase();
        $this->getExtraItems();
        $this->sortedItems();

        echo "Sorted Items:</br>";
        $this->displayResultAndCalTotalPrice();

        echo "<br/>";
        echo "Total Price : ";
        echo "$" . $this->totalPrice . "</br>";
        echo "<br/>";

        echo "Price for a console and its controllers: ";
        echo "$" . $this->console->getItemPriceWithExtras() . "</br>";
    }
}
