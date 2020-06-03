<?php

namespace frontend\controllers;

use frontend\models\RosreestForm;
use Yii;
use yii\web\Controller;
use frontend\services\RosreestrService;

class RosreestrController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $rosreestrService = new RosreestrService();
        $model = new RosreestForm();
        $model->load(Yii::$app->request->post());
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $cadastralNumbers = $rosreestrService->stringToArray($model->cadastralNumbers);
                $rosreestrs = $rosreestrService->getByCadastralNumber($cadastralNumbers);
                return $this->render('main', ['model' => $model, 'rosreestrs' => $rosreestrs]);
            }
        }
        return $this->render('main', ['model' => $model]);
    }
}
