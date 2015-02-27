<?php
	require "phpfunction.php";

	checklogstatus();

	if($_POST["thefunction"]=="newfeed"){
		$con=getconnection();
		if(!sqlselectcheck($con,"SELECT * FROM s1425535.bigmonsters,s1425535.smallmonsters WHERE bigmonsters.id=smallmonsters.bigmonsterID and smallmonsters.id=".$_POST["smid"]." and bigmonsters.ownerNum=".$_SESSION['phonenumber'])) exit; 
		$stmt=runsql($con,"INSERT INTO s1425535.feedhistory(smallmonsterid,starttime,ip) VALUES ('".$_POST["smid"]."','".date('Y-m-d H:i:s',time())."','".$_SERVER["REMOTE_ADDR"]."')");
		echo mysqli_insert_id($con);
		$stmt->close();
		$con->close();	
	}

	if($_POST["thefunction"]=="finishfeeding"){
		$con=getconnection();
		if(!sqlselectcheck($con,"SELECT * FROM s1425535.bigmonsters,s1425535.smallmonsters,s1425535.feedhistory WHERE feedhistory.id='".$_POST["taskid"]."' and bigmonsters.id=smallmonsters.bigmonsterID and smallmonsters.id=".$_POST["smid"]." and bigmonsters.ownerNum=".$_SESSION['phonenumber'])) exit; 
		$stmt=runsql($con,"UPDATE `s1425535`.`feedhistory` SET `finished`='1' WHERE `id`='".$_POST["taskid"]."';");
		echo "update:".$_POST["taskid"]." to finished";
		$stmt->close();
		$con->close();	
	}	

	if($_POST["thefunction"]=="finishfeedingnormal"){
		$con=getconnection();
		if(!sqlselectcheck($con,"SELECT * FROM s1425535.bigmonsters,s1425535.smallmonsters WHERE bigmonsters.id=smallmonsters.bigmonsterID and smallmonsters.id=".$_POST['smid']." and bigmonsters.ownerNum=".$_SESSION['phonenumber'])) exit; 
		$stmt=runsql($con,"UPDATE s1425535.smallmonsters SET finished='1',finishedtime='".date('Y-m-d H:i:s',time())."',finishedip='".$_SERVER["REMOTE_ADDR"]."' WHERE id='".$_POST["smid"]."'");
		echo "update:".$_POST["smid"]." to finished";
		$stmt->close();
		$con->close();	
	}	

	if($_POST["thefunction"]=="dropduringwork"){
		$con=getconnection();

		$sql="SELECT feedhistory.starttime,feedhistory.attemptionforquit FROM s1425535.bigmonsters,s1425535.smallmonsters,s1425535.feedhistory WHERE feedhistory.id='".$_POST["taskid"]."' and bigmonsters.id=smallmonsters.bigmonsterID and smallmonsters.id='".$_POST["smid"]."' and bigmonsters.ownerNum='".$_SESSION['phonenumber']."';";
		$st=runsql($con,$sql);
		$st->bind_result($st,$attemptionforquit);
		if($st->fetch()){
			$stmt=runsql($con,"UPDATE `s1425535`.`feedhistory` SET `attemptionforquit`='".$attemptionforquit.date('Y-m-d H:i:s',time()).";' WHERE `id`='".$_POST["taskid"]."';");
			echo "update drop record:".$attemptionforquit.date('Y-m-d H:i:s',time());
			$stmt->close();
			$con->close();	
		}
	}	

	if($_POST["thefunction"]=="finish30min"){
		$con=getconnection();
		if(!sqlselectcheck($con,"SELECT * FROM s1425535.bigmonsters,s1425535.smallmonsters,s1425535.feedhistory WHERE feedhistory.id='".$_POST["taskid"]."' and bigmonsters.id=smallmonsters.bigmonsterID and smallmonsters.id='".$_POST["smid"]."' and bigmonsters.ownerNum='".$_SESSION['phonenumber']."';")) exit;
		$stmt=runsql($con,"UPDATE `s1425535`.`feedhistory` SET `finishtime`='".date('Y-m-d H:i:s',time())."',finished='1' WHERE `id`='".$_POST["taskid"]."';");
		$stmt2=runsql($con,"UPDATE `s1425535`.`smallmonsters` SET pizzaamount=pizzaamount+1 WHERE `id`='".$_POST["smid"]."';");
		echo "update finished:".$_POST["taskid"]." finished at ".date('Y-m-d H:i:s',time());
		$stmt->close();
		$stmt2->close();
		$con->close();	
	}	

	if($_POST["thefunction"]=="finishsatisfy"){
		$con=getconnection();
		if(!sqlselectcheck($con,"SELECT * FROM s1425535.bigmonsters,s1425535.smallmonsters,s1425535.feedhistory WHERE feedhistory.id='".$_POST["taskid"]."' and bigmonsters.id=smallmonsters.bigmonsterID and smallmonsters.id='".$_POST["smid"]."' and bigmonsters.ownerNum='".$_SESSION['phonenumber']."';")) exit;
		
		$stmt=runsql($con,"UPDATE `s1425535`.`feedhistory` SET `satisfied`='".$_POST["satisfied"]."' WHERE `id`='".$_POST["taskid"]."';");
		echo "update finished:".$_POST["taskid"]." satisfied change to ".$_POST["satisfied"];
		$stmt->close();
		$con->close();	
	}	

?>