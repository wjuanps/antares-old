angular.module("antares").factory("loadingInterceptor", function ($q, $rootScope) {
	return {
		request: function (config) {
			if ((config.url.indexOf("requestSentimento.php") > 0)
				|| (config.url.indexOf("requestComparador.php") > 0)) {
				$rootScope.loading = true;
			}
			return config;
		},
		requestError: function (rejection) {
			$rootScope.loading = false;
			return $q.reject(rejection);
		},
		response: function (response) {
			if ((response.data.mensagens || response.data.vazio)
					|| response.data.sentimentos) {
				$rootScope.loading = false;
			}
			return response;
		},
		responseError: function (rejection) {
			$rootScope.loading = false;
			return $q.reject(rejection);
		}
	};
});