var data = [
    {"array_type":"ordenado","size_array":1000,"time":0.0005490779876708984,"operations_count":5000},
    {"array_type":"reverso","size_array":1000,"time":0.0005011558532714844,"operations_count":10000},
    {"array_type":"aleatorio","size_array":1000,"time":0.00074005126953125,"operations_count":15000},
    {"array_type":"ordenado","size_array":10000,"time":0.006393909454345703,"operations_count":65000},
    {"array_type":"reverso","size_array":10000,"time":0.006551027297973633,"operations_count":115000},
    {"array_type":"aleatorio","size_array":10000,"time":0.024140119552612305,"operations_count":165000},
    {"array_type":"ordenado","size_array":100000,"time":0.07359004020690918,"operations_count":665000},
    {"array_type":"reverso","size_array":100000,"time":0.054670095443725586,"operations_count":1165000},
    {"array_type":"aleatorio","size_array":100000,"time":1.8879759311676025,"operations_count":1665000},
    {"array_type":"ordenado","size_array":1000000,"time":0.591270923614502,"operations_count":6665000},
    {"array_type":"reverso","size_array":1000000,"time":0.5672280788421631,"operations_count":11665000},
    {"array_type":"aleatorio","size_array":1000000,"time":184.79140400886536,"operations_count":16665000}
];
    
var data_shuffle = [];
var data_reverse = [];
var data_order = [];

data.forEach(function (test){
    if(test.array_type == "aleatorio") {
        data_shuffle.push({
            label: `${test.size_array}`,
            y: test.time,
        })
    }
    

    else if(test.array_type == "reverso") {
        data_reverse.push({
            label: `${test.size_array}`,
            y: test.time,
        })
    }

    else if(test.array_type == "ordenado") {
        data_order.push({
            label: `${test.size_array}`,
            y: test.time,
        })
    }
    
});


var smooth_sort_shuffle_chart = new CanvasJS.Chart("shuffle_smoothsort",
  {	
      title: {
				text: "Tempo de execução para dados aleatórios com o algoritmo SmoothSort"
			},  
  		
      axisX: {
				labelAngle: -30
			},
      axisY:{    
        suffix: " seg."
     	},
      data: [
      {
        type: "line",
        indexlabelAngle: -30,
        indexLabelPlacement: "outside",
        indexLabel: "{y} segundos",
        dataPoints: data_shuffle
      }
      ]
    }
);

smooth_sort_shuffle_chart.render(); 

var smooth_sort_reverse_chart = new CanvasJS.Chart("reverse_smoothsort",
  {	
      title: {
				text: "Tempo de execução para dados em ordem decrescente com o algoritmo SmoothSort"
			},  
  		
      axisX: {
				labelAngle: -30
			},
      axisY:{    
        suffix: " seg."
     	},
      data: [
      {
        type: "line",
        indexlabelAngle: -30,
        indexLabelPlacement: "outside",
        indexLabel: "{y} segundos",
        dataPoints: data_reverse
      }
      ]
    }
);

smooth_sort_reverse_chart.render(); 

var smooth_sort_order_chart = new CanvasJS.Chart("order_smoothsort",
  {	
      title: {
				text: "Tempo de execução para dados em ordem com o algoritmo SmoothSort"
			},  
  		
      axisX: {
				labelAngle: -30
			},
      axisY:{    
        suffix: " seg."
     	},
      data: [
      {
        type: "line",
        indexlabelAngle: -30,
        indexLabelPlacement: "outside",
        indexLabel: "{y} segundos",
        dataPoints: data_order
      }
      ]
    }
);

smooth_sort_order_chart.render(); 