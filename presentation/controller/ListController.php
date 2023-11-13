<?php

namespace app\presentation\controller;

use app\presentation\view\EventsResultListView;
use app\usecase\GetEventsRequest;
use app\usecase\GetEventsUseCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ListController
{
    private $getEventsUseCase;
    private $eventsResultListView;

    public function __construct(GetEventsUseCase $getEventsUseCase, EventsResultListView $eventsResultListView)
    {
        $this->getEventsUseCase = $getEventsUseCase;
        $this->eventsResultListView = $eventsResultListView;
    }

    public function __invoke(ServerRequestInterface $psrRequest): ResponseInterface
    {
        $request = GetEventsRequest::makeFromArray($psrRequest->getQueryParams());
        $eventsResult = ($this->getEventsUseCase)($request);

        return ($this->eventsResultListView)($eventsResult);
    }
}
