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
	function getTop5Product(){
		global $conn;
		$query = "SELECT id_product, SUM(orders_lines.total_price) as total_sales
					FROM contigente.orders 
					JOIN contigente.orders_lines ON orders.id = orders_lines.id_order
					WHERE orders.state = 'Concluída'
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
	

	function getTotalVendasbyMonth(){ 
		global $conn;
        $query = "	SELECT  extract (month from date) As month,
							SUM(orders_lines.total_price) as total_sales
					FROM    orders
					JOIN contigente.orders_lines ON orders.id = orders_lines.id_order
					WHERE orders.state = 'Concluída' 
					GROUP BY month
					ORDER BY month
				 ";
		$result = pg_exec($conn, $query);
		return $result;		
	}
?>