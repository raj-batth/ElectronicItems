<?php

class ElectronicItems
{
    /**
    * @var array
    */
    public $items = array();

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Returns the items depending on the sorting type requested  *
     * @param string $type
     * @return array
     */
    public function getSortedItems($type = 'ASC') : array
    {
        $sorted = array();
        // ? Need to add an extra count variable, since ksort items only once if they have same price.
        $count = 1;
        foreach ($this->items as $item) {
            // $price = $item->getPrice();
            $sorted[($item->getPrice() * 100) + $count] = $item;
            $count++;
        }
        if ($type === 'ASC') {
            ksort($sorted, SORT_NUMERIC);
        } elseif ($type === 'DESC') {
            krsort($sorted, SORT_NUMERIC);
        }
        return $sorted;
    }

    /**
     *
     * @param string $type
     * @return array
     */
    public function getItemsByType($type)
    {
        if (in_array($type, ElectronicItem::$types)) {
            $callback = function ($item) use ($type) {
                return $item->getType($type) == $type;
            };

            $items = array_filter($this->items, $callback);
            return $items;
        }
        return false;
    }

}
