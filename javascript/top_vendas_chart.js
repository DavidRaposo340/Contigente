
function showTopVendasChart(type) {
    const fillColor = "#3e95cd";
        const plugin = {
            id: 'custom_canvas_background_color',
            beforeDraw: (chart) => {
            const {ctx} = chart;
            ctx.save();
            ctx.globalCompositeOperation = 'destination-over';
            ctx.fillStyle = 'white'; 
            ctx.fillRect(0, 0, chart.width, chart.height);
            ctx.restore();
            }
        };

    var chartType = type;			//chartType is char type selected by the user in the combo
    var canvas 	  = document.getElementById("chartTopVendasCanvas");						//canvas is the HTML element where the chart will be drawn
    canvas.style.backgroundColor = "red";
    var request = new XMLHttpRequest();
    
    //Callback function
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {	

            var yValues = JSON.parse(this.responseText)['vendas'];  	//extract array Yaxis from the JSON stream received from the web service
            var xValues = JSON.parse(this.responseText)['prod'];	
            
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
                plugins: [plugin],
                data: {
                    fill: true,
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
            setTimeout(function() {
                var dataUrl = canvas.toDataURL();
                window.ImageData = dataUrl;
              }, 500);
        } 
    } 

    // invocation of the web service that retrieves the arrays totalSalesAmount[] and month[] (Y and X axis of the chart)
    var data = "../../javascript/top_vendas_chart_generate_data.php";
    request.open("GET",data, true);
    request.send();
}


   
