angular.module("antares").factory("graficoAPI", function () {
  var _getGenericGrafico = function (grafico) {
    var ctx = document.getElementById(grafico.id).getContext("2d");
    var myChart = new Chart(ctx, {
      type: grafico.type,
      data: {
        labels: grafico.labels,
        datasets: [
          {
            label: grafico.label,
            data: grafico.data,
            backgroundColor: grafico.backgroundColor,
            borderColor: grafico.borderColor,
            borderWidth: grafico.borderWidth,
          },
        ],
      },
      options: grafico.options,
    });
  };

  var _getGraficoComparador = function (grafico) {
    var ctx = document.getElementById(grafico.id).getContext("2d");
    var myChart = new Chart(ctx, {
      type: grafico.type,
      data: {
        labels: grafico.labels,
        datasets: grafico.dataSets,
      },
      options: grafico.options,
    });
  };

  return {
    getGenericGrafico: _getGenericGrafico,
    getGraficoComparador: _getGraficoComparador,
  };
});
