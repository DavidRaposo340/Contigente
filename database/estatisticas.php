<?PHP
		
	function getTotalVendas(){ //devolve a soma total de todo o dinheiro ganho com as encomendas
		global $conn;
        $totalpriceOrders = 0;
        $query = "	SELECT  orders.total_price  As totalprice
					FROM    orders
					WHERE   orders.state='Pago' OR orders.state='Entregue'
				 ";
		$result = pg_exec($conn, $query);
        
        $numRows = pg_numrows($result);

		$i = 0;

		while ($i < $numRows) {
			$row = pg_fetch_row($result, $i);
			$totalpriceOrders= $totalpriceOrders + $row[0];  
		$i++;
		}
		return $totalpriceOrders;
		
	}
	function getTop5Product(){
		global $conn;
		$query = "	SELECT id_product AS id_product, 
					SUM(orders_lines.total_price) as total_sales
					FROM contigente.orders 
					JOIN contigente.orders_lines ON orders.id = orders_lines.id_order
					WHERE orders.state = 'Pago' OR orders.state='Entregue'
					GROUP BY id_product
					ORDER BY total_sales DESC
					LIMIT 5
				";

		$result = pg_query($conn, $query);
		return $result;
		/*while ($row = pg_fetch_assoc($result)) {
			echo "Product ID: ".$row['id_product']." Total Sales: ".$row['total_sales']."\n";
		}*/
	}
	function getVendasProducts(){
		global $conn;
		$query = "	SELECT id_product AS id_product, 
					SUM(orders_lines.total_price) as total_sales
					FROM contigente.orders 
					JOIN contigente.orders_lines ON orders.id = orders_lines.id_order
					WHERE orders.state = 'Pago' OR orders.state='Entregue'
					GROUP BY id_product
					ORDER BY total_sales DESC
				";

		$result = pg_query($conn, $query);
		return $result;
	}
	

	function getTotalVendasbyMonth(){ 
		global $conn;
        $query = "	SELECT  extract (month from date) As month,
							SUM(orders_lines.total_price) as total_sales
					FROM    orders
					JOIN contigente.orders_lines ON orders.id = orders_lines.id_order
					WHERE orders.state = 'Pago' OR orders.state='Entregue'
					GROUP BY month
					ORDER BY month
				 ";
		$result = pg_exec($conn, $query);
		return $result;		
	}

	//Funções para as sugestões

	function getSuggestionAumentarPreco(){ //seleciona o produto mais vendido -> pode se aumentar o preço um pouco
		global $conn;
		$query = "	SELECT id_product AS id_product, 
					SUM(orders_lines.total_price) as total_sales
					FROM contigente.orders 
					JOIN contigente.orders_lines ON orders.id = orders_lines.id_order
					WHERE orders.state = 'Pago' OR orders.state='Entregue'
					GROUP BY id_product
					ORDER BY total_sales DESC
					LIMIT 1
				";

		$result = pg_query($conn, $query);
		return $result;
	}

	function getSuggestionDiminuirPreco(){ //seleciona o produto menos vendido -> pode se diminuir o preço um pouco. mas mais certo seria ver os produtos que nao foram vendidos nao era?
		global $conn;
		$query = "	SELECT id_product AS id_product, 
					SUM(orders_lines.total_price) as total_sales
					FROM contigente.orders 
					JOIN contigente.orders_lines ON orders.id = orders_lines.id_order
					WHERE orders.state = 'Pago' OR orders.state='Entregue'
					GROUP BY id_product
					ORDER BY total_sales ASC
					LIMIT 1
				";

		$result = pg_query($conn, $query);
		return $result;
	}

?>