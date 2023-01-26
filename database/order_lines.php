<?PHP
    function getOrderLinesbyOrderID($idOrder){
        global $conn;

		$query = "SELECT orders_lines.id            AS id,
						 orders_lines.id_product    AS id_product,
						 orders_lines.quantity      AS quant,
                         orders_lines.total_price   AS total_price
					FROM orders_lines
					WHERE orders_lines.id_order ="  . $idOrder .";";

		$result = pg_exec($conn, $query);
        return $result;
    }

    function insertinOrderLines($idOrder, $id_product, $quantity){
        global $conn;

        $totalPrice = 0;
        $totalPrice=getTotalPriceProductbyQuantity($id_product, $quantity); //funcao do products.php

		$insertQuery = "INSERT INTO orders_lines (id_order, id_product, quantity, total_price)
						VALUES ('".$idOrder."','".$id_product."','".$quantity."','".$totalPrice."');"; 
		pg_exec($conn, $insertQuery);
    }

    function getProductsandQuantityofOrder($idOrder){
        global $conn;
        $query = "SELECT    orders_lines.id_product    AS id_product,
                            orders_lines.quantity      AS quant
                    FROM orders_lines
                    WHERE orders_lines.id_order ="  . $idOrder .";";

		$result = pg_exec($conn, $query);
        return $result;
	}

?>  