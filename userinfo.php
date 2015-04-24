<?php
	$bird=0;
	$owl=0;
	$headercon=getconnection();
	$sql="SELECT feedhistory.finishtime FROM s1425535.feedhistory,s1425535.bigmonsters,s1425535.smallmonsters
             where feedhistory.finished=1 and bigmonsters.id=smallmonsters.bigmonsterID
                and smallmonsters.id=feedhistory.smallmonsterid and bigmonsters.ownerNum='".$_SESSION['username']."'";
	$headerstmt=runsql($headercon,$sql);
	$headerstmt->bind_result($finishtime);
	while($headerstmt->fetch()){

		$hour=date("H",strtotime($finishtime));
		if($hour>=19||$hour<7) $owl++;
		else $bird++;

	}
	$headerstmt->close();
	$headercon->close();
	if($bird==$owl){
		$nowhour=date("H",time());

		if($nowhour>=19||$nowhour<7) $owl++;
		else $bird++;
	}
?>


<div id="userbox">
	<a href="javascript:logout()">
		<div id="usertile">
			<?php 
				if($bird>$owl){
			?>
			<img src="datavisualisation/earlybird.png" class="charalogo" />
			<?php 
				}
				else{
			?>
			<img src="datavisualisation/nightowl.png" class="charalogo"/>
			<?php 
				}
			?>
		</div>
		<div id="userinfo">
			<p>
				<?php 
				if($bird>$owl){
					echo "Hi, Early Bird!";
				}
				else{
					echo "Hi, Night Owl!";
				}
				?> 
			</p>
			<p><?php echo $_SESSION['username']; ?></p>
		</div>
	</a>
	<form action="" method="POST">
	<input style="display:none" type="submit" name="logout" id="logout"/>
	</form>
</div>

