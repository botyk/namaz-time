<?php

require '../namazTime.php';

if (isset($_GET['ajax']) && $_GET['ajax'] == 'load') {
	$lat = !empty($_POST['lat']) ? $_POST['lat'] : '';
	$lon = !empty($_POST['lon']) ? $_POST['lon'] : '';
	
	$nt = new namazTime($lat, $lon);
	$data = $nt->getToday(); // За сегодня
	
	$result = '<table class="table table-bordered">
		<tr>
			<td colspan="2">' . $data['city'] . ' &nbsp;|&nbsp; ' . date('d-m-Y') . '</td>
		</tr>
		<tr><td>Фаджр</td><td>' . $data['fajr'] . '</td></tr>
		<tr><td>Восход</td><td>' . $data['sunrise'] . '</td></tr>
		<tr><td>Зухр</td><td>' . $data['dhuhr'] . '</td></tr>
		<tr><td>Аср</td><td>' . $data['asr'] . '</td></tr>
		<tr><td>Магриб</td><td>' . $data['maghrib'] . '</td></tr>
		<tr><td>Иша</td><td>' . $data['isha'] . '</td></tr
	</table>';
	
	die($result);
}

?><!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Время намаза (muftyat.kz)</title>
	<style>
	* {
		padding: 0;
		margin: 0;
	}
	h1 {
		font-size: 18px;
		margin-bottom: 15px;
	}
	table {
		border-collapse: collapse;
		text-align: center;
	}
	table, td, th {
		border: 1px solid black;
		padding: 6px 10px;
	}
	select, table {
		width: 100%;
	}
	#load {
		margin-top: 15px;
	}
	.wrapper {
		margin: 20px auto;
		width: 220px;
	}
	</style>
</head>
<body>

<div class="wrapper">
	<h1>Время намаза (muftyat.kz)</h1>
	<select id="city">
		<?php foreach (namazTime::getCites() as $v) {
			echo '<option data-lat="' . $v['lat'] . '" data-lon="' . $v['lon'] . '">' . $v['city'] . '</option>';
		} ?>
	</select>
	<div id="load"></div>
</div>
	
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#city').on('change', function () {
	var lat = $(this).find(':selected').data('lat');
	var lon = $(this).find(':selected').data('lon');
	load(lat, lon);
});

load();
function load(lat = '', lon = '') {
	$('#load').html('<img src="img/loading.gif">');
	$.post('?ajax=load', {lat:lat, lon:lon}, function(data) {
		$('#load').html(data);
	});
}
</script>

</body>
</html>