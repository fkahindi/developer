<nav class="navbar navbar-inverse" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header navb-left">	
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>                        
			</button>
			<a class="navbar-brand" href="/spexproject/index.php">Spex Solutions</a>
		</div>	
		<div class="collapse navbar-collapse" id="myNavbar">
			<div class=" nav navbar-nav navbar-right">
				<span><?php echo $_SESSION['username']?></span><br>
				<a href="/spexproject/includes/logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a>
			</div>
		</div>
	</div>			
</nav>