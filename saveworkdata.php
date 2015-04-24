<?php
	require "phpfunction.php";

	checklogstatus();
	if(isset($_POST["thefunction"])){
		if($_POST["thefunction"]=="updateusermessageboxinfo"){
			print_r($_POST);
			$con=getconnection();

			if($_POST["mode"]!="createnewproject"&&$_POST["mode"]!="backtomainpage"&&$_POST["mode"]!="deletefinishproject"&&
				$_POST["mode"]!="createnewtask"&&$_POST["mode"]!="droptask") exit; 
			$stmt=runsql($con,"UPDATE s1425535.user SET ".$_POST["mode"]."=1 WHERE username='".$_SESSION["username"]."';");
			$stmt->close();
			$con->close();	
		}



		if($_POST["thefunction"]=="newfeed"){
			$con=getconnection();
			if(!sqlselectcheck($con,"SELECT * FROM s1425535.bigmonsters,s1425535.smallmonsters WHERE bigmonsters.id=smallmonsters.bigmonsterID and smallmonsters.id=".$_POST["smid"]." and bigmonsters.ownerNum='".$_SESSION['username']."'")) exit; 
			$stmt=runsql($con,"INSERT INTO s1425535.feedhistory(smallmonsterid,starttime,ip) VALUES ('".$_POST["smid"]."','".date('Y-m-d H:i:s',time())."','".$_SERVER["REMOTE_ADDR"]."')");
			echo mysqli_insert_id($con);
			$stmt->close();
			$con->close();	
		}

		// if($_POST["thefunction"]=="finishfeeding"){
		// 	$con=getconnection();
		// 	if(!sqlselectcheck($con,"SELECT * FROM s1425535.bigmonsters,s1425535.smallmonsters,s1425535.feedhistory WHERE feedhistory.id='".$_POST["taskid"]."' and bigmonsters.id=smallmonsters.bigmonsterID and smallmonsters.id=".$_POST["smid"]." and bigmonsters.ownerNum='".$_SESSION['username']."'")) exit; 
		// 	$stmt=runsql($con,"UPDATE `s1425535`.`feedhistory` SET `finished`='1' WHERE `id`='".$_POST["taskid"]."';");
		// 	echo "update:".$_POST["taskid"]." to finished";
		// 	$stmt->close();
		// 	$con->close();	
		// }	

		if($_POST["thefunction"]=="finishbigmonster"){
			$con=getconnection();
			if(!sqlselectcheck($con,"SELECT * FROM s1425535.bigmonsters WHERE id='".$_POST['bmid']."' and bigmonsters.ownerNum='".$_SESSION['username']."'")) exit; 
			$stmt=runsql($con,"UPDATE s1425535.bigmonsters SET finished='1',finishedtime='".date('Y-m-d H:i:s',time())."',finishedip='".$_SERVER["REMOTE_ADDR"]."' WHERE id='".$_POST["bmid"]."'");
			$stmt->close();
			$con->close();	
		}

		if($_POST["thefunction"]=="updatesmdescription"){
			$con=getconnection();
			if(!sqlselectcheck($con,"SELECT * FROM s1425535.smallmonsters,s1425535.bigmonsters WHERE smallmonsters.id='".$_POST['smid']."' and smallmonsters.bigmonsterID=bigmonsters.id and bigmonsters.ownerNum='".$_SESSION['username']."'")) exit; 
			$stmt=runsql($con,"UPDATE s1425535.smallmonsters SET smallmonsters.description='".$_POST["content"]."' WHERE smallmonsters.id='".$_POST["smid"]."'");
			$stmt->close();
			$con->close();	
		}
		if($_POST["thefunction"]=="updatesmname"){
			$con=getconnection();
			if(!sqlselectcheck($con,"SELECT * FROM s1425535.smallmonsters,s1425535.bigmonsters WHERE smallmonsters.id='".$_POST['smid']."' and smallmonsters.bigmonsterID=bigmonsters.id and bigmonsters.ownerNum='".$_SESSION['username']."'")) exit; 
			$stmt=runsql($con,"UPDATE s1425535.smallmonsters SET smallmonsters.name='".$_POST["content"]."' WHERE smallmonsters.id='".$_POST["smid"]."'");
			$stmt->close();
			$con->close();
		}

		if($_POST["thefunction"]=="updatebmdescription"){
			$con=getconnection();
			if(!sqlselectcheck($con,"SELECT * FROM s1425535.bigmonsters WHERE bigmonsters.id='".$_POST['bmid']."' and bigmonsters.ownerNum='".$_SESSION['username']."'")) exit; 
			$stmt=runsql($con,"UPDATE s1425535.bigmonsters SET bigmonsters.description='".$_POST["content"]."' WHERE bigmonsters.id='".$_POST["bmid"]."'");
			$stmt->close();
			$con->close();	
		}
		if($_POST["thefunction"]=="updatebmname"){
			$con=getconnection();
			if(!sqlselectcheck($con,"SELECT * FROM s1425535.bigmonsters WHERE bigmonsters.id='".$_POST['bmid']."' and bigmonsters.ownerNum='".$_SESSION['username']."'")) exit; 
			$stmt=runsql($con,"UPDATE s1425535.bigmonsters SET bigmonsters.name='".$_POST["content"]."' WHERE bigmonsters.id='".$_POST["bmid"]."'");
			$stmt->close();
			$con->close();
		}


		if($_POST["thefunction"]=="deletebigmonster"){
			$con=getconnection();
			if(!sqlselectcheck($con,"SELECT * FROM s1425535.bigmonsters WHERE id='".$_POST['bmid']."' and bigmonsters.ownerNum='".$_SESSION['username']."'")) exit; 
			$saftystmt=runsql($con,"SET SQL_SAFE_UPDATES = 0;");
			$stmt=runsql($con,"SELECT id FROM s1425535.smallmonsters WHERE bigmonsterid='".$_POST['bmid']."'");
			$stmt->bind_result($smallid);
			$somecon=getconnection();
			while($stmt->fetch()){
				$stmt1=runsql($somecon,"DELETE FROM s1425535.feedhistory WHERE smallmonsterid='".$smallid."'");
				$stmt1->close();
				$stmt1=runsql($somecon,"DELETE FROM s1425535.smallmonsters WHERE id='".$smallid."'");
				$stmt1->close();	
			}
			$somecon->close();
			$stmt->close();
			$stmt3=runsql($con,"DELETE FROM s1425535.bigmonsters WHERE id='".$_POST["bmid"]."'");
			$saftystmt=runsql($con,"SET SQL_SAFE_UPDATES = 1;");
			$saftystmt->close();
			$stmt3->close();
			$con->close();	
		}

		if($_POST["thefunction"]=="deletesmallmonster"){
			$con=getconnection();
			if(!sqlselectcheck($con,"SELECT * FROM s1425535.bigmonsters,s1425535.smallmonsters WHERE bigmonsters.id=smallmonsters.bigmonsterID and smallmonsters.id=".$_POST['smid']." and bigmonsters.ownerNum='".$_SESSION['username']."'")) exit; 
			$stmt1=runsql($con,"DELETE FROM s1425535.smallmonsters WHERE id='".$_POST["smid"]."'");
			$stmt2=runsql($con,"DELETE FROM s1425535.feedhistory WHERE smallmonsterid='".$_POST["smid"]."'");
			$stmt1->close();
			$stmt2->close();
			$con->close();	
		}

		if($_POST["thefunction"]=="finishfeedingnormal"){
			$con=getconnection();
			if(!sqlselectcheck($con,"SELECT * FROM s1425535.bigmonsters,s1425535.smallmonsters WHERE bigmonsters.id=smallmonsters.bigmonsterID and smallmonsters.id=".$_POST['smid']." and bigmonsters.ownerNum='".$_SESSION['username']."'")) exit; 
			$stmt=runsql($con,"UPDATE s1425535.smallmonsters SET name=concat('[Finished!] ',name),finished='1',finishedtime='".date('Y-m-d H:i:s',time())."',finishedip='".$_SERVER["REMOTE_ADDR"]."' WHERE id='".$_POST["smid"]."'");
			echo "update:".$_POST["smid"]." to finished";
			$stmt->close();
			$con->close();	
		}	

		if($_POST["thefunction"]=="dropduringwork"){
			$con=getconnection();

			$sql="SELECT feedhistory.starttime,feedhistory.attemptionforquit FROM s1425535.bigmonsters,s1425535.smallmonsters,s1425535.feedhistory WHERE feedhistory.id='".$_POST["taskid"]."' and bigmonsters.id=smallmonsters.bigmonsterID and smallmonsters.id='".$_POST["smid"]."' and bigmonsters.ownerNum='".$_SESSION['username']."';";
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
			if(!sqlselectcheck($con,"SELECT * FROM s1425535.bigmonsters,s1425535.smallmonsters,s1425535.feedhistory WHERE feedhistory.id='".$_POST["taskid"]."' and bigmonsters.id=smallmonsters.bigmonsterID and smallmonsters.id='".$_POST["smid"]."' and bigmonsters.ownerNum='".$_SESSION['username']."';")) exit;
			$stmt=runsql($con,"UPDATE `s1425535`.`feedhistory` SET `finishtime`='".date('Y-m-d H:i:s',time())."',finished='1' WHERE `id`='".$_POST["taskid"]."';");
			$stmt2=runsql($con,"UPDATE `s1425535`.`smallmonsters` SET pizzaamount=pizzaamount+1 WHERE `id`='".$_POST["smid"]."';");
			echo "update finished:".$_POST["taskid"]." finished at ".date('Y-m-d H:i:s',time());
			$stmt->close();
			$stmt2->close();
			$con->close();	
		}	

		if($_POST["thefunction"]=="finishsatisfy"){
			$con=getconnection();
			if(!sqlselectcheck($con,"SELECT * FROM s1425535.bigmonsters,s1425535.smallmonsters,s1425535.feedhistory WHERE feedhistory.id='".$_POST["taskid"]."' and bigmonsters.id=smallmonsters.bigmonsterID and smallmonsters.id='".$_POST["smid"]."' and bigmonsters.ownerNum='".$_SESSION['username']."';")) exit;
			
			$stmt=runsql($con,"UPDATE `s1425535`.`feedhistory` SET `satisfied`='".$_POST["satisfied"]."' WHERE `id`='".$_POST["taskid"]."';");
			echo "update finished:".$_POST["taskid"]." satisfied change to ".$_POST["satisfied"];
			$stmt->close();
			$con->close();	
		}	
	}

	if(isset($_POST['newSmonster'])){
			$con = getconnection();

			$stmt=runsql($con,"INSERT INTO s1425535.smallmonsters(bigmonsterID,name,description,smallmonsterid,adopttime,adoptip) VALUES ('".$_POST["bmid"]."','".$_POST["smname"]."','".$_POST["smdescription"]."','".mt_rand(1,5)."','".date('Y-m-d H:i:s',time())."','".$_SERVER["REMOTE_ADDR"]."')");
			$stmt->close();
			
			echo $_POST["bmid"];
			$con->close();
	}
	print_r($_POST);


	if(isset($_POST['newmonster'])){
		$con = getconnection();

		$stmt=runsql($con,"INSERT INTO s1425535.bigmonsters(ownerNum,name,description,houseid,adopttime,adoptip) VALUES ('".$_SESSION["username"]."','".$_POST["newname"]."','".$_POST["newdescription"]."','".mt_rand(1,3)."','".date('Y-m-d H:i:s',time())."','".$_SERVER["REMOTE_ADDR"]."')");
		$stmt->close();
		
		$_POST["monsterid"]=mysqli_insert_id($con);
		$con->close();
		header('Location: mainpage.php');
	}

?>