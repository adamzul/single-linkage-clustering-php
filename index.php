<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
  <input type="file" name="fileToUpload" id="fileToUpload">
  <h3>centeroid:</h3>
  <input type="text" name="jumCenteroid" >
  
  <br><br>
  <input type="submit" name="submit" value="submit">
</form>
<?php
if(isset($_POST['submit']))
{
	$file = basename($_FILES["fileToUpload"]["name"]);
	$data = getDataFromFile($file);
	$jumData = count($data);
	$jarakPerData = getJarak($data);
	$centeroids = $data;
	$jumCenteroid = count($centeroids);
	$jumFitur = count($centeroids[0])-1;

	// for ($i=0; $i < $jumCenteroid; $i++) { 
	// 	# code...
	// 	var_dump($centeroids[$i]);
	// 	echo '<br><br>';
	// }
	do{
		$min = 1000000;
		$x = 10;
		$y = 10;
		for ($i=0; $i < $jumData; $i++) { 
				# code...
			for ($j=0; $j < $jumData; $j++) { 
				# code...
				if($data[$i]['cluster'] != $data[$j]['cluster'] && $i != $j)
				{
					if($min > $jarakPerData[$i][$j])
					{
						$min = $jarakPerData[$i][$j];
						$x = $i;
						$y = $j;
					}
				}
			}
		}	
		echo $x.' '.$y.' '.$min.' '.$data[$x]['cluster'].' '.$data[$x]['cluster'].'<br>';

		for ($i=0; $i < $jumData; $i++) { 
			# code...
			if($data[$i]['cluster'] == $data[$y]['cluster'])
			{
				$data[$i]['cluster'] = $data[$x]['cluster'];
			}
		}
		$jum = 0;
		$array = array();
		for ($i=0; $i < $jumData; $i++) { 
			# code...
			$cek = cekValueExistInArray($array,$data[$i]['cluster']);
			// var_dump($cek)  . '<br>';
			if($cek==false)
			{
				array_push($array, $data[$i]['cluster']);
			}
		}
	}while ( count($array) > $_POST['jumCenteroid']) ;
		for ($i=0; $i < count($centeroids); $i++) { 
			# code...
					var_dump($data[$i]);
					echo '<br>';
		}
		// for ($i=0; $i < count($centeroids); $i++) { 
		// 	# code...
					// var_dump($array[$i]);
					// echo '<br>';

		// }
		// echo count($array);

}


?>

<?php

function cekValueExistInArray($array,$value)
{
	$status = false;
	$jumArray = count($array);
	for ($i=0; $i < $jumArray; $i++) { 
		# code...
		if($array[$i] == $value)
		{
			$status = true;
			break;
		}
		// echo $array[$i].' '.$value;
	 // 				echo '<br>';
	}
	return $status;
}

function getDataFromFile($file)
{
	$stringData = file_get_contents($file);

	$pecahPerdata = preg_split("/\r\n|\n|\r/", $stringData);
	$temps = array();$i=0;
	foreach ($pecahPerdata as $data) {
		# code...
		$pecahPerkolom = explode(',', $data);
		$pecahPerkolom['index'] = $i;
		$pecahPerkolom['cluster'] = $i;

		array_push($temps, $pecahPerkolom);
		$i++;
	}
    return $temps;
}



function getJarak($data)
{
	$jumData = count($data);
	$jumFitur = count($data[0])-2;
	$jarakKeseluruhan = array();

	for ($i=0; $i < $jumData; $i++) { 
		# code...
		for ($j=0; $j < $jumData; $j++) { 
			# code...
			$jarak = 0;
			for ($h=0 ;$h < $jumFitur; $h++) { 
				# code...
				$jarak = sqrt(pow($jarak,2)+pow(($data[$i][$h]-$data[$j][$h]),2));

			}
			$jaraks[$j] = $jarak;

		}
		array_push($jarakKeseluruhan, $jaraks); 

	}
	return $jarakKeseluruhan;

}




?>
</body>
</html>