<?php
	$this->title = "Поиск по модели телефона";

	$counter = count($result);
	echo "<p>Найдено: " . $counter . " ";
	echo "<span style='float: right;'><button id='copy' class='btn btn-success'>Копировать все TAC'и</button></span></p>";
	echo "<br>";

	echo "<pre>";
	foreach ($result as $item=>$data) {
		$tac   = $data['tac'];
		$model = $data['model_xinit'];
		$info  = $data['info_omsk'];

		echo "<h4>" . $tac . " * " . $model . "</h4>";
		echo "<h5>" . $info . "</h5>";
		echo "<br><br>";
	}
	echo "</pre>";

?>

<div id="imeis" style="display: none;"><?php foreach ($result as $item=>$data) {
		echo $data['tac'] . "\n";
	}
	?>
</div>

<script>
	(function(){

	document.getElementById('copy').addEventListener('click', function(){
		let area = document.createElement('textarea'); /* Создали */
		area.value = document.getElementById('imeis').innerHTML.trim(); /* Вставили текст */
		document.body.appendChild(area).select(); /* Добавили на страницу и выделили */
		document.execCommand('copy'); /* Скопировали */
		area.remove(); /* Удалили */
		
		/* Какая-то декорация, чтобы дать понять, что копирование сработало */
		// alert("Все TAC'и успешно скопированы!");
		this.innerHTML = '<span class="bi bi-check2-square" style="pointer-events: none;">&nbsp;&nbsp;Скопировано</i>';
		setTimeout(function(){    
			document.getElementById('copy').innerHTML = 'Копировать все TAC\'и';
		},2000);
	});

	})();
</script>


