<html ng-module="tableResult">
	<head>
	<script type="text/javascript" src="../view/angular/angular.js"></script>
	<script>

	 angular.module("tableResult", []);
	angular.module("tableResult").controller('convertColumnValue', function ($scope){

		

		$scope.replaceConn = function (proposition) {
			proposition.replace("^", "∧");
			proposition.replace(">", "→"); 
			alert(proposition);
		} 
		
		
	});
	var a = <?php echo json_encode("hahah"); ?>;

	var propositions = [];

	function replaceConn(proposition) {
		proposition.replace("^", "∧");
	}
	
	function replaceAll() {
		for (var i = 0; i < propositions.length; i++) {
			propositions[i] = replaceConn(propositions[i]);
		}
	}

	

	
	</script>
	</head>
	
	<body ng-controller="convertColumnValue">
		<table class="table table-hover">
		 	<?php

		 	
		 	echo '<thead>';
		 	echo '<tr>';
		 	for ($column = 0; $column < count($columns[0]); $column++) {
		 		// echo '<input type="hidden" value="'.$arroz .'">';
				//echo '<th><script> test += '. $columns[0][$column]->getPropositionValue() .';alert(test);</script></th>';
				echo '<th><script> propositions['.json_encode($column).'] = '. json_encode($columns[0][$column]->getPropositionValue()).'</script></th>';
		 	}
		 	
		 	/* echo('<script>
		 			for (var i; i < propositions.length; i++) {
		 			
		 			alert(propositions[i]);
		 			
		 			}
		 			
		 			</script>'); */
		 	
		 	echo '<script>replaceAll(); alert(propositions[0]);</script>';
		 	echo '<script>alert(propositions.length)</script>';
		 	
		 	echo '</tr>';
		 	echo '</thead>';
		 	
		 	echo '<tbody>';
		 	
		 	/* for ($row = 1; $row <= $truthTable->getNLines(); $row++) {
		 		echo '<tr>';
		 		for ($column = 0; $column < count($columns[0]); $column++) {
		 			echo '<th>'. $columns[$row][$column] . '</th>';
		 		}
		 		echo '</tr>';
		 	} */
		 	
		 	echo '</tbody>';
		 	?>
		</table>
	</body>

</html>
