<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<?= $form->field($model, 'cadastralNumbers')
    ->label('Введите кадастровый(е) номер(а)')
    ->hint('Введите кадастровые номера через запятую: 69:27:0000022:1306, 69:27:0000022:1307') ?>
<?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>

<?php if (!empty($rosreestrs) && count($rosreestrs) > 0): ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Кадастровый номер</th>
            <th scope="col">Адрес</th>
            <th scope="col">Стоимость</th>
            <th scope="col">Площадь</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($rosreestrs as $rosreestr): ?>
            <tr>
                <td><?= $rosreestr->cadastralNumber; ?></td>
                <td><?= $rosreestr->address; ?></td>
                <td><?= $rosreestr->price; ?></td>
                <td><?= $rosreestr->area; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
