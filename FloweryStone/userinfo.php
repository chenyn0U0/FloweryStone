<div id="userbox">
	<a href="javascript:logout()">
		<div id="usertile">
			<img src="datavisualisation/nightowl.png" class="charalogo"/>
			<!-- <img src="datavisualisation/earlybird.png" class="charalogo" /> -->
		</div>
		<div id="userinfo">
			<p>Night Owl</p>
			<!-- <p>Early Bird</p> -->
			<p><?php echo $_SESSION['username']; ?></p>
		</div>
	</a>
	<form action="" method="POST">
	<input style="display:none" type="submit" name="logout" id="logout"/>
	</form>
</div>

