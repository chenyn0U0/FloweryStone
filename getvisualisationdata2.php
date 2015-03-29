<?php
	require "phpfunction.php";

	checklogstatus();

	$taskfinished=getfinishedtimearray("SELECT smallmonsters.finishedtime FROM s1425535.bigmonsters,s1425535.smallmonsters
	         where smallmonsters.finished=1 and bigmonsters.id=smallmonsters.bigmonsterID and bigmonsters.ownerNum='".$_SESSION['username']."'");
	$pieconsumption=getfinishedtimearray("SELECT feedhistory.finishtime FROM s1425535.feedhistory,s1425535.bigmonsters,s1425535.smallmonsters
	         where feedhistory.finished=1 and bigmonsters.id=smallmonsters.bigmonsterID
	            and smallmonsters.id=feedhistory.smallmonsterid and bigmonsters.ownerNum='".$_SESSION['username']."'");
	$projectcreated=getfinishedtimearray("SELECT bigmonsters.adopttime FROM s1425535.bigmonsters
	         where bigmonsters.ownerNum='".$_SESSION['username']."'");
	$piedroped=getfinishedtimearray("SELECT feedhistory.starttime FROM s1425535.feedhistory,s1425535.bigmonsters,s1425535.smallmonsters
	         where feedhistory.finished=0 and bigmonsters.id=smallmonsters.bigmonsterID
	            and smallmonsters.id=feedhistory.smallmonsterid and bigmonsters.ownerNum='".$_SESSION['username']."'");


    $dataarray= array('taskfinished' => $taskfinished,'pieconsumption'=>$pieconsumption,'projectcreated'=>$projectcreated,'piedroped'=>$piedroped);
    echo "<script>alldata=".json_encode($dataarray)."</script>";



    function getfinishedtimearray($sql){
    	$finishtimearray=array();
	    $con = getconnection();

	    $stmt=runsql($con,$sql);
	    $stmt->bind_result($finishtime);

	    while($stmt->fetch()){
	    	$finishtimearray[count($finishtimearray)]=$finishtime;
	    }
	    $stmt->close();
	    $con->close();
	    return $finishtimearray;
    }
?>