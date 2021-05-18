<?php

use frontend\models\Product;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'warehouse_id',
            'provider_id',
            [
                'attribute' => 'Reserved by User',
                'value' => function($model) {
                    /* @var Product $model */
                    $vartest = $model->getReservedUserList();

                    $result = '';
                    foreach ($vartest as $fruit => $n) {
                        if ($n > 1) {
                            $result .= $fruit . '(' . $n . '), ';
                        } else {
                            $result .= $fruit;
                        }
                    }

                    return $result;
                }
            ],
        ],
    ]) ?>


</div>
