<?php

use Proposition\Proposition;
use Enum\TypePropositionEnum;
use Proposition\CompleteProposition;
use Table\TruthTable;

require_once '../vendor/autoload.php';


$proposition = new Proposition("(~a^b>p)>a=~p", TypePropositionEnum::COMPOUND());
$motherPro = new CompleteProposition($proposition);
$truthTable = new TruthTable($motherPro);
$columns = $truthTable->getStructure();



?>
<html>
	<head>
	</head>
	
	<body>
		<table border="1">
			
			
		 	<?php 
		 	echo '<thead>';
		 	echo '<tr>';
		 	for ($column = 0; $column < count($columns[0]); $column++) {
				echo '<th>'. $columns[0][$column]->getPropositionValue() .'</th>';
		 		
		 		
		 	}
		 	echo '</tr>';
		 	echo '</thead>';
		 	
		 	echo '<tbody>';
		 	
		 	for ($row = 1; $row < $truthTable->getNLines(); $row++) {
		 		echo '<tr>';
		 		for ($column = 0; $column < count($columns[0]); $column++) {
		 			echo '<th>'. $columns[$row][$column] . '</th>';
		 		}
		 		echo '</tr>';
		 	}
		 	
		 	echo '</tbody>'
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		 	/* for ($column = 0; $column < count($columns[0]); $column++) {
		 		echo '<td>'. $columns[0][$column]->getPropositionValue() .'</td>';
		 	}
		 	
		 	echo '<br><br>bool value = (a)<br>';
		 	echo $columns[1][0]. "<br>";
		 	echo $columns[2][0]. "<br>";
		 	echo $columns[3][0]. "<br>";
		 	echo $columns[4][0]. "<br>";
		 	echo $columns[5][0]. "<br>";
		 	echo $columns[6][0]. "<br>";
		 	echo $columns[7][0]. "<br>";
		 	echo $columns[8][0]. "<br>";
		 	echo '<hr>';
		 	
		 	echo 'bool value = (b)<br>';
		 	echo $columns[1][1] . "<br>";
		 	echo $columns[2][1]. "<br>";
		 	echo $columns[3][1]. "<br>";
		 	echo $columns[4][1]. "<br>";
		 	echo $columns[5][1]. "<br>";
		 	echo $columns[6][1]. "<br>";
		 	echo $columns[7][1]. "<br>";
		 	echo $columns[8][1]. "<br>";
		 	
		 	echo '<hr>';
		 	echo 'bool value = (p)<br>';
		 	echo $columns[1][2] . "<br>";
		 	echo $columns[2][2]. "<br>";
		 	echo $columns[3][2]. "<br>";
		 	echo $columns[4][2]. "<br>";
		 	echo $columns[5][2]. "<br>";
		 	echo $columns[6][2]. "<br>";
		 	echo $columns[7][2]. "<br>";
		 	echo $columns[8][2]. "<br>";
		 	
		 	
		 	echo '<hr>';
		 	echo 'bool value = (~a)<br>';
		 	echo $columns[1][3] . "<br>";
		 	echo $columns[2][3]. "<br>";
		 	echo $columns[3][3]. "<br>";
		 	echo $columns[4][3]. "<br>";
		 	echo $columns[5][3]. "<br>";
		 	echo $columns[6][3]. "<br>";
		 	echo $columns[7][3]. "<br>";
		 	echo $columns[8][3]. "<br>";
		 	
		 	echo '<hr>';
		 	echo 'bool value = (~p)<br>';
		 	echo $columns[1][4] . "<br>";
		 	echo $columns[2][4]. "<br>";
		 	echo $columns[3][4]. "<br>";
		 	echo $columns[4][4]. "<br>";
		 	echo $columns[5][4]. "<br>";
		 	echo $columns[6][4]. "<br>";
		 	echo $columns[7][4]. "<br>";
		 	echo $columns[8][4]. "<br>";
		 	
		 	echo '<hr>';
		 	echo 'bool value = (~a^b)<br>';
		 	echo $columns[1][5] . "<br>";
		 	echo $columns[2][5]. "<br>";
		 	echo $columns[3][5]. "<br>";
		 	echo $columns[4][5]. "<br>";
		 	echo $columns[5][5]. "<br>";
		 	echo $columns[6][5]. "<br>";
		 	echo $columns[7][5]. "<br>";
		 	echo $columns[8][5]. "<br>";*/
		 	
		 	
		 	
		 	?>
			
			
		
			
				
			
		</table>
	</body>

</html>
