<!DOCTYPE HTML>
<html>
<head>
	  <title>BaGr (Badge Generator)</title>
	  <link rel="stylesheet" type="text/css" href="style/style.css" title="style" />
</head>

<body>
  <div id="main">
	<div id="header">
	  <div id="logo">
		<div id="logo_text">
		  <h1><a href="index.html">BaGr (Badge Generator)<span class="logo_colour"></span></a></h1>
		</div>
	  </div>
	  <div id="menubar">
		<ul id="menu">
		  <li><a href="index.html">Home</a></li>
		  <li><a href="despre.html">Despre</a></li>
		  <li class="selected"><a href="creare.php">Creare</a></li>
		  <li><a href="contact.html">Contact Us</a></li>
		</ul>
	  </div>
	</div>
	<div>
			<br><br><button onclick="download()">Download</button><br><br><br>
	</div>
	<div id="output">
	<script>	
	   const output = document.getElementById("output");
	   let objects = [];
	   function init() {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function (){
				if(this.readyState == 4 && this.status == 200) {
					//console.log(this.responseText);
					objects = generateObjects(this.responseText);
					//console.log(JSON.stringify(objects));;
					generateView();
				}
			}
			xhttp.open("GET", "test.txt", true);
			xhttp.send();
		}

		generateObjects = (responseText) => {
			const lines = responseText.split("\n");
			return lines.map(lineRaw=>{
				 const line = lineRaw.split(',');
				 if(line.length !== 4){
					console.warn("Line error.");
					return undefined;
				 }

				 return {Nume: line[0], Prenume: line[1], Sex: line[2], Rol: line[3]};
			});
		}

		generateView = () => {
	  objects.forEach(object => generateCanvas(object))
	}

		generateCanvas = (line) => {
			if("<?php echo $_POST['format2']; ?>" == "portrait") {
			  const canvas = document.createElement("canvas");
			  output.appendChild(canvas);
			  const context = canvas.getContext("2d");
			  canvas.width  = 240;
			  canvas.height = 300;
			  context.fillStyle = '#fff';
			  context.fillRect(0, 0, canvas.width, canvas.height);
			  canvas.style="border:1px solid #000000;";
			  var grd = context.createLinearGradient(10,10,200,0);
			  grd.addColorStop(0,"#00BFFF");
			  context.lineWidth = 2;
			  context.fillStyle = grd;
			  context.fillRect(0,30,240,70);
			  context.font = "12px Comic Sans MS";
			  context.fillStyle = 'black';
			  context.strokeText("PASS", 100, 70);
			  context.font ="15px" + ' ' + "<?php echo $_POST['font2']; ?>";
			  context.fillStyle = "<?php echo $_POST['cul2']; ?>";
			  let pos = 180;
			  for (let key in line) {
					if (line.hasOwnProperty(key)) {
					  context.fillText(`${key.toUpperCase()}:`, 30, pos);
					  context.fillText(line[key], 150, pos);
					  pos += 20;
					}
			  }
			}
			else {
				const canvas = document.createElement("canvas");
			  output.appendChild(canvas);
			  const context = canvas.getContext("2d");
			  canvas.width  = 380;
			  canvas.height = 230;
			  context.fillStyle = '#fff';
			  context.fillRect(0, 0, canvas.width, canvas.height);
			  canvas.style="border:1px solid #000000;";
			  var grd = context.createLinearGradient(10,10,200,0);
			  grd.addColorStop(0,"#00BFFF");
			  context.lineWidth = 2;
			  context.fillStyle = grd;
			  context.fillRect(0,30,380,70);
			  context.font = "12px Comic Sans MS";
			  context.fillStyle = 'black';
			  context.strokeText("PASS", 170, 70);
			  context.font ="15px" + ' ' + "<?php echo $_POST['font2']; ?>";
			  context.fillStyle = "<?php echo $_POST['cul2']; ?>";
			  let pos = 130;
			  for (let key in line) {
					if (line.hasOwnProperty(key)) {
					  context.fillText(`${key.toUpperCase()}:`, 40, pos);
					  context.fillText(line[key], 160, pos);
					  pos += 20;
					}
			  }
			}
		}
	  generateView();
	  window.onload = init;
	</script>
	</div>
	<br>

	<script>
	function download(){
	//$zip = new ZipArchive;
	//$zip_name = 'ecusoane.zip';
	//$filesToZip = array();
	var images = document.getElementsByTagName("canvas");
	var srcList = [];
	var i = 0;

	var timer = setInterval(function(){
		if(images.length > i){
			var link = document.createElement("a");
			srcList.push(images[i].src);
			link.id = i;
			link.download = "ecuson"+i+".jpg";
			link.href = images[i].toDataURL("image/png").replace("image/png", "image/octet-stream");
			link.click();
			i++;
		} else {
			clearInterval(timer);
		}
	},1500);
	}
	</script>
   </div>
</body>
</html>