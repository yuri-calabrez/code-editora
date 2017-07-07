<?php

namespace CodePub\Listeners;

use CodeEduStore\Events\OrderPostProcessEvent;

class BookRankingUpdate
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderPostProcessEvent  $event
     * @return void
     */
    public function handle(OrderPostProcessEvent $event)
    {
        $model = $event->getOrder();
        $model->orderable->searchable();
    }
}
