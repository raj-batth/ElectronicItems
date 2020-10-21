<?php
class ItemFactory
{
    /**
     *
     * @param string $type
     * @param float $price
     * @param bool $wired
     * @param array $extras
     *
     * @return ElectronicItem $item
     */
    public static function create(string $type, float $price, bool $wired = false, array $extras = []): ElectronicItem
    {
        if ($type === "controller") {
            $item = !empty($extras) ? new Controller($extras) : new Controller;
        } elseif ($type === "console") {
            $item = !empty($extras) ? new Console($extras) : new Console;
        } elseif ($type === "television") {
            $item = !empty($extras) ? new Television($extras) : new Television;
        } elseif ($type === "microwave") {
            $item = !empty($extras) ? new Microwave($extras) : new Microwave;
        }

        $item->setType($type);
        $item->setPrice($price);
        $item->setWired($wired);
        return $item;
    }
}
