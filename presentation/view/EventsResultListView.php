<?php

namespace app\presentation\view;

use app\domain;
use app\widgets\Export\Export;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Yii;
use yii\base\ViewContextInterface;
use yii\helpers\Url;

final class EventsResultListView
{
    public function __invoke(domain\EventsResult $eventsResult): ResponseInterface
    {
        $events = $eventsResult->getEvents();

        $view = Yii::$app->getView();

        $htmlContent = $view->render('index', [
            'linkExport' => $this->getLinkExport(),
            'dataProvider' => $events,
        ], $this->buildContextForViewPath());

        return new Response(
            200,
            [],
            $view->renderFile(Yii::$app->basePath . '/views/layouts/main.php', ['content' => $htmlContent])
        );
    }

    private function getLinkExport(): string
    {
        $params = [
            0 => 'export',
            'exportType' => Export::FORMAT_CSV,
        ];

        return Url::to($params);
    }

    private function buildContextForViewPath(): ViewContextInterface
    {
        return new class() implements ViewContextInterface
        {
            public function getViewPath(): string
            {
                return Yii::$app->basePath . '/views/site';
            }
        };
    }
}
