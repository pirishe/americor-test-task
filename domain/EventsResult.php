<?php

namespace app\domain;

use yii\data\DataProviderInterface;

final class EventsResult
{
    private $events;

    public function __construct(DataProviderInterface $events)
    {
        $this->events = $events;
    }

    public function getEvents(): DataProviderInterface
    {
        return $this->events;
    }
}