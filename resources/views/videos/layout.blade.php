 
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
	<script src="{{ asset('js/jquery-3.2.1.min.js') }}" type="text/javascript" charset="utf-8" async defer></script>
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
		#danner{
			width: 100%;
		}
	</style>
</head>
<body style="height: 100%; "  >

			<ul class="nav nav-pills col-xs-12" style="position: absolute;">
				<li class="active"><a data-toggle="pill" href="#option1">Option 1</a></li>
				<li><a data-toggle="pill" href="#option2">Option 2</a></li>
			</ul>

			<div id="banner" class="" style="position: absolute; text-align: center; width: 100%; height: 100%; padding-top: 10px">
				<div class="" style="" >
					<iframe width="300" scrolling="no" height="250" frameborder="0" src="https://ads2.contentabc.com/ads?spot_id=6564695&rand=1492893455" allowtransparency="true" marginheight="0" marginwidth="0" name="spot_id_6564695"> </iframe>
					<div class="" style="margin-top: 10px">
						<a class="skip" href="#" title="">Skip and play</a>
					</div>
				</div>
					
			</div>

			<div class="tab-content" style="height: 100%">
				<div id="option1" class="tab-pane fade in active">
					{{-- <iframe src="//animeidhentai.com/player/anime.php?vid=780499863617&amp;eid=642654155" width="560" height="315" allowfullscreen="allowfullscreen" scrolling="no"></iframe> --}}
					<?php echo $url;?>
				</div>
				<div id="option2" class="tab-pane fade">
					{{-- <iframe src="//animeidhentai.com/player/anime.php?vid=780499863617&amp;eid=617832374" width="560" height="315" allowfullscreen="allowfullscreen"></iframe> --}}

					<?php echo $zurl;?>
				</div>
			</div>
			
			<script  type="text/javascript" charset="utf-8">
				 window.onload = function(){
				 	$('.skip').click(function(){
				 		//$('#banner').addClass('d-none');
				 		$( "#banner" ).remove();
				 	});
				 }
			</script>
</body>
</html>