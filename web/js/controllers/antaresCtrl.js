angular.module("antares").controller("antaresCtrl", function($scope, antaresAPI) {
	
	$scope.pesquisas = [];

	$scope.error = false;
	$scope.pesquisar = function(valid, url) {
		$scope.error = valid;
		if (!$scope.error) {
			var newUrl = '';
			antaresAPI.ajaxGet(
				'src/com/wjuan/antares/requests/requestUrlAmigavel.php',
				{url: url}
			).then(
				function successCallback(response) {
					newUrl = response.data.url;
					location = "/antares/".concat(newUrl);
				}, function errorCallback(response) {
					console.log(response);
				}
			);
		}
	};

	$scope.keyEvent = function (event, searchForm, search) {
		if (event.keyCode === 13) {
			$scope.pesquisar(searchForm.$invalid, search);
		}
	};

	$scope.init = function() {
		antaresAPI.ajaxGet(
			'src/com/wjuan/antares/requests/requestPesquisa.php', null
		).then(
			function successCallback(response) {
				$scope.pesquisas = response.data.dados;
			}, function errorCallback(response) {
				console.log(response);
			}
		);
	};
});