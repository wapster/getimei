<?php
use yii\helpers\Url;
?>



<?php 
	$false_imeis = $result['false_imeis'];
	$num_of_false_imeis = count($false_imeis);
	if ( $num_of_false_imeis > 0) : 
?>

<div class="alert alert-danger" role="alert">
	<p>Кол-во ошибочных IMEI: &nbsp;<?php echo $num_of_false_imeis; ?></p>
	<?php endif; ?>
	
	<ul>
		<?php foreach ($false_imeis as $false_imei): ?>
			<li><?php echo $false_imei; ?></li>
		<?php endforeach; ?>
	</ul>
		
</div>

<?php
debug($result);
?>


