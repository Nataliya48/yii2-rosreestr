<?php

namespace console\controllers;

use frontend\services\RosreestrService;
use yii\console\Controller;
use yii\console\widgets\Table;
use yii\helpers\Console;

class RosreestrController extends Controller
{
    /**
     * @param string $cadastralNumbers
     */
    public function actionIndex($cadastralNumbers)
    {
        $rosreestrService = new RosreestrService();
        $cadastralNumbers = $rosreestrService->stringToArray($cadastralNumbers);
        $rosreestrs = $rosreestrService->getByCadastralNumber($cadastralNumbers);
        if (empty($rosreestrs)) {
            $this->stdout("Данные не найдены\n", Console::FG_RED, Console::BOLD);
            return;
        }
        $rows = [];
        foreach ($rosreestrs as $rosreestr) {
            $rows[] = [$rosreestr->cadastralNumber, $rosreestr->address, $rosreestr->price, $rosreestr->area];
        }
        $table = new Table();
        echo $table
            ->setHeaders(['Кадастровый номер', 'Адрес', 'Стоимость', 'Площадь'])
            ->setRows($rows)
            ->run();
    }
}
