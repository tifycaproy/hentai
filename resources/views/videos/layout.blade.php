 
 <?php 
 //echo $url;

//echo $zurl;
 //echo html_entity_decode($url)?>



 <!DOCTYPE html>
<html lang="en" style="height: 100%">
<head>
	<meta charset="UTF-8">
	<title>AppHentai</title>
	<meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="cache-control" content="no-store" />
    <meta http-equiv="cache-control" content="must-revalidate" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	<script src="{{ asset('js/app.js') }}" type="text/javascript" charset="utf-8" async defer></script>
	<style type="text/css" media="screen">
		.nav > li > a{
			padding: 5px !important;
			font-size: 1rem;
		}
		.tab-pane,.tab-pane iframe{
			width: 100%;
			height: 100%;
		}
		.skip{
			background: #3097D1;
			color: white;
			padding: 8px;
			border-radius: 3px;
		}
		.skip:hover{
			text-decoration: none;
			color: white;
		
		}
		.d-none{
			display: none;
		}
	</style>
</head>
<body style="height: 100%; overflow: hidden;"  >

			<div id="banner" class="" style="position: absolute; text-align: center; width: 100%; height: 100%">
				<div class="col-xs-3"></div>
				<div class="col-xs-6" style="height: 100%" >
					<video onclick="window.open('https://www.hentaipros.com/landing/tgp3/?ats=eyJhIjoxNjM2NTQsImMiOjUyOTA5NjEwLCJuIjoyNSwicyI6MjI4LCJlIjo3NzY1LCJwIjoxMX0=','_blank');" class="img-responsive" autoplay="" loop="" poster="" src="https://animeidhentai.com/videos/hentai2.mp4" type="video/mp4" width="200" height="250" style="margin-top: auto; margin-bottom: auto; height: 100%; width: 100%"></video>
					<div class="" style="margin-top: -25%">
						<a class="skip" href="#" title="">Skip and play</a>
					</div>
				</div>
				<div class="col-xs-3"></div>
			</div>

			<ul class="nav nav-pills" style="position: absolute;">
				<li class="active"><a data-toggle="pill" href="#option1">Option 1</a></li>
				<li><a data-toggle="pill" href="#option2">Option 2</a></li>
			</ul>

			<div class="tab-content" style="height: 100%">
				<div id="option1" class="tab-pane fade in active">
					<!--<iframe src="//animeidhentai.com/player/anime.php?vid=780499863617&amp;eid=642654155" width="560" height="315" allowfullscreen="allowfullscreen" scrolling="no"></iframe>-->
					 
					 <?php echo $url;?>
				</div>
				<div id="option2" class="tab-pane fade">
					<!--<iframe src="//animeidhentai.com/player/anime.php?vid=780499863617&amp;eid=617832374" width="560" height="315" allowfullscreen="allowfullscreen"></iframe>-->
					<?php echo $zurl;?>
				</div>
			</div>
			
			<script  type="text/javascript" charset="utf-8" async defer>
				 $(document).ready(function(){
				 	$('.skip').click(function(){
				 		$('#banner').addClass('d-none');
				 	});
				 });
			</script>
</body>
</html>