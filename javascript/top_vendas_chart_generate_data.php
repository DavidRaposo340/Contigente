<?php
        include_once "../includes/opendb.php";
        include_once "../database/estatisticas.php";  
        include_once "../database/products.php";  

    $result = getVendasProducts();
    for($i=0;$i<pg_numrows($result);$i++){
        $row = pg_fetch_assoc($result);
        $data["prod"][$i]=getNameofProductbyID($row['id_product']);
        $data["vendas"][$i]=$row['total_sales'];
    }
    //JSON_UNESCAPED_UNICODE -> para garantir que os caracteres especiais sao bem impressos no chart
    $dataEncondedInJson = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $dataEncondedInJson;
    
?>