<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Warehouse */

$this->title = 'Update Warehouse: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Warehouses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="warehouse-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <!-- select with products -->
    <?php echo $form->field($model, 'name')->textInput() ?>

    <!-- возможно в before action можно сохранить количество-->
    <?php echo $form->field($model, 'products_quantity')->hiddenInput(['value'=> $model->getProductsQuantity()])->label(false);?>

    <?php echo '<pre>';?>
    <?php print_r($model->getAllProducts());?>
    <?php echo '</pre>';?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
