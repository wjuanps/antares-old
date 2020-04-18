angular.module("antares").controller("loginCtrl", function ($scope, antaresAPI) {
	$scope.logarNoSistema = function (usuario, valid) {
		if (valid) {
			antaresAPI.ajaxPost(
				"src/com/wjuan/antares/requests/requestLogin.php", usuario
			).then(
				function successCallback(response) {
					if (response.data && response.data.usuario) {
						location = "/antares";
					} else {
						$scope.erroAoAcessarSistema = true;
					}
				}, function errorCallback(response) {
					console.log(response);
				}
			);
		}
	}
});