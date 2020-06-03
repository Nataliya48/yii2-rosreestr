<?php

namespace frontend\controllers;

use frontend\services\RosreestrService;
use Yii;
use yii\rest\Controller;

class RestController extends Controller
{
    /**
     * @return array
     */
    public function actionIndex()
    {
        $rosreestrService = new RosreestrService();
        $json = Yii::$app->request->getRawBody();
        $items = json_decode($json, true);
        if (!isset($items['cadastral_numbers'])) {
            return [];
        }
        $rosreestrs = $rosreestrService->getByCadastralNumber($items['cadastral_numbers']);
        return $rosreestrs;
    }
}
