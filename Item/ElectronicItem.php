<?php
class ElectronicItem
{
    /**
     * @var float
     */
    private float $price;

    /**
     * @var string
     */
    private string $type;

     /**
     * @var bool
     */
    private bool $wired;

    const ELECTRONIC_ITEM_CONSOLE = 'console';
    const ELECTRONIC_ITEM_TELEVISION = 'television';
    const ELECTRONIC_ITEM_MICROWAVE = 'microwave';
    const ELECTRONIC_ITEM_CONTROLLER = 'controller';

    public static $types = array(
        self::ELECTRONIC_ITEM_CONSOLE,
        self::ELECTRONIC_ITEM_TELEVISION,
        self::ELECTRONIC_ITEM_MICROWAVE,
        self::ELECTRONIC_ITEM_CONTROLLER,
    );

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getType() : string
    {
        return $this->type;
    }

    public function getWired() : bool
    {
        return $this->wired;
    }

    public function setPrice($price) : void 
    {
        $this->price = $price;
    }

    public function setType($type) : void
    {
        $this->type = $type;
    }

    public function setWired($wired) : void
    {
        $this->wired = $wired;
    }
    public function getItemPriceWithExtras() : float
    {
        $price = 0;
        foreach ($this->extras as $extra) {
            $price += $extra->getPrice();
        }
        return $price + $this->getPrice();
    }

}
