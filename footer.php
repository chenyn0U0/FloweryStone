<?php
$sqlbm_all="SELECT bigmonsters.adopttime,bigmonsters.finishedtime FROM s1425535.bigmonsters WHERE bigmonsters.ownerNum='".$_SESSION['username']."'";
$sqltask="SELECT feedhistory.starttime,feedhistory.finished FROM s1425535.feedhistory,s1425535.bigmonsters,s1425535.smallmonsters
	             where bigmonsters.id=smallmonsters.bigmonsterID 
	             and smallmonsters.id=feedhistory.smallmonsterid and bigmonsters.ownerNum='".$_SESSION['username']."'";
$sqlsm_all="SELECT smallmonsters.adopttime,smallmonsters.finishedtime FROM s1425535.smallmonsters,s1425535.bigmonsters
	             where bigmonsters.id=smallmonsters.bigmonsterID and bigmonsters.ownerNum='".$_SESSION['username']."'";

$piefinishtotal=0;
$piedroppedwithin3days=0;
$piefinishwithin7days=0;
$piefinishwithin30days=0;

$smfinishtotal=0;
$smamount=0;
$smamount_finishwithin30day=0;
$smavertotalfinishedtime=0;;

$bmfinishtotal=0;
$bmamount=0;
$bmamount_finishwithin30day=0;
$bmavertotalfinishedtime=0;





	$footercon=getconnection();

	$footerstmt=runsql($footercon,$sqlbm_all);
	$footerstmt->bind_result($starttime,$finishtime);
	while($footerstmt->fetch()){
		$bmamount++;
		if($finishtime!=""){
			$bmfinishtotal++;
			$bmstart=strtotime($starttime);
			$bmfinish=strtotime($finishtime);
			$finishtakedays=($bmfinish-$bmstart)/(24*60*60);
			$bmavertotalfinishedtime+=$finishtakedays;
			if($finishtakedays<=31){
				$bmamount_finishwithin30day++;
			}
		}
	}

if($bmfinishtotal!=0) $bmaveraveragefinishedtime=$bmavertotalfinishedtime/$bmfinishtotal;
else $bmaveraveragefinishedtime=0;
	$footerstmt->close();

	$footerstmt=runsql($footercon,$sqlsm_all);
	$footerstmt->bind_result($starttime,$finishtime);
	while($footerstmt->fetch()){
		$smamount++;
		if($finishtime!=""){
			$smfinishtotal++;
			$smstart=strtotime($starttime);
			$smfinish=strtotime($finishtime);
			$finishtakedays=($smfinish-$smstart)/(24*60*60);
			$smavertotalfinishedtime+=$finishtakedays;
			if($finishtakedays<=31){
				$smamount_finishwithin30day++;
			}
		}
	}

if($smfinishtotal!=0) $smaveraveragefinishedtime=$smavertotalfinishedtime/$smfinishtotal;
else $smaveraveragefinishedtime=0;

	$footerstmt->close();


	$footerstmt=runsql($footercon,$sqltask);
	$footerstmt->bind_result($starttime,$finishornot);
	while($footerstmt->fetch()){
		$piestart=strtotime($starttime);
		$now=time();
		$finishtakedays=($now-$piestart)/(24*60*60);
		if($finishtakedays<=3){
			if($finishornot=="0"){
				$piedroppedwithin3days++;
			}
		}
		if($finishtakedays<=7){
			if($finishornot=="1"){
				$piefinishwithin7days++;
			}
		}
		if($finishtakedays<=30){
			if($finishornot=="1"){
				$piefinishwithin30days++;
			}
		}
		if($finishornot=="1"){
			$piefinishtotal++;
		}
	}
	$footerstmt->close();




	$footercon->close();

if($smamount!=0)
$monshappy=$smfinishtotal/$smamount;
else $monshappy=0;

?>

<div class="footer">
	<div id="monsfinished">

<?php
	if(isset($thispage)){
		if($thispage=="mainpage"){
			if($piefinishwithin7days>40){
?>
		<img src="img/Improve/awardmons.png" id="footerhardworking" title="These days are my hard-working day!" width="123px" />
<?php
			}
			if($monshappy>0.5){
?>
		<img src="img/Improve/monshouse.png" id="footermonshouse" title="Happy Family: We are haaaappy!~" />
<?php
			}
			if($piefinishwithin30days>=30){
?>
		<img src="img/Improve/finishpizza1.png" id="taskover10" title="Task Crowd! (LEVEL 1): You have worked more than 15 hours during the last month" />
<?php
			}
			if($piefinishwithin30days>=90){
?>
		<img src="img/Improve/finishpizza2.png" id="taskover20" title="Task Crowd! (LEVEL 2): You have worked more than 45 hours during the last month" />


<?php
			}
			if($bmaveraveragefinishedtime<=20){
?>
		<img src="datavisualisation/clock.png" id="clock" title="Spped Badge: It takes you less than 20 days for a project!" />
<?php
			}
			if($bmamount_finishwithin30day>=3){
?>
		<img src="datavisualisation/champion.png" id="champion" title="Award Badge: You have finished more than three big projects in one month!"/>

<?php
			}



		}

		$ten=floor($bmfinishtotal/10);
		$ge=$bmfinishtotal%10;
		if($ge==1||$ge==4||$ge==6||$ge==9){
?>
		<img src="img/Improve/1p.png" id="footerp1" class="footermonsters"/>
<?php 
		}
		if($ge==2||$ge==3||$ge==4||$ge==7||$ge==8||$ge==9){
?>
		<img src="img/Improve/2p.png" id="footerp2" class="footermonsters"/>
<?php 
		}
		if($ge==5||$ge==6||$ge==7||$ge==8||$ge==9){
?>
		<img src="img/Improve/5p.png" id="footerp5"  class="footermonsters"/>
<?php 
		}
		if($ge==3||$ge==4||$ge==8||$ge==9){
?>
		<img src="img/Improve/1p.png" id="footerp3" class="footermonsters"/>
<?php 
		}
		if($ten>0){
?>
		<div  id="footerp10">
		<img src="img/Improve/10p.png" height="100px"/>
		<p id="multi10">
			<?php
				if($ten>=2) echo "× ".$ten;
			?>
		</p>
		</div>
<?php 
		}
		if($piedroppedwithin3days>5){
?>
	 	<img src="img/Improve/cryingmon.png" id="footerabandon" title="Why always abandon me?" width="80px" />
<?php
		}
	}
?>



	</div>
	<div id="teamlogo">
		<img src="img/team.png"/>
	</div>
</div>