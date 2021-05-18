<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',
                'warehouse_id',
                'provider_id',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Reserve product',
                    'template' => '{link}',
                    'buttons' => [
                        'link' => function ($url,$model,$key) {
                            $url = "reserve?id=".$model->id;
                            return Html::a('Reserve', $url);
                        },
                    ],
                ],


                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    <?php Pjax::end(); ?>


</div>
