<?php
	require "phpfunction.php";

	checklogstatus();
	if(isset($_POST["timemode"])&&isset($_POST["outputcontent"])&&isset($_POST["daynumber"])){
		

		if($_POST["timemode"]=="hours"){
			$data=array(0,0,0,0,0,0,0,0,0,0,0,0);

		    $con = getconnection();

		    $stmt=runsql($con,"SELECT feedhistory.finishtime FROM s1425535.feedhistory,s1425535.bigmonsters,s1425535.smallmonsters
		         where datediff(curdate(),STR_TO_DATE(feedhistory.finishtime,'%Y-%m-%d %H:%i:%s')) <".$_POST["daynumber"]." and feedhistory.finished=1 and bigmonsters.id=smallmonsters.bigmonsterID
		            and smallmonsters.id=feedhistory.smallmonsterid and bigmonsters.ownerNum='".$_SESSION['username']."'");
		    $stmt->bind_result($finishtime);
		    while($stmt->fetch()){
		        $hour=floor(date("H",strtotime($finishtime))/2);
		        $data[$hour]++;
		    }
		    $stmt->close();
		    $con->close();
		    

		    $firstcolumn = array('0:00','2:00','4:00','6:00','8:00','10:00','12:00','14:00','16:00','18:00','20:00','22:00');

		    $firsttime=true;
		    foreach ($data as $key=>$value) {
		        if($firsttime){$firsttime=false; echo $firstcolumn[$key].",".($value*0.5).",".$value;}
		        else echo ";"$firstcolumn[$key].",".($value*0.5).",".$value;
		    }

		}

		if($_POST["timemode"]=="weekday"){
			$data=array(0,0,0,0,0,0,0);

		    $con = getconnection();

		    $stmt=runsql($con,"SELECT feedhistory.finishtime FROM s1425535.feedhistory,s1425535.bigmonsters,s1425535.smallmonsters
		         where datediff(curdate(),STR_TO_DATE(feedhistory.finishtime,'%Y-%m-%d %H:%i:%s')) <".$_POST["daynumber"]." and feedhistory.finished=1 and bigmonsters.id=smallmonsters.bigmonsterID
		            and smallmonsters.id=feedhistory.smallmonsterid and bigmonsters.ownerNum='".$_SESSION['username']."'");
		    $stmt->bind_result($finishtime);
		    // $datastring="";
		    while($stmt->fetch()){
		        // if(datastring="") $datastring+=$finishtime;
		        // $datastring+=","+$finishtime;
		        $data[date("w",strtotime($finishtime))]++;
		    }
		    $stmt->close();
		    $con->close();
		    // print_r($data);
		    echo "<script>var weekdays=['SUN','MON','TUE','WED','THU','FRI','SAT'];var visualdata=[";

		    $firsttime=true;
		    foreach ($data as $key=>$value) {
		        if($firsttime){$firsttime=false; echo "[weekdays[".$key."],".($value*0.5).",".$value."]";}
		        else echo ",[weekdays[".$key."],'".($value*0.5)."h',".$value."]";
		    }

		    echo "];</script>";
		}
	}
?>