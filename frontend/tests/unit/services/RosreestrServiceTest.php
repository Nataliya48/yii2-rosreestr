<?php

namespace frontend\tests\unit\services;

use frontend\models\Rosreestr;
use frontend\services\RosreestrService;
use PHPUnit\Framework\TestCase;

class RosreestrServiceTest extends TestCase
{
    public function testArrayToRosreestr()
    {
        $rosreestrService = new RosreestrService();
        $items = [
            [
                'number' => '123456',
                'data' => [
                    'attrs' => [
                        'address' => 'Address test',
                        'cad_cost' => '789123',
                        'area_value' => '111',
                    ],
                ],
            ],
            [
                'number' => '112233',
                'data' => [
                    'attrs' => [
                        'address' => 'Address test 2',
                        'cad_cost' => '8888',
                        'area_value' => '123',
                    ],
                ],
            ],
        ];
        $expected = [];
        $rosreestr = new Rosreestr();
        $rosreestr->cadastralNumber = '123456';
        $rosreestr->address = 'Address test';
        $rosreestr->price = '789123';
        $rosreestr->area = '111';
        $expected[] = $rosreestr;

        $rosreestr = new Rosreestr();
        $rosreestr->cadastralNumber = '112233';
        $rosreestr->address = 'Address test 2';
        $rosreestr->price = '8888';
        $rosreestr->area = '123';
        $expected[] = $rosreestr;

        $rosreestrs = $rosreestrService->arrayToRosreestr($items);
        $this->assertSame($expected, $rosreestrs);
    }
}
