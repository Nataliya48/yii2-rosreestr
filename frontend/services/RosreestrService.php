<?php

namespace frontend\services;

use frontend\models\Rosreestr;
use yii\httpclient\Client;

class RosreestrService
{
    /**
     * @param array $cadastralNumbers
     * @return Rosreestr array
     */
    public function getByCadastralNumber(array $cadastralNumbers): array
    {
        $rosreestrs = Rosreestr::find()
            ->where(['cadastralNumber' => $cadastralNumbers])
            ->all();
        $findedCadastralNumbers = [];

        foreach ($rosreestrs as $rosreestr) {
            $findedCadastralNumbers[] = $rosreestr->cadastralNumber;
        }

        $notFindedCadastralNumbers = array_diff($cadastralNumbers, $findedCadastralNumbers);

        if (empty($notFindedCadastralNumbers)) {
            return $rosreestrs;
        }
        $newRosreestrs = $this->getFromRosreestr($notFindedCadastralNumbers);
        foreach ($newRosreestrs as $rosreestr) {
            $rosreestr->save();
        }
        return array_merge($rosreestrs, $newRosreestrs);
    }

    /**
     * @param string $cadastralNumbers
     * @return array
     */
    public function stringToArray(string $cadastralNumbers): array
    {
        $cadastralNumbers = str_replace(' ', '', $cadastralNumbers);
        return explode(',', $cadastralNumbers);
    }

    /**
     * @param array $cadastralNumbers
     * @return Rosreestr array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    private function getFromRosreestr(array $cadastralNumbers): array
    {
        $client = new Client(['baseUrl' => 'http://pkk.bigland.ru/api/test/plots']);
        $response = $client->createRequest()
            ->setFormat(Client::FORMAT_JSON)
            ->setData([
                'collection' => [
                    'plots' => $cadastralNumbers,
                ],
            ])
            ->send();
        $items = json_decode($response->content, true);
        return $this->arrayToRosreestr($items);
    }

    /**
     * @param array $items
     * @return Rosreestr array
     */
    public function arrayToRosreestr(array $items): array
    {
        foreach ($items as $item) {
            if (is_array($item)) {
                $rosreestr = new Rosreestr();
                $rosreestr->cadastralNumber = $item['number'];
                $rosreestr->address = $item['data']['attrs']['address'];
                $rosreestr->price = $item['data']['attrs']['cad_cost'];
                $rosreestr->area = $item['data']['attrs']['area_value'];
                $rosreestrs[] = $rosreestr;
            }
        }
        return $rosreestrs;
    }
}
