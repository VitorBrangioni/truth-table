<?php

use Proposition\Proposition;
use Enum\TypePropositionEnum;
use Proposition\CompleteProposition;
use Table\TruthTable;

require_once '../vendor/autoload.php';


$proposition = new Proposition("~(~a^b>p)>c=~p", TypePropositionEnum::COMPOUND());
$motherPro = new CompleteProposition($proposition);
$truthTable = new TruthTable($motherPro);
$columns = $truthTable->getStructure();

echo $truthTable->defineAlternationBooleanValue(1);

?>
<html>
	<head>
	</head>
	
	<body>
		<table border="1">
		<thead>
			
		 	<?php 
		 	 for ($column = 0; $row < count($columns[0]); $$column++) {
		 		echo '<td>'. $columns[0][$column]->getPropositionValue() .'</td>';
		 	}
		 	echo $columns[1][0] . "<br>";
		 	echo $columns[2][0]. "<br>";
		 	echo $columns[3][0]. "<br>";
		 	echo $columns[4][0]. "<br>";
		 	echo $columns[5][0]. "<br>";
		 	echo $columns[6][0]. "<br>";
		 	echo $columns[7][0]. "<br>";
		 	echo $columns[8][0]. "<br>";
		 	echo '<hr>';
		 	
		 	echo $columns[1][1] . "<br>";
		 	echo $columns[2][1]. "<br>";
		 	echo $columns[3][1]. "<br>";
		 	echo $columns[4][1]. "<br>";
		 	echo $columns[5][1]. "<br>";
		 	echo $columns[6][1]. "<br>";
		 	echo $columns[7][1]. "<br>";
		 	echo $columns[8][1]. "<br>";
		 		?>
			</thead>
			
			
			<tbody>
			
			</tbody>
		</table>
	</body>

</html>
