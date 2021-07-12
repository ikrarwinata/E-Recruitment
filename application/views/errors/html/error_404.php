<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>
<base href="<?php echo config_item('base_url'); ?>">
<script>
	addEventListener("load", function () {
		setTimeout(hideURLbar, 0);
	}, false);

	function hideURLbar() {
		window.scrollTo(0, 1);
	}
</script>

<!-- Stylesheets -->
<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
<!--// Stylesheets -->
</head>
<body>
	<header>
		<h1 class="text-center"><?php echo $heading; ?></h1>
	</header>
	<div id="container" style="text-align: center">
		<svg  x="0px" y="0px" viewBox="0 0 200 82.7"
		    style="enable-background:new 0 0 200 82.7;" xml:space="preserve">

			<g id="Calque_1">
				<text id="XMLID_3_" transform="matrix(1.2187 0 0 1 13 75.6393)" class="st0 st1">4</text>
				<text id="XMLID_4_" transform="matrix(1.2187 0 0 1 133.0003 73.6393)" class="st0 st1">4</text>
			</g>
			<g id="Calque_2">
				<g>
					<path id="XMLID_11_" d="M81.8,29.2c4.1-5.7,10.7-9.4,18.3-9.4c6.3,0,12.1,2.7,16.1,6.9c0.6-0.4,1.1-0.7,1.7-1.1
		c-4.4-4.8-10.8-7.9-17.8-7.9c-8.3,0-15.6,4.2-20,10.6C80.7,28.5,81.3,28.8,81.8,29.2z" />
					<path id="XMLID_2_" d="M118.1,53.7c-4,5.7-10.7,9.5-18.2,9.5c-6.3,0-12.1-2.6-16.2-6.8c-0.6,0.4-1.1,0.7-1.7,1.1
		c4.4,4.8,10.8,7.8,17.9,7.8c8.3,0,15.6-4.3,19.9-10.7C119.2,54.5,118.6,54.1,118.1,53.7z" />
					<animateTransform attributeName="transform" type="rotate" from="360 100 41.3" to="0 100 41.3" dur="10s" repeatCount="indefinite"
					/>
				</g>
				<g id="XMLID_6_">
					<g id="XMLID_18_">
						<circle class="circle" cx="100" cy="41" r="1"></circle>
					</g>
				</g>
				<defs>
					<filter id="blurFilter4" x="-20" y="-20" width="200" height="200">
						<feGaussianBlur in="SourceGraphic" stdDeviation="2" />
					</filter>
				</defs>
				<path id="XMLID_5_" class="st2" d="M103.8,16.7c0.1,0.3,0.1,0.6,0.1,0.9c11.6,1.9,20.4,11.9,20.4,24.1c0,13.5-10.9,24.4-24.4,24.4
  S75.6,55.1,75.6,41.7c0-3.2,0.6-6.3,1.7-9.1c-0.3-0.2-0.5-0.3-0.7-0.5c-1.2,3-1.9,6.2-1.9,9.6c0,14,11.3,25.3,25.3,25.3
  s25.3-11.3,25.3-25.3C125.3,29,115.9,18.5,103.8,16.7z" />
			</g>
		</svg>
		<div class="message">
			<strong><?php echo $message; ?></strong>
		</div>
		<div class="message" style="background-color: gray; opacity: 0.6; min-height: 25px; height: 25px; min-width: 250px; width: 250px; vertical-align: middle; border-radius: 25px; padding: 5px" align="center">
			<a href="home">Back to home</a>
		</div>
	</div>
	<!--copyright-->
	<div class="copy-wthree">
		<p>© <?php echo date("Y") ?> 5H0UT5. All Rights Reserved | Design by
			<a href="http://w3layouts.com/" target="_blank">W3layouts</a>
		</p>
	</div>
	<!--//copyright-->
</body>
</html>