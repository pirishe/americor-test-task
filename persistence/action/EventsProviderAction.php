<?php

namespace app\persistence\action;

use app\domain;
use app\models\search\HistorySearch;

final class EventsProviderAction implements domain\EventsProviderInterface
{
    private $historySearchModel;

    public function __construct(HistorySearch $historySearchModel)
    {
        $this->historySearchModel = $historySearchModel;
    }

    public function getEvents(int $page): domain\EventsResult
    {
        $params = [
            'page' => $page,
        ];

        return new domain\EventsResult(
            $this->historySearchModel->search($params)
        );
    }
}
