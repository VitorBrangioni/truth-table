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
				{SimpleProposition: "i", phrase: "há um leão no supermercado"},
				{SimpleProposition: "p", phrase: "pedro esta mentindo"}
			]

			$scope.parentheseEnum = {
				CLOSED : 0,
				OPENED : 1
			}

			$scope.verifyParentheses = function () {
				$scope.fullExpression;

				var expression = $scope.fullExpression;
				var countParentheseOpened = 0;
				var countParentheseClosed = 0;

				for (var i = 0; i < expression.length; i++) {
					var char = expression.charAt(i);

					if (char === "(") {
						countParentheseOpened++;
					} else if (char === ")") {
						countParentheseClosed++;
					}
				}
				return subParentheses = countParentheseOpened - countParentheseClosed;
			}

			$scope.insertParenthese = function (parenthese) {
				var verifiedParentheses = $scope.verifyParentheses();
				if (verifiedParentheses > 0 && parenthese === $scope.parentheseEnum.CLOSED) {
					$scope.fullExpression += ")";
				} else if (verifiedParentheses === 0 && parenthese === $scope.parentheseEnum.OPENED) {
					$scope.fullExpression += "(";
				}
			}

			$scope.insertPhrase = function (expression) {
				$scope.expressions.push(angular.copy(expression));
				delete $scope.expression;
			}

			$scope.getLastChar = function (string) {
				var posUltimaLetra = string.length -1;
				return string.charAt(posUltimaLetra);
			}

			$scope.insertLogicOperations = function (simbol) {
				var isLetter = $scope.lastCharIsLetter($scope.fullExpression);
				var lastChar = $scope.getLastChar($scope.fullExpression);
					
				if(isLetter === true) {
					$scope.fullExpression += simbol;
				}
			}

			$scope.insertProposition = function (letter) {
				var isLetter = $scope.lastCharIsLetter($scope.fullExpression);
				var lastChar = $scope.getLastChar($scope.fullExpression);
					
				if(isLetter === false) {
					$scope.fullExpression += letter;
				}

			}


			$scope.lastCharIsLetter = function (string) {
				var lastChar = $scope.getLastChar(string);
				var isChar = false;

				$scope.expressions.forEach(function (entry) {
    				console.log(entry);
					if (lastChar === entry.SimpleProposition) {
						isChar = true;
					}
				});
				return isChar;
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
			<input ng-model="expression.SimpleProposition" class="form-control" type="text" name="SimpleProposition" placeholder="proposition" maxlength="1">
			<input ng-model="expression.phrase" class="form-control" type="text" name="phrase" placeholder="phrase">
			<button ng-click="insertPhrase(expression)" ng-disabled="!expression.phrase || !expression.SimpleProposition" type="button" class="btn btn-primary"> insert expression </button>
			

			<div ng-repeat="expression in expressions" >
				<button ng-click="insertProposition(expression.SimpleProposition)" type="button" class="btn btn-link">
					<strong> {{expression.SimpleProposition}}:</strong> {{expression.phrase}}
				</button>
			</div>


		</div>
		<div class="container pull-right">
			<div class="row">

				<div class="btn-group-justified">
					<a ng-click="insertLogicOperations('∧')" href="#" class="btn btn-primary">e (∧)</a>
					<a ng-click="insertLogicOperations('v')" href="#"	class="btn btn-primary">ou (v)</a>
					<a href="#" ng-click="insertLogicOperations('⊻')" class="btn btn-primary">ou..ou (⊻)</a>
					<a href="#" ng-click="insertLogicOperations('→')" class="btn btn-primary">implicação (→)</a>		
					<a href="#"	ng-click="insertLogicOperations('↔')" class="btn btn-primary">equivalência (↔)</a>
					<a href="#" ng-click="insertLogicOperations('~')" class="btn btn-primary">negação (~)</a>
					<a href="#" ng-click="insertParenthese(parentheseEnum.OPENED)" class="btn btn-primary">(</a>
					<a href="#" ng-click="insertParenthese(parentheseEnum.CLOSED)" class="btn btn-primary">)</a>
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