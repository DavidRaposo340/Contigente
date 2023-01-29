<!DOCTYPE html>
<html>
<meta charset="UTF-8">

<head>
    <title>Loja De Produtos</title>
    <!-- PARA ICON SEARCHBAR-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
        <!-- PARA Chart.js-->    
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css">

    <link rel="stylesheet" href="../../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<?php
        $path2root = "../../";
        include("../../includes/navbar.php"); 
        include_once "../../includes/opendb.php";
        include_once "../../database/estatisticas.php";  
        include_once "../../database/products.php";  

        
     
        if (!empty($_SESSION['user'])) $user_logged = $_SESSION['user'];    else $user_logged = NULL;
        
    ?>

<body onload="showTopVendasChart('pie'); showMonthVendasChart('bar');">

    <br>
    <br>

    <div class="estatistica">
        <div> 
            <h1> Estatísticas </h1>
        </div>
        <br>
        <br>
        <div class="row_estatitica">
            <div class="collumn_50">
                <h2> Total de Vendas: </h2>
                <?php
                    $result = getTotalVendas();
                    echo "<p> ";
                    echo $result;
                    echo "</p>";
                    echo "<br>";
                ?>
            </div>
            <div class="collumn_50">
            <button class="confirm_button" onclick="location.href='../../';"> Gerar Relatorio </button>
            </div>
        </div>

        <div class="row_estatitica">
            <div class="collumn_50">
                <h2> Total de Vendas por Produto (Top 5): </h2>
                <?php
                    echo"<div class=\"generic_table_style\">";
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Produto</th>";
                    echo "<th>Total de Vendas</th>";
                    echo "</tr>";

                    $result = getTop5Product();
                    $row = pg_fetch_assoc($result);
                    $i = 0;
                    while (isset($row['id_product'])) {
                        echo "<tr>";
                        $id = $row['id_product'];
                        $name_product=getNameofProductbyID($id);
                        echo "<td>" . $name_product . "</td>";
                        echo "<td>" . $row['total_sales']." € </td>";
                        echo "<tr>";
                        $row = pg_fetch_assoc($result);
                        $i++;
                    }

                    echo "</table>";
                    echo "</div>";
                
                ?>
            </div>
            <div class="collumn_50">
                <h2> Total de Vendas por Produto: </h2>               
                <canvas id="chartTopVendasCanvas"></canvas>
            </div>
        </div>

        
        <div class="row_estatitica">
            <div class="collumn_50">
                <h2> Total de Vendas por mês: </h2>
                    <?php
                
                        
                        echo"<div class=\"generic_table_style\">";
                        echo "<table>";
                        echo "<tr>";
                        echo "<th>Mês</th>";
                        echo "<th>Total de Vendas</th>";
                        echo "</tr>";

                        $result = getTotalVendasbyMonth();
                        $row = pg_fetch_assoc($result);
                        $i = 0;
                        while (isset($row['month'])) {
                            echo "<tr>";
                            echo "<td>" . $row['month'] . "</td>";
                            echo "<td>" . $row['total_sales']." €</td>";
                            echo "<tr>";
                            $row = pg_fetch_assoc($result);
                            $i++;
                        }

                        echo "</table>";
                        echo "</div>";
                    ?>
            </div> 
            <div class="collumn_50">
                <h2> Total de Vendas por Produto: </h2>   
                <canvas id="chartMonthVendasCanvas"></canvas>            
            </div>
        </div>       
            
        <!-- SUGESTÕES -->
        <div>
            <h2> Sugestões </h2>
            <?php

            $sug1 = getSuggestionAumentarPreco();
            $increasePrice=pg_fetch_assoc($sug1);
            $id_sug1 = $increasePrice['id_product'];
            $name1 = getNameofProductbyID($id_sug1);

            $sug2= getSuggestionDiminuirPreco();
            $decreasePrice=pg_fetch_assoc($sug2);
            $id_sug2 = $decreasePrice['id_product'];
            $name2 = getNameofProductbyID($id_sug2);
            echo "<p> ";
            echo "Deve aumentar o preço do produto - $name1";
            echo "<br>";
            echo "Deve diminuir o preço do produto - $name2";
            echo "</p>";

            ?>
        </div>
    </div>

    <!-- Boa pratica executar os scripts mesmo antes do fim do body -->
    <!--include the Chart.JS library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
    <script src="<?php echo $path2root ?>javascript/top_vendas_chart.js"></script>
    <script src="<?php echo $path2root ?>javascript/month_vendas_chart.js"></script>


</body>

</html>
