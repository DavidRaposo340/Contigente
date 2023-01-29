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
        include_once "../../database/users.php";  
        
     
        if (!empty($_SESSION['filtro_rec'])) $filtro_rec = $_SESSION['filtro_rec'];    else $filtro_rec = NULL;

        $list_receitas = getAllReceitas($filtro_rec);

        if (!empty($_SESSION['user'])) $user_logged = $_SESSION['user'];    else $user_logged = NULL;

        
    ?>

    <div>
        <p>
            <br>
            Aqui encontra sugestões de algumas refeições deliciosas e simples e o melhor: caso queira fazer a receita e não tenha os ingredientes, basta clicar num botão para adicionar tudo o que precisa ao seu carrinho!

        </p>
    </div>

    <!--Search Bar-->
    <div class="search-container">
            <form action="/action_page.php">
                <input type="text" placeholder="Procurar receita..." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
    </div>

        <?php
         $restrictions=getRestrictionsofUser($user_logged);
         $restr = pg_fetch_assoc($restrictions);
         $no_gluten  = $restr['no_gluten'];
         $no_lacti   = $restr['no_lacti'];
         $vegan      = $restr['vegan'];
        if ($user_logged == NULL) { //vai mostrar todas as receitas na tabela e se nao tiver restriçoes nenhumas. ideia David: apresentar a tabela mesmo que esteja logado
            echo"<div class=\"generic_table_style\">";
            echo "<table>";
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
           //SLIDESHOW 
            /*if($user_logged == NULL){
                include("javascript/slideshow_receitas.php"); 
            }*/
        }

            else{ //tem user logado, vamos mostrar a pagina com receitas de acordo com as suas restrições
               
       
                echo "<div>";
                echo "<p>";
                
                echo "<br>";
                if ($vegan=='t' OR $no_gluten=='t' AND $no_lacti=='t'){
                    echo "Como tem a seguinte restrição alimentar: "; 
                    if($no_gluten=='t'){ 
                        echo "- Intolerante a glúten ";
                    }
                    if($no_lacti=='t'){
                        echo "- Intolerante a laticínios ";
                    }
                    if($vegan=='t'){
                        echo "- Vegan ";
                    }
                }
                echo "</p>";
                echo "<p>";
                echo "Sugerimos-lhe as seguintes receitas: ";
                echo "</p>";
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
