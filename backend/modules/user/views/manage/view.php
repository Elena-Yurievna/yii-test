<?php

use backend\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Update password'), ['password-change', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'username',
            'email:email',
            'status',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'roles',
                'value' => function($user) {
                    /* @var $user User */
                    return implode(',', $user->getRoles());
                }
            ],
            [
                'attribute' => 'ID of reserved products',
                'value' => function($model) {
                    /** @var User $model */
                    $vartest = $model->getAllProducts();

                    $result = '';
                    foreach ($vartest as $fruit => $n) {
                        if ($n > 1) {
                            $result .= $fruit . '(' . $n . '), ';
                        } else {
                            $result .= $fruit.', ';
                        }
                    }

                    return $result;
                }
            ],
        ],
    ]) ?>



</div>
