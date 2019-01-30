<?php

use app\models\Clock;
use app\widgets\confirm\Confirm;
use app\widgets\fontawesome\FA;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $session Clock */
/* @var $model \app\models\ClockForm */

$this->title = Yii::t('app', 'Editing Session');

$minutes = [0, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55];
?>
<div class="form-group">
    <h1><?= Yii::t('app', 'Editing Session') ?></h1>
</div>

<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <a href="<?= Url::previous() ?>" class="btn btn-outline-primary btn-block"><?= FA::icon('backward') ?> <?= Yii::t('app', 'Go Back') ?></a>
        </div>
        <div class="form-group">
            <a href="<?= Url::to(['clock/delete', 'id' => $session->id]) ?>"
               class="btn btn-outline-danger btn-block"
                <?= Confirm::ask(Yii::t('app', 'Are you sure you want to delete this session?')) ?>>
                <?= FA::icon('times') ?> <?= Yii::t('app', 'Delete') ?>
            </a>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <?= Yii::t('app', 'Session') ?> <?= Yii::$app->formatter->asDatetime($session->clock_in) ?>
            <?= FA::icon('long-arrow-alt-right') ?>
            <?php if ($session->clock_out !== null): ?>
                <?= Yii::$app->formatter->asTime($session->clock_out) ?>
                <span class="badge badge-light float-right"><?= Yii::$app->formatter->asDuration($session->clock_out - $session->clock_in) ?></span>
                <?php else: ?>
                <?= Yii::t('app', 'not ended') ?>
            <?php endif; ?>
        </div>
        <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
            <?= $form->field($model, 'year') ?>
            <?= $form->field($model, 'month')->dropDownList(Clock::months(), ['class' => 'form-control custom-select']) ?>
            <?= $form->field($model, 'day')->dropDownList(
                array_combine(range(1, 31), range(1, 31)),
                ['class' => 'form-control custom-select']
            ) ?>

            <div class="row form-group field-clockform-starthour field-clockform-startminute required <?= $model->hasErrors('startHour') || $model->hasErrors('startMinute') ? 'validating' : '' ?>">
                <?= Html::activeLabel($model, 'startHour', ['class' => 'col-sm-2']) ?>
                <div class="col-sm-3">
                    <?= Html::activeDropDownList(
                        $model,
                        'startHour',
                        array_combine(range(0, 23), range(0, 23)),
                        [
                            'class' => 'form-control custom-select ' . ($model->hasErrors('startHour') ? 'is-invalid' : ''),
                            'id' => 'clockform-starthour',
                        ]
                    ) ?>
                    <?= Html::error($model, 'startHour') ?>
                </div>
                <div class="col-sm-3">
                    <?= Html::activeDropDownList(
                        $model,
                        'startMinute',
                        array_combine($minutes, $minutes),
                        [
                            'class' => 'form-control custom-select ' . ($model->hasErrors('startMinute') ? 'is-invalid' : ''),
                            'id' => 'clockform-startminute',
                        ]
                    ) ?>
                    <?= Html::error($model, 'startMinute') ?>
                </div>
            </div>

            <div class="row form-group field-clockform-endhour field-clockform-endminute <?= $model->hasErrors('endHour') || $model->hasErrors('endMinute') ? 'validating' : '' ?>">
                <?= Html::activeLabel($model, 'endHour', ['class' => 'col-sm-2']) ?>
                <div class="col-sm-3">
                    <?= Html::activeDropDownList(
                        $model,
                        'endHour',
                        ['' => ''] + array_combine(range(0, 23), range(0, 23)),
                        [
                            'class' => 'form-control custom-select ' . ($model->hasErrors('endHour') ? 'is-invalid' : ''),
                            'id' => 'clockform-endhour',
                        ]
                    ) ?>
                    <?= Html::error($model, 'endHour') ?>
                </div>
                <div class="col-sm-3">
                    <?= Html::activeDropDownList(
                        $model,
                        'endMinute',
                        ['' => ''] + array_combine($minutes, $minutes),
                        [
                            'class' => 'form-control custom-select ' . ($model->hasErrors('endMinute') ? 'is-invalid' : ''),
                            'id' => 'clockform-endminute',
                        ]
                    ) ?>
                    <?= Html::error($model, 'endMinute') ?>
                </div>
            </div>

            <?= $form->field($model, 'note')->textarea() ?>

            <div class="form-group text-right">
                <?= Html::submitButton(
                    FA::icon('check-circle') . ' ' . Yii::t('app', 'Save'),
                    [
                        'class' => 'btn btn-primary btn-lg',
                        'name' => 'save-button',
                    ]
                ) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
