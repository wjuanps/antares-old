angular.module("antares").controller("headerCtrl", function ($scope, antaresAPI) {
	function inicializarUsuario() {
		antaresAPI.ajaxPost(
			"src/com/wjuan/antares/requests/requestUsuario.php", null
		).then(
			function successCallBack(response) {
				if (response.data.usuario) {
					$scope.usuario = response.data.usuario;
					$scope.logado = true;
				}
			},
			function errorCallBack(response) {
				console.log(response);
			}
		);
	};
	
	$scope.logOut = function () {
		antaresAPI.ajaxPost(
			"src/com/wjuan/antares/requests/requestLogout.php", null
		).then(
			function successCallBack(response) {
				if (response.data.sucesso) {
					location = location;
				}
			},
			function errorCallBack(response) {
				console.log(response);
			}
		);
	};

	inicializarUsuario();
});