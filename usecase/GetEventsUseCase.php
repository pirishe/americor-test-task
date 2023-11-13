<?php

namespace app\usecase;

use app\domain;

final class GetEventsUseCase
{
    private $eventsProvider;

    public function __construct(domain\EventsProviderInterface $eventsProvider)
    {
        $this->eventsProvider = $eventsProvider;
    }

    public function __invoke(GetEventsRequest $request): domain\EventsResult
    {
        return $this->eventsProvider->getEvents($request->getPage());
    }
}
