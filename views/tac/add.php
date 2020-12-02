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
<hr>

<?php $form = ActiveForm::begin() ?>
<?= $form->field($model, 'tac', [
	'inputOptions' => [
		'type' => 'text',
		'autofocus' => 'autofocus',
		// 'required' => 'required',
		'style'=>'width:120px',
		// 'value' => 87654321,
	]
	])->textInput()->label("TAC:")
?>


<?= $form->field($model, 'model_xinit', [
	'inputOptions' => [
		'type' => 'text',
		'style'=>'width:120px',
	]
	])->textInput()->label("Название модели:")
?>



<hr>
<?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>
