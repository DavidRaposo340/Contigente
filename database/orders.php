<?PHP
    function getStateofOrder($idOrder){
        global $conn;
		$query = "	SELECT  orders.state 			As   state, 
					FROM    orders
					WHERE   orders.state='".$idOrder."'
				";
		$result = pg_exec($conn, $query);
		return $result;
    }

    function getAllOrdersofUserbyID($idUser){

    }

    function updateStateofOrder($idOrder){
        
    }

    function getPricesofOrder($idOrder){

    }

    function setPriceofOrder($idOrder){

    }

    function createOrder($idOrder){

    }

?>