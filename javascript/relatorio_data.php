<?php
         include_once "../includes/opendb.php";
         include_once "../database/estatisticas.php";  
         include_once "../database/products.php";  

    $result = getTotalVendas();
    $data["totalVendas"] = $result;
    $dataEncondedInJson = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $dataEncondedInJson;
    
?>