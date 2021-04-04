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

	echo $form->field($model, 'sim')->dropDownList([
		'1' => '1',
		'2' => '2',
		'3' => '3'
	],
	[
		'prompt' => 'укажите кол-во...',
	]
	
	);

	// echo $form->field($model, 'standart');

	echo $form->field($model, 'standart')->dropDownList([
		'2G' => '2G',
		'3G' => '3G',
		'4G' => '4G',
		'5G' => '5G'
		], 
		['prompt'=>'выберите максимально поддерживаемый стандарт']
	);

?>
<hr>
</div>

<?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>
