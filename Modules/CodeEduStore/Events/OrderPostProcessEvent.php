<?php

namespace CodeEduStore\Events;


use CodeEduStore\Models\Order;

class OrderPostProcessEvent
{
    /**
     * @var Order
     */
    private $order;

    /**
     * Create a new event instance.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }


}
