<?php

	$con=mysqli_connect("localhost","root","","hack4med");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	mysqli_set_charset($con, "utf8");
		
	switch ($_REQUEST['Type'])
	{
		case 'btn0':
			$query = mysqli_query($con,"SELECT anno2010 AS 'population', comune, lat, lng
FROM comuni, aziendecomuni
WHERE comuni.istat = aziendecomuni.istat
ORDER BY - anno2010
LIMIT 0 , 100");
		break;
		
		case 'btn1':
			$query = mysqli_query($con,"SELECT numero AS 'population', comune, lat, lng
FROM comuni, aziendebiologiche
WHERE comuni.istat = aziendebiologiche.istat
ORDER BY - numero
LIMIT 0 , 100");
		break;
		
		case 'btn2':
			$query = mysqli_query($con,"SELECT anno2010 AS 'population', comune, lat, lng
FROM comuni, aziendeallevcomuni
WHERE comuni.istat = aziendeallevcomuni.istat
ORDER BY - anno2010
LIMIT 0 , 100");
		break;
		
		case 'btn3':
			$query = mysqli_query($con,"SELECT sau AS 'population', comune, lat, lng
FROM comuni, supagricolatipocolt
WHERE comuni.istat = supagricolatipocolt.istat
ORDER BY - sau
LIMIT 0 ,100");
		break;
		
		case 'btn4':
			$query = mysqli_query($con,"SELECT vite AS 'population', comune, lat, lng
FROM comuni, supagricolatipocolt
WHERE comuni.istat = supagricolatipocolt.istat
ORDER BY - vite
LIMIT 0 , 100");
		break;
		
		case 'btn5':
			$query = mysqli_query($con,"SELECT sau AS 'population', comune, lat, lng
FROM comuni, supagricolatipocolt
WHERE comuni.istat = supagricolatipocolt.istat
ORDER BY - sau
LIMIT 0 , 100");
		break;
		
		case 'btn6':
			$query = mysqli_query($con,"SELECT coltivazionilegnose AS 'population', comune, lat, lng
FROM comuni, supagricolatipocolt
WHERE comuni.istat = supagricolatipocolt.istat
ORDER BY - coltivazionilegnose
LIMIT 0 , 100");
		break;
		
		case 'btn7':
			$query = mysqli_query($con,"SELECT ortifamiliari AS 'population', comune, lat, lng
FROM comuni, supagricolatipocolt
WHERE comuni.istat = supagricolatipocolt.istat
ORDER BY - ortifamiliari
LIMIT 0 , 100");
		break;
		
		case 'btn8':
			$query = mysqli_query($con,"SELECT pratipascoli AS 'population', comune, lat, lng
FROM comuni, supagricolatipocolt
WHERE comuni.istat = supagricolatipocolt.istat
ORDER BY - pratipascoli
LIMIT 0 , 100");
		break;
		
		case 'btn9':
			$query = mysqli_query($con,"SELECT boschiaziende AS 'population', comune, lat, lng
FROM comuni, supagricolatipocolt
WHERE comuni.istat = supagricolatipocolt.istat
ORDER BY - boschiaziende
LIMIT 0 , 100");
		break;	
		
		default:
			switch ($_REQUEST['NewType'])
			{
				case 'btn0':
					$query = mysqli_query($con,"SELECT anno2010 AS 'population', comune, lat, lng
		FROM comuni, aziendecomuni
		WHERE comuni.istat = aziendecomuni.istat AND comuni.comune='".$_REQUEST['District']."'");
				break;
				
				case 'btn1':
					$query = mysqli_query($con,"SELECT numero AS 'population', comune, lat, lng
		FROM comuni, aziendebiologiche
		WHERE comuni.istat = aziendebiologiche.istat AND comuni.comune='".$_REQUEST['District']."'");
				break;
				
				case 'btn2':
					$query = mysqli_query($con,"SELECT anno2010 AS 'population', comune, lat, lng
		FROM comuni, aziendeallevcomuni
		WHERE comuni.istat = aziendeallevcomuni.istat AND comuni.comune='".$_REQUEST['District']."'");
				break;
				
				case 'btn3':
					$query = mysqli_query($con,"SELECT sau AS 'population', comune, lat, lng
		FROM comuni, supagricolatipocolt
		WHERE comuni.istat = supagricolatipocolt.istat AND comuni.comune='".$_REQUEST['District']."'");
				break;
				
				case 'btn4':
					$query = mysqli_query($con,"SELECT vite AS 'population', comune, lat, lng
		FROM comuni, supagricolatipocolt
		WHERE comuni.istat = supagricolatipocolt.istat AND comuni.comune='".$_REQUEST['District']."'");
				break;
				
				case 'btn5':
					$query = mysqli_query($con,"SELECT sau AS 'population', comune, lat, lng
		FROM comuni, supagricolatipocolt
		WHERE comuni.istat = supagricolatipocolt.istat AND comuni.comune='".$_REQUEST['District']."'");
				break;
				
				case 'btn6':
					$query = mysqli_query($con,"SELECT coltivazionilegnose AS 'population', comune, lat, lng
		FROM comuni, supagricolatipocolt
		WHERE comuni.istat = supagricolatipocolt.istat AND comuni.comune='".$_REQUEST['District']."'");
				break;
				
				case 'btn7':
					$query = mysqli_query($con,"SELECT ortifamiliari AS 'population', comune, lat, lng
		FROM comuni, supagricolatipocolt
		WHERE comuni.istat = supagricolatipocolt.istat AND comuni.comune='".$_REQUEST['District']."'");
				break;
				
				case 'btn8':
					$query = mysqli_query($con,"SELECT pratipascoli AS 'population', comune, lat, lng
		FROM comuni, supagricolatipocolt
		WHERE comuni.istat = supagricolatipocolt.istat AND comuni.comune='".$_REQUEST['District']."'");
				break;
				
				case 'btn9':
					$query = mysqli_query($con,"SELECT boschiaziende AS 'population', comune, lat, lng
		FROM comuni, supagricolatipocolt
		WHERE comuni.istat = supagricolatipocolt.istat AND comuni.comune='".$_REQUEST['District']."'");
				break;	
			}
		break;
	}
	
		$cont=0;
		
		$buffer = [];
		
		while($row = mysqli_fetch_array($query))
		{
			$buffer[] = $row;
			$cont++;
		}		
		mysqli_close($con);
		echo json_encode($buffer);
	?>