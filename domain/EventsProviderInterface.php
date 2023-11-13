<?php

namespace app\domain;

interface EventsProviderInterface
{
    public function getEvents(int $page): EventsResult;
}
