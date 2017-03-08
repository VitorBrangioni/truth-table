<html ng-app="tabelaVerdade">

<head>
	<meta charset="UTF-8">
	<title>Truth Table</title>
	
	
	<link rel="stylesheet" href="css/bootstrap-3/css/bootstrap.min.css">
	<script type="text/javascript" src="angular/angular.js"></script>

	<script type="text/javascript">
		angular.module("tabelaVerdade", []);
		angular.module("tabelaVerdade").controller('truthTableController', function ($scope){
			$scope.fullExpression = "";
			$scope.expressions = [
				{char: "i", phrase: "há um leão no supermercado"},
				{char: "p", phrase: "pedro esta mentindo"}
			]

			$scope.insertExpression = function (expression) {
				$scope.expressions.push(angular.copy(expression));
				delete $scope.expression;
			}

			$scope.getLastChar = function (string) {
				var posUltimaLetra = string.length -1;
				return string.charAt(posUltimaLetra);
			}


			$scope.lastCharIsLetter = function (string) {
				var lastChar = $scope.getLastChar(string);
				var isChar = false;

				$scope.expressions.forEach(function(entry) {
    				console.log(entry);
					if (lastChar === entry.char) {
						isChar = true;
					}
				});
				return isChar;
			}
			$scope.insertBtnValue = function (btnValue) {
				switch (btnValue) {
					case "e":
					var isLetter = $scope.lastCharIsLetter($scope.fullExpression);
					var lastChar = $scope.getLastChar($scope.fullExpression);
					
					console.log($scope.lastCharIsLetter($scope.fullExpression));
						if(isLetter === true) {
							$scope.fullExpression += "∧";
						} else {
							alert("nao e possivel inserir");
						}
						
					break;
					case "ou":
						$scope.fullExpression += "v";
					break;
					case "ouou":
						$scope.fullExpression += "⊻";
					break;
					case "imp":
						$scope.fullExpression += "→";
					break;
					case "neg":
						$scope.fullExpression += "~";
					break;
					case "equi":
						$scope.fullExpression += "↔";
					break;
					
					case "(":
						$scope.fullExpression += "(";
					break;
					case ")":
						$scope.fullExpression += ")";
					break;
					default: 
						$scope.fullExpression += btnValue;
					
				}
				//console.log(btnValue);
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
			

			<div ng-repeat="teste in expressions" >
				<button ng-click="insertBtnValue(teste.char)" type="button" class="btn btn-link">
					<strong> {{teste.char}}:</strong> {{teste.phrase}}
				</button>
			</div>


		</div>
		<div class="container pull-right">
			<div class="row">

				<div class="btn-group-justified">
					<a ng-click="insertBtnValue('e')" href="#" class="btn btn-primary">e (∧)</a>
					<a ng-click="insertBtnValue('ou')" href="#"	class="btn btn-primary">ou (v)</a>
					<a href="#" ng-click="insertBtnValue('ouou')" class="btn btn-primary">ou..ou (⊻)</a>
					<a href="#" ng-click="insertBtnValue('imp')" class="btn btn-primary">implicação (→)</a>
					<a href="#" ng-click="insertBtnValue('neg')" class="btn btn-primary">negação (~)</a>
					<a href="#"	ng-click="insertBtnValue('equi')" class="btn btn-primary">equivalência (↔)</a>
						<a href="#" ng-click="insertBtnValue('(')" class="btn btn-primary">(</a>
						<a href="#" ng-click="insertBtnValue(')')" class="btn btn-primary">)</a>
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
							<input class="form-control" type="text" name="tste" value="{{fullExpression}}" disabled>
							
						</div> 
					</div>
				</div>
				{{expression}}
			</div>
			<input ng-click="ultimoCaracter()" type="submit" name="submit" value="gerar tabela verdade"
				class="btn btn-primary">
		</div>
	</div>
</body>

</html>