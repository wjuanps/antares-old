angular.module("antares").config(function ($httpProvider) {
	$httpProvider.interceptors.push("loadingInterceptor");
});