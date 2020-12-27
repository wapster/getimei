<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'GetIMEI';

?>

<h1>Поиск</h1>
<hr>
<div style='width:20%'>
<?php 
	$form = ActiveForm::begin(['options' => ['autocomplete' => 'off']]);
	echo $form->field( $model, 'tac');
?>
</div>
<hr>
<?= Html::submitButton('Поиск', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>