<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Warehouse */
/* @var $products array */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="warehouse-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <!-- select with products -->
    <?php echo $form->field($model, 'products_id')->dropDownList($model->getProductsId(), ['multiple'=>true]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
