<?PHP
		
	function getTotalVendas(){ //devolve a soma total de todo o dinheiro ganho com as encomendas
		global $conn;
        $totalpriceOrders = 0;
        $query = "	SELECT  orders.total_price  As totalprice
					FROM    orders
					WHERE   orders.state='Concluída'
				 ";
		$result = pg_exec($conn, $query);
        
        $numRows = pg_numrows($result);

		$i = 0;

		while ($i < $numRows) {
			$row = pg_fetch_row($result, $i);
			$totalpriceOrders= $totalpriceOrders + $row[0];  
		$i++;
		}
		
	}

	function getTop5ProductsOrdered(){ //AJUDA PLS
		global $conn;
        $totalpriceOrders = 0;
        //tenho que somar os total price de todos os ids diferentes e tirar os 5 maiores
        //tenho que ter os ids dos produtos
        $query = "	SELECT  orders_lines.id_product  As id
					FROM    orders_lines
				 ";
        $result = pg_exec($conn, $query);
        $numRows = pg_numrows($result);
        $i = 0;

        //depois de ter os ids dos produtos, tenho que somar os total_price por id, porque vai haver varias linhas com o mesmo id produto
		while ($i < $numRows){
			$row = pg_fetch_row($result, $i);
            $query = "	SELECT  orders_lines.total_price  As totalprice_line
                        FROM    orders_lines
                        WHERE   orders_lines.id_product ="  . $row[0] .";
                     ";
            $resultTotalprice = pg_exec($conn, $query);
            $row = pg_fetch_row($resultTotalprice, $i);
			$totalpricebyProduct= $totalpricebyProduct + $row[0]; //nao posso fazer assim
		    $i++;
		}

        //depois de somado por ids tenho que ver quais os 
   
	}

	function getTotalVendasbyMonth(){ //tenho que pensar melhor... 
		global $conn;
        //cada mes vamos ter x encomendas com x ids
        //temos que fazer a soma por mes
        $query = "	SELECT  extract (month from date) As month
					FROM    orders
				 ";
		$result = pg_exec($conn, $query);
        
        $numRows = pg_numrows($result);

	
		

		
	}
?>