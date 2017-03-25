<html>
	<head>
	<script type="text/javascript" src="../view/angular/angular.js"></script>
	<script>


	var propositions = [];
	var propositionsConverted = [];

	function replaceConn(proposition) {
		if (proposition.indexOf("^") != -1) {
			proposition = proposition.replace("^", "∧");
		}
		if (proposition.indexOf(">") != -1) {
			proposition = proposition.replace(">", "→");
		}
		if (proposition.indexOf("=") != -1) {
			proposition = proposition.replace("=", "↔");
		}
		if (proposition.indexOf("|") != -1) {
			proposition = proposition.replace("|", "⊻");
		}
		return proposition;
	}
	
	function replaceAll() {
		for (var i = 0; i < propositions.length; i++) {
			propositionsConverted[i] = replaceConn(propositions[i]);
		}
	}
	</script>
	</head>
	
	<body>
		<table class="table table-hover">
		 	<?php
		 	echo '<thead>';
		 	echo '<tr>';
		 	for ($column = 0; $column < count($columns[0]); $column++) {
				echo '<script> propositions['.json_encode($column).'] = '. json_encode($columns[0][$column]->getPropositionValue()).'</script>';
		 	}
		 	echo '<script>replaceAll();</script>';

		 	 echo('<script>
		 			for (var i = 0; i < propositionsConverted.length; i++) {
			 			document.write("<th>"+ propositionsConverted[i] +"</th>");
		 			}
		 		</script>');
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
		 	echo '</tbody>';
		 	?>
		</table>
	</body>

</html>
