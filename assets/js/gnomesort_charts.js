async function getData() {
    try {
        return await $.getJSON( "../../logs/_GnomeSort_log.json");
    }
    catch(error) {
        console.log(error);
    }
}


async function main(){
    let data = await getData();
    var data_shuffle_time = [];
    var data_reverse_time = [];
    var data_order_time = [];
    var data_shuffle_operations = [];
    var data_reverse_operations = [];
    var data_order_operations = [];
  
    data.forEach(function (test){
        if(test.array_type == "aleatorio") {
            data_shuffle_time.push({
                label: `${test.size_array}`,
                y: test.time,
            })
  
            data_shuffle_operations.push({
              label: `${test.size_array}`,
              y: test.operations_count,
            })
        }
        else if(test.array_type == "reverso") {
            data_reverse_time.push({
                label: `${test.size_array}`,
                y: test.time,
            })
  
            data_reverse_operations.push({
              label: `${test.size_array}`,
              y: test.operations_count,
            })
        }
        else if(test.array_type == "ordenado") {
            data_order_time.push({
                label: `${test.size_array}`,
                y: test.time,
            })
            data_order_operations.push({
              label: `${test.size_array}`,
              y: test.operations_count,
            })
        }
        
    });
  
  
    var gnome_sort_shuffle_chart = new CanvasJS.Chart("shuffle_gnomesort",
      {	
          title: {
            text: "Tempo de execução para dados aleatórios com o algoritmo GnomeSort",
            fontFamily: "Arial",
          },  
          exportEnabled: true,
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
            dataPoints: data_shuffle_time
          }
          ]
        }
    );
    
    gnome_sort_shuffle_chart.render(); 
  
    var gnome_sort_shuffle_operations_chart = new CanvasJS.Chart("shuffle_gnomesort_operations",
    {	
        title: {
          text: "Quantidade de operações de execução para dados aleatórios com o algoritmo GnomeSort",
          fontFamily: "Arial",
        }, 
        exportEnabled: true,
        axisX: {
          labelAngle: -30
        },
        axisY:{    
          suffix: " op."
        },
        data: [
        {
          type: "line",
          indexlabelAngle: -30,
          indexLabelPlacement: "outside",
          indexLabel: "{y} operacoes",
          dataPoints: data_shuffle_operations
        }
        ]
      }
    );
  
    gnome_sort_shuffle_operations_chart.render(); 
  
  
    var gnome_sort_reverse_chart = new CanvasJS.Chart("reverse_gnomesort",
      {	
          title: {
            text: "Tempo de execução para dados em ordem decrescente com o algoritmo GnomeSort",
            fontFamily: "Arial",
          },  
          exportEnabled: true,
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
            dataPoints: data_reverse_time
          }
          ]
        }
    );
  
    gnome_sort_reverse_chart.render(); 
  
    var gnome_sort_reverse_operations_chart = new CanvasJS.Chart("reverse_gnomesort_operations",
    {	
        title: {
          text: "Quantidade de operações de execução para dados em ordem decrescente com o algoritmo GnomeSort",
          fontFamily: "Arial",
        },  
        exportEnabled: true,
        axisX: {
          labelAngle: -30
        },
        axisY:{    
          suffix: " op."
        },
        data: [
        {
          type: "line",
          indexlabelAngle: -30,
          indexLabelPlacement: "outside",
          indexLabel: "{y} operacoes",
          dataPoints: data_reverse_operations
        }
        ]
      }
    );
  
    gnome_sort_reverse_operations_chart.render(); 
  
    var gnome_sort_order_chart = new CanvasJS.Chart("order_gnomesort",
      {	
          title: {
            text: "Tempo de execução para dados em ordem com o algoritmo GnomeSort",
            fontFamily: "Arial",
          },  
          exportEnabled: true,
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
            dataPoints: data_order_time
          }
          ]
        }
    );
  
    gnome_sort_order_chart.render(); 
  
    var gnome_sort_order_operations_chart = new CanvasJS.Chart("order_gnomesort_operations",
    {	
        title: {
          text: "Quantidade de operações de execução para dados em ordem com o algoritmo GnomeSort",
          fontFamily: "Arial",
        },  
        exportEnabled: true,
        axisX: {
          labelAngle: -30
        },
        axisY:{    
          suffix: " op."
        },
        data: [
        {
          type: "line",
          indexlabelAngle: -30,
          indexLabelPlacement: "outside",
          indexLabel: "{y} operacoes",
          dataPoints: data_order_operations
        }
        ]
      }
    );
  
    gnome_sort_order_operations_chart.render(); 
  }
  
  main();