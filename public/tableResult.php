<html>
	<head>
	</head>
	
	<body>
		<table class="table table-hover">
		 	<?php 
		 	echo '<thead>';
		 	echo '<tr>';
		 	for ($column = 0; $column < count($columns[0]); $column++) {
				echo '<th>'. $columns[0][$column]->getPropositionValue() .'</th>';
		 		
		 		
		 	}
		 	echo '</tr>';
		 	echo '</thead>';
		 	
		 	echo '<tbody>';
		 	
		 	for ($row = 1; $row <= $truthTable->getNLines(); $row++) {
		 		echo '<tr>';
		 		for ($column = 0; $column < count($columns[0]); $column++) {
		 			echo '<th>'. $columns[$row][$column] . '</th>';
		 		}
		 		echo '</tr>';
		 	}
		 	
		 	echo '</tbody>'

		 	
		 	?>
		</table>
	</body>

</html>
