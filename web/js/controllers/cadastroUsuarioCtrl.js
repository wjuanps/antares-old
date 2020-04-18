angular.module("antares").controller("cadastroUsuarioCtrl", function ($scope, antaresAPI) {
	$scope.limparCampos = function () {
		delete $scope.usuario;
		$scope.formCadastro.$setPristine();
	}

	$scope.cadastrarUsuario = function (invalid, usuario) {
		$scope.error = invalid;
		if (!invalid) {
			usuario.nome = normalizarNome(usuario);
			antaresAPI.ajaxPost(
				"src/com/wjuan/antares/requests/requestCadastrarUsuario.php", usuario
			).then(
				function successCallBack(response) {
					if (response.data.mensagem === "sucesso") {
						location = "/antares";
					} else {
						$scope.mensagem = response.data.mensagem;
						console.log(response.data.mensagem);
					}
				},
				function errorCallBack(response) {
					console.log(response);
				}
			);
		}
	}

	var normalizarNome = function (usuario) {
		var listaDeNomes = usuario.nome.split(" ");
		listaDeNomes = listaDeNomes.filter(function (nome) {
			return nome;
		});

		listaDeNomes = listaDeNomes.map(function (nome) {
			if (nome.length <= 2) return nome.toLowerCase();
			return nome.charAt(0).toUpperCase().concat(nome.substring(1).toLowerCase());
		});
		return listaDeNomes.join(" ");
	}
});