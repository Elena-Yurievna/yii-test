<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'roles')->checkboxList($model->getRolesDropdown()) ?>

    <!--    reset password inputs-->

    reset password field:
    <div class="lb-user-module-profile-password">
        <?= $form->field($model, 'password')->passwordInput([
            'maxlength' => true,
            'placeholder' => $model->getAttributeLabel('password'),
            'class' => 'form-control password'
        ]) ?>

        <a href="javascript:void(0)" class="change_password lnk"><?= Yii::t('user', 'Изменить пароль')?></a>

    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
