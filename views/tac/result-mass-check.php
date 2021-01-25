<?php
use yii\helpers\Url;
?>



<?php 

$false_imeis = $data['false_imeis'];
$num_of_false_imeis = count($false_imeis);
if ( $num_of_false_imeis > 0) : 

?>

<!-- Ошибочные ТАСи -->
<div class="alert alert-danger" role="alert">
	<h4>Кол-во ошибочных IMEI: &nbsp;<?php echo $num_of_false_imeis; ?></h4>
	
	<ul>
		<?php foreach ($false_imeis as $false_imei): ?>
			<li><?php echo $false_imei; ?></li>
		<?php endforeach; ?>
	</ul>
		
</div>
<?php endif; ?>


<!-- TAC, которых нет в БД -->
<?php if (count($data['not_in_db']) > 0) : ?>
	<div class="alert alert-warning" role="alert">
	<h4>TAC, которых нет в базе данных</h4>
		<ul>
			<?php foreach($data['not_in_db'] as $tac) : ?>
				<li>
					<?php echo $tac; ?>
					<i class="bi bi-globe" style="padding-left: 2%;"></i>
					<a href='https://www.imei.info/?imei=<?php echo getTrueImei($tac);?>' target=_blank>imei.info</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>


<!-- ТАС, которые есть в БД -->
<?php foreach($data['true_result'] as $tac=>$info): ?>
	<div class="alert alert-success" role="alert">
		<span style="font-size: 20px;">
			* <?php echo $tac; ?>
			&nbsp;&nbsp;/&nbsp;&nbsp; 
		</span>
		Найдено: <?php echo count($info); ?>
		<i class="bi bi-globe" style="padding-left: 2%;"></i>
		<a href='https://www.imei.info/?imei=<?php echo getTrueImei($tac);?>' target=_blank>imei.info</a>
		<hr>
		
		<?php foreach($info as $item=>$phone): ?>
			<h4><?php echo $phone['model_xinit']; ?></h4>
		<?php endforeach; ?>
	</div>
<?php endforeach;?>

<?php
// debug($data);
?>


