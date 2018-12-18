<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model \app\models\OffForm */

$this->title = 'Company Timeclock | Dodanie wolnego';

?>
<div class="form-group">
    <h1>Dodanie wolnego</h1>
</div>

<div class="row">
    <div class="col-sm-2">
        <div class="form-group">
            <a href="<?= Url::previous() ?>" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-backward"></i> Powrót</a>
        </div>
    </div>
    <div class="col-sm-10">
        <div class="form-group">
            Nowe wolne
        </div>
        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-sm-4\">{input}</div>\n<div class=\"col-sm-6\">{error}</div>",
                'labelOptions' => ['class' => 'col-sm-2 control-label'],
            ],
        ]); ?>

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <p class="form-control-static">Dzień rozpoczęcia</p>
            </div>
        </div>

        <?= $form->field($model, 'startYear') ?>
        <?= $form->field($model, 'startMonth')->dropDownList(\app\models\Off::$months) ?>
        <?= $form->field($model, 'startDay')->dropDownList(array_combine(range(1, 31), range(1, 31))) ?>

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <p class="form-control-static">Dzień zakończenia (pozostaw puste, jeśli wolne będzie trwać tylko jeden dzień)</p>
            </div>
        </div>

        <?= $form->field($model, 'endYear') ?>
        <?= $form->field($model, 'endMonth')->dropDownList(['' => ''] + \app\models\Off::$months) ?>
        <?= $form->field($model, 'endDay')->dropDownList(['' => ''] + array_combine(range(1, 31), range(1, 31))) ?>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?= Html::submitButton('Zapisz', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>