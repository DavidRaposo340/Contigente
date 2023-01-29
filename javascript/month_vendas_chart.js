
function showMonthVendasChart(type) {

    var chartType = type;			//chartType is char type selected by the user in the combo
    var canvas 	  = document.getElementById("chartMonthVendasCanvas");						//canvas is the HTML element where the chart will be drawn

    var request = new XMLHttpRequest();
    
    //Callback function
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {	

            var yValues = JSON.parse(this.responseText)['vendas'];  	//extract array Yaxis from the JSON stream received from the web service
            var xValues = JSON.parse(this.responseText)['mes'];	
            
            var barColors = [
                "#0d2137",
                "#13314d",
                "#194062",
                "#1f5078",
                "#25608e",
                "#2b6fa3",
                "#3e81b4",
                "#5f96c1",
                "#7fabce",
                "#9fc0db",
                "#c0d5e8",
                "#e0eaf5"
              ];

            //Create and configure the chart object
            new Chart(canvas, {													
                type: chartType,
                data: {
                    labels:xValues,
                    datasets:[{
                        data:yValues,
                        backgroundColor: barColors,                        borderColor: "Red",
                        hoverBorderColor: "White",
                    }
                ] //end of the datasets containing the X values, Y values and colors and properties boderColor, hoverBorderColor and label
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: false
                    //maintainAspectRatio: false,
                    //responsive: true
                }
            }) //end of configuration of the new Chart() object

        } //end of if (readystate = 4 and status = 200)
    } //end of function invoked onreadystatechange()


    // invocation of the web service that retrieves the arrays totalSalesAmount[] and month[] (Y and X axis of the chart)
    var data = "../../javascript/month_vendas_chart_generate_data.php";
    request.open("GET",data, true);
    request.send();

}

