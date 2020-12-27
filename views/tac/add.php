<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Добавить IMEI';


if (Yii::$app->session->hasFlash('success'))
{
	Yii::$app->session->getFlash('success');
	$this->title = Yii::$app->session->getFlash('success');
}

if (Yii::$app->session->hasFlash('error'))
{
	Yii::$app->session->getFlash('error'); 
	exit;
}
?>

<h1>Добавить IMEI</h1>
<div style='width:50%'>
<hr>
<?php
	$form = ActiveForm::begin([
		'options' => ['autocomplete' => 'off']
		]);

		
	echo $form->field($model, 'tac');
	echo $form->field($model, 'model_xinit'); 
	echo $form->field($model, 'info_omsk');
	echo $form->field($model, 'sim');
	echo $form->field($model, 'standart');
?>
<hr>
</div>

<?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>
