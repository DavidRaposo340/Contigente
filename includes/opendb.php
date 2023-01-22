<?PHP
	
	$conn = pg_connect("host=db.fe.up.pt dbname=sie2235 user=sie2235 password=BtWjOmNs");
	if (!$conn)
			{
		print "Nao foi possivel estabelecer a ligacao";
		exit;
		}
	$query = "set schema 'contigente';";	
	pg_exec($conn, $query);

?>