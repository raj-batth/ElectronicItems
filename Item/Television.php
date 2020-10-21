<?php
class Television extends ElectronicItem
{
    /**
    * @var int
    */
    private int $maxExtras;
    
    /**
    * @var array
    */
    public array $extras;

    public function __construct($extras = [])
    {
        $this->extras = $extras;
        $this->maxExtras();
    }

    // ? Do not need to compare extras with max limit since Television has no max limit
    public function maxExtras(): void
    {

    }
}
