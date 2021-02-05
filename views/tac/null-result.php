<?php
use yii\helpers\Url;

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


<h4>Найдено: 0</h4>

	<i class="bi bi-globe" style="padding-left: 0;"></i>
	<a href='https://www.imei.info/?imei=<?php echo getTrueImei($result[0]);?>' target=_blank>imei.info</a>