<?php

namespace app\presentation\controller;

use app\usecase\GetEventsRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use app\presentation\view\EventsResultSpreadsheetView;
use app\usecase\GetEventsUseCase;

final class ExportController
{
    private $getEventsUseCase;
    private $eventsResultSpreadsheetView;

    public function __construct(
        GetEventsUseCase $getEventsUseCase,
        EventsResultSpreadsheetView $eventsResultSpreadsheetView
    ) {
        $this->getEventsUseCase = $getEventsUseCase;
        $this->eventsResultSpreadsheetView = $eventsResultSpreadsheetView;
    }

    public function __invoke(ServerRequestInterface $psrRequest): ResponseInterface
    {
        $request = GetEventsRequest::makeFromArray($psrRequest->getQueryParams());
        $eventsResult = ($this->getEventsUseCase)($request);

        return ($this->eventsResultSpreadsheetView)($eventsResult);
    }
}
