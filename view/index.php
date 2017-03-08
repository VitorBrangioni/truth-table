<html ng-app="tabelaVerdade">

<head>
	<meta charset="UTF-8">
	<title>Truth Table</title>
	
	
	<link rel="stylesheet" href="css/bootstrap-3/css/bootstrap.min.css">
	<script type="text/javascript" src="angular/angular.js"></script>

	<script type="text/javascript">
		angular.module("tabelaVerdade", []);
		angular.module("tabelaVerdade").controller('truthTableController', function ($scope){

			$scope.expressions = [
				{char: "l", phrase: "há um leão no supermercado"},
				{char: "p", phrase: "pedro esta mentindo"}
			]

			$scope.insertExpression = function (expression) {
				$scope.expressions.push(angular.copy(expression));
				delete $scope.expression;

			}
		});


	</script>
	
	<style type="text/css">
    .container-full {
      margin: 0 auto;
	  width: 100%;

          }

    .grid-sentenca {
    	width: 4.16%
    }

	</style>
</head>

<body ng-controller="truthTableController" class="container container-full">
	<div class="row container container-full">

		<div class="btn-group-vertical">
			<input ng-model="expression.char" class="form-control" type="text" name="char" placeholder="char" maxlength="1">
			<input ng-model="expression.phrase" class="form-control" type="text" name="phrase" placeholder="phrase">
			<button ng-click="insertExpression(expression)" ng-disabled="!expression.phrase || !expression.char" type="button" class="btn btn-primary"> insert expression </button>
			

			<button  ng-repeat="teste in expressions" type="button" class="btn btn-link">
				<strong>{{teste.char}}:</strong> {{teste.phrase}}
			</button>


		</div>
		<div class="container pull-right">
			<div class="row">

				<div class="btn-group-justified">
					<a href="#" class="btn btn-primary">e (∧)</a> <a href="#"
						class="btn btn-primary">ou (v)</a> <a href="#"
						class="btn btn-primary">ou..ou (⊻)</a> <a href="#"
						class="btn btn-primary">implicação (→)</a> <a href="#"
						class="btn btn-primary">negação (~)</a> <a href="#"
						class="btn btn-primary">equivalência (↔)</a>
						<a href="#"
						class="btn btn-primary">(</a>
						<a href="#"
						class="btn btn-primary">)</a>
				</div>
			</div>
			<div class="panel panel-primary row">
				<div class="panel-body form-group">

					<div class="row">

						<!-- <span class="col-md-1 grid-sentenca">
							<h2>p</h2>
						</span>
						<span class="col-md-1 grid-sentenca">
							<h2>^</h2>
						</span>
						<span class="col-md-1 grid-sentenca">
							<h2>~</h2>
						</span>
						<span class="col-md-1 grid-sentenca">
							<h2>q </h2>
						</span> -->


					

					
						<div class="col-md-12">
							<!-- <input type="text" name="" class="form-control" maxlength="1"
								disabled> -->
							<!-- <select class="form-control" ng-model="expression.charAndPhrase" ng-options="expression.char for expression in expressions">
								<option value="">Select a char</option>
							</select> -->
							<input class="form-control" type="text" name="tste" value="a^b->c" disabled>
						</div> 
					</div>
				</div>
				{{expression}}
			</div>
			<input type="submit" name="submit" value="gerar tabela verdade"
				class="btn btn-primary">
		</div>
	</div>
</body>

</html>