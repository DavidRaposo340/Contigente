<!DOCTYPE html>
<html>
<meta charset="UTF-8">

<head>
    <title>Loja De Produtos</title>
    <!-- PARA ICON SEARCHBAR-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
        $path2root = "../../";
        include("../../includes/navbar.php"); 
        include_once "../../includes/opendb.php";
        include_once "../../database/recipes.php";  

        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
     
        if (!empty($_SESSION['filtro_rec'])) $filtro_rec = $_SESSION['filtro_rec'];    else $filtro_rec = NULL;

        $list_receitas = getAllReceitas($filtro_rec);

        if (!empty($_SESSION['user'])) $user_logged = $_SESSION['user'];    else $user_logged = NULL;
        
        echo '<div class="esquerda_sugestoes">';
        echo '<h1>As Nossas Sugestões</h1>';
            echo '<p>';
            echo '<br>';
                echo 'Aqui encontra sugestões de algumas refeições deliciosas e simples e o melhor:<br><br> Caso queira fazer a receita e não tenha os ingredientes, basta clicar num botão para adicionar tudo o que precisa ao seu carrinho!';
            echo '';
            echo '</p>';
            echo '';

                echo"<div class=\"sugestoes_table_style\">";
                echo "<table  cellspacing='0' cellpadding='0'>";
                echo "<tr>";
                echo "<th>Nome da receita</th>";
                echo "<th>Dificuldade</th>";
                echo "<th>Tempo de preparação</th>";
                echo " <th>Preço total</th>";
                echo "</tr>";

                $row = pg_fetch_assoc($list_receitas);

                while (isset($row['id'])) {

                    echo "<tr>";
                    echo "<td> <a href=\"" . $path2root . "paginas_form/receita/listar_receita_info.php?id=" . $row['id'] . "\"> " . $row['nome'] . "</td>";
                    echo "<td>" . $row['difi'] . "</td>";
                    echo "<td>" . $row['total_time'] . " Minutos </td>";
                    echo "<td>" . $row['total_price'] . " €</td>";
                    echo "<tr>";

                    $row = pg_fetch_assoc($list_receitas);
                }
                echo "</table>";
                echo "</div>";
        echo "</div>";

     
    


        echo "<div class=\"flex-box-container\">";
            if($user_logged!=NULL){ //tem user logado, vamos mostrar a coluna da direita com receitas de acordo com as suas restrições
                $restrictions=getRestrictionsofUser($user_logged);
                $restr = pg_fetch_assoc($restrictions);
                $no_gluten  = $restr['no_gluten'];
                $no_lacti   = $restr['no_lacti'];
                $vegan      = $restr['vegan'];
       
                
                echo "<br>";
                if ($no_gluten == 't' || $no_lacti == 't' || $vegan == 't') {
                    echo "<h3>Como tem a seguinte restrição alimentar:</h3><br><br> ";
                    echo "<p>";
                    if ($no_gluten == 't') {
                        echo "- Intolerante a glúten <br>";
                    }
                    //if ($no_lacti == 't') {
                        echo "- Intolerante a laticínios <br>";
                    //}
                    if ($vegan == 't') {
                        echo "- Vegan <br>";
                    }
                }
                echo "</p><br><br>";

                echo "<h4>Sugerimos-lhe as seguintes receitas:</h4> ";

                echo "</div>";

                $list_receitas = getRecipesWithRestrictions($no_gluten, $no_lacti, $vegan);
                $row = pg_fetch_assoc($list_receitas);      
                echo "<div class=\"flex-box_receita\">";
                while (isset($row['id'])) {
                    echo "<div class=\"cartao_receita\">";
                    echo "<img src=" .$path2root. "images\\".$row['img_path']." alt=\"".$row['nome']."\">";
                    echo "<div class=\"cartao_nome_preco_receita\">";   
                    echo "<h2> ".$row['nome']." </h2>";
                    echo "<h3> ".$row['total_price']."€ </h2>";
                    echo "</div>";
                    echo "<div class=\"cartao_botoes_receita\">";
                    echo "<button onclick=\"location.href='".$path2root."paginas_form/receita/listar_receita_info.php?id=".$row['id']."';\"> Ver preparação</button>";
                    echo "</div>";   
                    echo "</div>";            
                    $row = pg_fetch_assoc($list_receitas);
                }           
            }
    
        ?>
       
         

</body>

</html>