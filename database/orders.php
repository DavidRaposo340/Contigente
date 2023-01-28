<?PHP
    function getStateofOrder($idOrder){
        global $conn;
		$query = "	SELECT  orders.state   As   state 
					FROM    orders
					WHERE   orders.state='".$idOrder."'
				";
		$result = pg_exec($conn, $query);
        $row = pg_fetch_assoc($result);
		return $row['state'];
    }

    function getOrderIDbyUser($idUser){ //pode ser mais que uma, se existirem ja concluídas
        global $conn;
		$query = "	SELECT  orders.id   As   id
					FROM    orders
					WHERE   orders.user_id='".$idUser."'
				";
		$result = pg_exec($conn, $query);
        return $result;
    }

    function getAllOrdersofUserbyID($idUser){
        global $conn;
		$query = "	SELECT  orders.id               As   id,
                            orders.shipping_price   As   shipping_price,
                            orders.total_price      AS   total_price,
                            orders.state            AS   state,
                            orders.date             As   date
					FROM    orders
					WHERE   orders.user_id='".$idUser."'
				";
		$result = pg_exec($conn, $query);
        return $result;
    }

    function getAllOrders(){
        global $conn;
		$query = "	SELECT  orders.id               As   id,
                            orders.user_id          As   user_id,
                            orders.shipping_price   As   shipping_price,
                            orders.total_price      AS   total_price,
                            orders.state            AS   state,
                            orders.date             As   date
					FROM    orders;";
		$result = pg_exec($conn, $query);
        return $result;
    }

    function updateStateofOrder($idOrder, $state, $date){
        global $conn;

        $updateQuery = "UPDATE orders
                        set orders.state= ".$state." AND 
                            orders.date= ".$date." 
                        where orders.id ="  . $idOrder .";
                        ";
        $result = pg_exec($conn, $updateQuery);
    }

    function getPriceofOrder($idOrder){
        global $conn;
		$query = "	SELECT  orders.price   As   price
					FROM    orders
					WHERE   orders.id='".$idOrder."'
				";
		$result = pg_exec($conn, $query);
        $row = pg_fetch_assoc($result);
		return $row['price'];
    }

    
    function getdateofOrder($idOrder){
        global $conn;
		$query = "	SELECT  orders.date  As  date
					FROM    orders
					WHERE   orders.id='".$idOrder."'
				";
		$result = pg_exec($conn, $query);
        $row = pg_fetch_assoc($result);
		return $row['date'];
    }

    function setPriceofOrder($idOrder){ //precisa de ser confirmada
        global $conn;

        $totalprice_order = 0;
        $query = "	SELECT  orders_lines.totalprice   As   price
					FROM    orders_lines
					WHERE   orders.id='".$idOrder."'
				";

		$result = pg_exec($conn, $query);
        $numRows = pg_numrows($result);

		$i = 0;

		while ($i < $numRows) {
			$row = pg_fetch_row($result, $i);
			$totalprice_order=$totalprice_order+$row[0]; 
			//echo $totalprice;
		$i++;
		}
    }

    function createOrder($idOrder, $idUser, $date){
        global $conn;

		$insertQuery = "INSERT INTO orders (user_id, shipping_price, total_price, state, date)

						VALUES ('".$idUser."', 0 , 0 , 'Não Concluída', '".$date."');"; //em que momento esta funçao vai ser chamada? se calhar o total price nao vai ser 0
			
		$result = pg_exec($conn, $insertQuery);
    }

?>