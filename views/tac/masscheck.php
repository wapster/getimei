<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Найти несколько IMEI';

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

<h1>Найти несколько IMEI</h1>

<div style='width:33%' class='mass_check'>
<hr>

<?php
	$form = ActiveForm::begin(['options' => ['autocomplete' => 'off']]);
	echo $form->field( $model, 'imeis')->textarea(['rows' => 15]);
	
?>
<hr>

<?= Html::submitButton('Поиск', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>

</div>
