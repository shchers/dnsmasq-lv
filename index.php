<html>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Dnsmasq</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php
	require 'settings.php';

	echo '<table class="table table-striped">';
	echo '<tbody>';
	echo '<thead class="table-dark">';
	echo '<tr>';
	echo '<th scope="col">#</th>';
	echo '<th scope="col">Lease expiry date</th>';
	echo '<th scope="col">Lease seconds left</th>';
	echo '<th scope="col">MAC Address</th>';
	echo '<th scope="col">IP Address</th>';
	echo '<th scope="col">Host name</th>';
	echo '</tr>';
	echo '</thead>';

	$dnsmasq_list = file_get_contents($dnsmasq_file);
	$rows = explode(PHP_EOL, $dnsmasq_list);

	//var_dump($rows);

	foreach($rows as $row => $data) {
		$row_data = explode(' ', $data);

		if (strlen($data) == 0) {
			// Skip empty lines
			continue;
		}

		$date = $row_data[0];
		$mac  = $row_data[1];
		$ip   = $row_data[2];
		$name = $row_data[3];
		$uuid = $row_data[4];

		echo '<tr>';
		echo '<th scope="row">' . ($row + 1) . '</th>';
		echo '<td>' . date("M j G:i:s T Y", $date) . '</td>';
		echo '<td>' . ($date - time()) . '</td>';
		echo '<td>' . $mac . '</td>';
		echo '<td>' . $ip . '</td>';
		echo '<td title="' . $uuid .'">' . $name . '</td>';
		echo '</tr>';
	}

	echo '</tbody>';
	echo '</table>';
?> 

</body>
</html>
