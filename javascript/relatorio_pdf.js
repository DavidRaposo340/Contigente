   
    var button=document.getElementById("button_pdf");
    button.onclick = function() {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {	
                var data = JSON.parse(this.responseText);  
                var total = JSON.parse(this.responseText)['totalVendas'];  
                var doc = new jsPDF();
                const img = new Image();
                img.src = '../../images/logo/icon.jpg';
                img.onload = function() {
                    doc.addImage(img, 'JPEG', 45, 5, 125, 80);
                    doc.setTextColor("black");
                    doc.setFontType("bold");
                    doc.text("Total de vendas:", 35, 90);
                    doc.setFontType("normal");
                    doc.text(total.toFixed(2) + " \u20ac", 85, 90);
                    doc.setFontType("bold");
                    doc.text("Total de vendas por produto:", 35, 100);
                    doc.addImage(window.ImageData, 'JPEG', 20, 110, 180, 80);
                    doc.save("Relatorio - Contigente.pdf");
                }
            } 
            else {
                console.error("Request failed with status code: " + this.status);
            }
        }
        var data = "../../javascript/relatorio_data.php";
        request.open("GET",data, true);
        request.send();
    }

