<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Fredoka+One|Supermercado+One&display=swap" rel="stylesheet">

	<style type="text/css">
		body, html {
			margin: 0;
			padding: 0;
			height: 100%;
		}
		#container {
			background-image: url("bet_bg.png");
			height: 100%;
			background-repeat: no-repeat;
			background-size: cover;
		}
		table {
			height: 100%;
			width: 100%;
			vertical-align: middle;
			position: relative;
		}
		td {
			height: 100%;
			width: 50%;
			color : #fff;
			vertical-align: middle;
			text-align: center;
		}
		.heading {
			color: #B12534;
			font-family: 'Fredoka One';
			font-size: 41px;
		}
		#bn1, #bn2, #tn1, #tn2 {
			color: #fff;
			font-family: 'Supermercado One';
			font-size: 32px;
		}
	</style>
	
</head>
<body>
	<div id="container">
		<table><tr>
			<td>
				<span class="heading">BOT NAME</span>
				<br><span id='bn1'></span>
				<br><br><span class="heading">TEAM NAME</span>
				<br><span id='tn1'></span>
			</td>
			<td>
				<span class="heading">BOT NAME</span>
				<br><span id='bn2'></span>
				<br><br><span class="heading">TEAM NAME</span>
				<br><span id='tn2'></span>
			</td>
		</tr></table>
	</div>
	<button onclick="fullScreen();">Fullscreen Mode</button>

	<script>
		var elem = document.getElementById("container");

		function fullScreen() {
  			if (elem.requestFullscreen)
    			elem.requestFullscreen(); 
  			else if (elem.mozRequestFullScreen) /* Firefox */
    			elem.mozRequestFullScreen();
    		else if (elem.webkitRequestFullscreen) /* Chrome, Safari and Opera */
    			elem.webkitRequestFullscreen();
  			else if (elem.msRequestFullscreen) /* IE/Edge */
    			elem.msRequestFullscreen();
  		}

  		function getTagValue(txt, tag) {
			var ar = "";
			var read = false;

			for (var i = 0; i < txt.length-tag.length-1; i++) {
				if (!read && txt.substr(i, tag.length+2) == "<"+tag+">") {
					read = true;
					i+=tag.length+2;
				}
				if (read) {
					if (txt.substr(i, tag.length+3) == "</"+tag+">") {
						return ar;
					}
					else {
						ar += txt.substr(i, 1);
					}
				}
			}
			return ar;
		}

  		setInterval(function() {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
	   			if (this.readyState == 4 && this.status == 200) {
	   				receivedText(this);
	   			}
  			};
			xhttp.open("GET", "info.txt", true);
			xhttp.send();
		}, 500);

		function receivedText(txt) {
			var txtDoc = txt.responseText;
			var b1 = getTagValue(txtDoc, "bot1");
			var b2 = getTagValue(txtDoc, "bot2");
			var t1 = getTagValue(txtDoc, "team1");
			var t2 = getTagValue(txtDoc, "team2");

			document.getElementById("bn1").innerHTML = b1;
			document.getElementById("bn2").innerHTML = b2;
			document.getElementById("tn1").innerHTML = t1;
			document.getElementById("tn2").innerHTML = t2;
		}
	</script>

</body>
</html>