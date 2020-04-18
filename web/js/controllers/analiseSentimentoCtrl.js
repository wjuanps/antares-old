angular.module("antares").controller("analiseSentimentoCtrl", function ($scope, antaresAPI, graficoAPI) {
	$scope.sentimento = {sentimento: 'Analisando Sentimento'};
	var url = location.pathname.split("/")[2];
	if (url) {

		$scope.search = url.split('-').join(' ');

		antaresAPI.ajaxGet(
			'src/com/wjuan/antares/requests/requestSentimento.php',
			{texto: url}
		).then(
			function successCallback(response) {
				console.log(response);
				$scope.sentimento = response.data;
				
				if (!$scope.sentimento.vazio) {
					$scope.grafico = {
						id: 'chartBar',
						type: 'bar',
						labels: ["Positivo", "Negativo"],
						label: 'Sentimentos',
						data: [
							response.data.porcentagemPositivo,
							response.data.porcentagemNegativo
						],
						backgroundColor: [
				            'rgba(75, 192, 192, 0.2)',
							'rgba(255, 99, 132, 0.2)'
				        ],
				        borderColor: [
					        'rgba(75, 192, 192, 1)',
							'rgba(255, 99, 132, 1)'
					    ],
					    borderWidth: 1,
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

					graficoAPI.getGenericGrafico($scope.grafico);

					$scope.grafico = {
						id: 'chartPie',
						type: 'doughnut',
						labels: ["Positivo", "Negativo"],
						label: 'Sentimentos',
						data: [
							response.data.porcentagemPositivo, 
							response.data.porcentagemNegativo
						],
						backgroundColor: [
							'rgba(54, 162, 235, 0.2)',
							'rgba(255, 99, 132, 0.2)'
				        ],
				        borderColor: [
				        	'rgba(54, 162, 235, 1)',
							'rgba(255, 99, 132, 1)'
				        ],
					    borderWidth: 1
					};
					graficoAPI.getGenericGrafico($scope.grafico);
				}
			}, 
			
			function errorCallback(response) {
				console.log(response);
			}
		);
	}
});