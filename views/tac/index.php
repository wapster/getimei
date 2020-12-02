<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'GetIMEI';

?>

<h1>Поиск</h1>
<hr>

<?php $form = ActiveForm::begin() ?>
<?= $form->field($model, 'tac', [
	'inputOptions' => [
		'type' => 'number',
		'autofocus' => 'autofocus',
		'required' => 'required',
		'style'=>'width:120px',
		'value' => 86463804,
	]
	])->textInput()->label("TAC:")
?>
<hr>
<?= Html::submitButton('Поиск', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>