<?php

class Console extends ElectronicItem
{
    /**
    * @var int
    */
    private int $maxExtras;
    
    /**
    * @var array
    */
    public array $extras;

    public function __construct(array $extras = [])
    {
        $this->maxExtras = 4;
        $this->extras = $extras;
        $this->maxExtras();
    }

    public function maxExtras(): void
    {
        if (count($this->extras) > $this->maxExtras) {
            $class = get_class($this);
            throw new MyException("$class can have only $this->maxExtras extras");
        }
    }

}
