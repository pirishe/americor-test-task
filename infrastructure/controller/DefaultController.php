<?php

namespace app\infrastructure\controller;

use app\presentation\controller\ExportController;
use app\presentation\controller\ListController;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ResponseInterface;
use Yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionIndex()
    {
        $psrRequest = ServerRequest::fromGlobals();
        switch($psrRequest->getQueryParams()['r'] ?? null) {
            case 'default/export':
                $controller = $this->getController(ExportController::class);
                break;
            default:
                $controller = $this->getController(ListController::class);
                break;
        }

        /** @var ResponseInterface $psrResponse */
        $psrResponse = $controller($psrRequest);
        return $psrResponse->getBody()->getContents();
    }

    private function getController(string $controllerClassName): callable
    {
        return Yii::$container->get($controllerClassName);
    }
}
