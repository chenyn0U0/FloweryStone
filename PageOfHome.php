<?php
	session_start(); 
	if (!isset($_SESSION['phonenumber'])){
		header('Location: login.php');
	}

	$con = new mysqli("localhost","s1425535","InQzRF8RSn","s1425535");
	//$con = new mysqli("playground.eca.ed.ac.uk","s1425535","InQzRF8RSn","s1425535");
	if ($con->connect_errno) {
	   printf("Connect failed: %s\n", $con->connect_error);
	   exit();
	}

	$stmt=$con->prepare("SELECT bigmonsters.name,houseinfo.housepic FROM s1425535.bigmonsters , s1425535.houseinfo where bigmonsters.houseid=houseinfo.houseid and bigmonsters.ownerNum=".$_SESSION['phonenumber'].";");
	$stmt->execute();
	$stmt->bind_result($monstername,$housesrc);
?>
	
	<div style="width:100%; height:100%">

<?php


?>

<div>
	
	<?php
	while ($stmt->fetch()) {
	 printf("<a href=\"javascript:alertname('%s')\";><div style='float:left; margin:50px; text-align:center' id='%s'><img src='%s'/><p>%s</p></div></a>",$monstername,$monstername,$housesrc,$monstername); 
	}
	$stmt->close();
	$con->close();
	?>
	
</div>
<script>
function alertname(name){
	alert(name);
}
</script>


<?php




?>

</div>