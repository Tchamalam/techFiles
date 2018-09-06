<header id="tg-header" class="tg-header">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<strong class="tg-logo"><a href="index.php"><img src="images/logo.png" alt="Tech'n Roll"></a></strong>
				<div class="tg-navigationarea">

					  <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="tg-btn tg-btnbecommember">
					    <b class="bletter">BAŞVURU YAP</b>
					    <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu" aria-labelledby="dLabel">
					    <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSdIDLha_KYNyDy1tzZTfpkAz6e9TQf0vNjxdvzGjz9Nw8ozNQ/viewform" target="_blank">Bireysel Başvuru</a></li>
					    <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSeIgEYTrDJkXNqaFBYCC8Z3YpXQs_8E9oZi8OCyG10_NuXdRA/viewform" target="_blank">Startup Başvurusu</a></li>
					  </ul>

					<nav id="tg-nav" class="tg-nav">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tg-navigation" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div id="tg-navigation" class="collapse navbar-collapse tg-navigation">
							<ul>
								<? if($page == 2){ ?>
									<li><a href="index.php" onclick="window.location.href='index.php#body'">Anasayfa</a></li>
									<li class="tg-active"><a href="javascript:void(0)">Tech’n Roll Nedir?</a></li>
									<li><a href="index.php#tg-schedule" onclick="window.location.href='index.php#tg-schedule'">Program</a></li>
									<li><a href="index.php#sss" onclick="window.location.href='index.php#sss'">SSS</a></li>
									<li><a href="index.php#tg-sponsers" onclick="window.location.href='index.php#tg-sponsers'">Sponsorlar</a></li>
									<li><a href="index.php#tg-venue" onclick="window.location.href='index.php#tg-venue'">İletişim</a></li>
								<? } else { ?>
									<li class="tg-active"><a href="#body">Anasayfa</a></li>
									<li><a href="#whattechnroll">Tech’n Roll Nedir?</a></li>
									<li><a href="#tg-schedule">Program</a></li>
									<li><a href="#sss">SSS</a></li>
									<li><a href="#tg-sponsers">Sponsorlar</a></li>
									<li><a href="#tg-venue">İletişim</a></li>
								<? } ?>
							</ul>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</div>
</header>