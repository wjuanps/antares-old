angular.module("antares").controller("comparadorCtrl", function ($scope, antaresAPI, graficoAPI) {
	$scope.mostrarGrafico = true;
	
	var dados = null;
	$scope.pesquisar = function (primeiraOpcao, segundaOpcao) {
		antaresAPI.ajaxPost(
			"src/com/wjuan/antares/requests/requestComparador.php",
			{c1: primeiraOpcao, c2: segundaOpcao}
		).then(
			function successCallback (response) {
				console.log(response.data);
				dados = dataSets(response.data.sentimentos);
				var graficoComparador = {
					id: 'chartLinha',
					type: 'bar',
					labels: ["Positivo", "Negativo"],
					label: 'Sentimentos',
					dataSets: dados,
				    options: {
				        scales: {
				            yAxes: [{
				                ticks: {
				                    beginAtZero:true
				                }
				            }]
				        }
				    }
				};

				graficoAPI.getGraficoComparador(graficoComparador);
			},
			function errorCallback (response) {
				console.log(response);
			}
		);
	};

	var colors = function () {
		var color = new Array();
		for (var i = 0; i < 3; i++) {
			color[i] = Math.ceil(Math.random()*255);
		}
		return new Array(
			"rgba(" + color.join(", ") + ", 0.2)",
			"rgba(" + color.join(", ") + ", 1)"
		);
	};

	var dataSets = function (sentimentos) {
		var dataSets = new Array();
		for (var i = 0; i < 2; i++) {
			var color = colors();
			var dataSet = {
				label: sentimentos[i].pesquisa,
				data: [
					sentimentos[i].dados.porcentagemPositivo, sentimentos[i].dados.porcentagemNegativo
				],
				backgroundColor: color[0],
				borderColor: color[1],
				borderWidth: 1
			};
			dataSets.push(dataSet);
		}
		return dataSets;
	};
});