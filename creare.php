<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
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
	<div id="site_content">
	<div id="banner"></div>
	<!--Formular de completare date-->
	<div id="wrapper">
	<div class="row">
	<div class="column">

	<?php
	session_start();

	$search = parseRequest();
	storeSearch($search);

	include "form.php";

	$searches = $_SESSION['searches'];


	function storeSearch($search) {
		if (!isset($_SESSION['searches'])) {
			$_SESSION['searches'] = [];
		}

	if (!$search->isEmpty() && !in_array($search,$_SESSION['searches'])) {
			$_SESSION['searches'][] = $search;
		}
	}


	function parseRequest() {
		$search = new SearchRequest;
		$search->nume = !empty($_GET['nume']) ? $_GET['nume'] : "";
		$search->prenume = !empty($_GET['prenume']) ? $_GET['prenume'] : "";
		$search->sex = !empty($_GET['sex']) ? $_GET['sex'] : "";
		$search->rol = !empty($_GET['rol']) ? $_GET['rol'] : "";
		$search->cul = !empty($_GET['cul']) ? $_GET['cul'] : "";
		$search->cul1 = !empty($_GET['cul1']) ? $_GET['cul1'] : "";
		$search->cul2 = !empty($_GET['cul2']) ? $_GET['cul2'] : "";
		$search->font = !empty($_GET['font']) ? $_GET['font'] : "";
		$search->format = !empty($_GET['format']) ? $_GET['format'] : "";
		return $search;
	}

	/**
	 * search request
	 */
	class SearchRequest
	{
		public $nume = "";
		public $prenume = "";
		public $sex = "";
		public $rol = "";
		public $cul = "";
		public $cul1 = "";
		public $cul2 = "";
		public $font = "";
		public $format = "";

		function toQueryString() {
			$params = [
					'nume' => $this->nume,
					'prenume' => $this->prenume,
					'sex' => $this->sex,
					'rol'=> $this->rol,
					'cul'=> $this->cul,
					'cul1'=> $this->cul1,
					'cul1'=> $this->cul2,
					'font'=> $this->font,
					'format'=> $this->format
			];

			return http_build_query($params);
		}

		function isEmpty() {
			return !$this->nume || !$this->prenume || !$this->sex || !$this->rol || !$this->cul  || !$this->cul1 || !$this->cul2 || !$this->font || !$this->format;
		}
		
		function numeAsObject() {
			return new DateTime($this->nume);
		}

		function prenumeAsObject() {
			return new DateTime($this->prenume);
		}
	
		function sexAsObject() {
			return new DateTime($this->sex);
		}
		
		function rolAsObject() {
			return new DateTime($this->rol);
		}
		
		function culAsObject() {
			return new DateTime($this->cul);
		}
		
		function cul1AsObject() {
			return new DateTime($this->cul1);
		}
		
		function cul2AsObject() {
			return new DateTime($this->cul2);
		}
		
		function fontAsObject() {
			return new DateTime($this->font);
		}
		
		function formatAsObject() {
			return new DateTime($this->format);
		}

	}

	?>
	</div>
	<div class="column">
	<ul>
		<?php
		foreach ($searches as $s) {
		?>
		 <li><a href="creare.php?<?php echo $s->toQueryString() ?>">
				<?php echo $s->nume?> - <?php echo $s->prenume?> - <?php echo $s->sex?> - <?php echo $s->rol?> - <?php echo $s->cul?> - <?php echo $s->cul1?> - <?php echo $s->cul2?> - <?php echo $s->font?> - <?php echo $s->format?>
			  </a></li>
		<?php
		}
		?>
	</ul>
	</div>

	</div>
	<br><br>

	<!--Formular incarcare logo-->
	<form action="uploadimg.php" method="post" enctype="multipart/form-data">
		Selectati logo (format acceptat .png):
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type="submit" value="Upload Logo" name="submit">
	</form>
	<br><br>
		

	<!--Afisarea ecusonului-->

	<canvas id="canvas1" width="250" height="330" style="border:1px solid #000000;">
	</canvas>
	<br><br><br>
	<button onclick="stergedate()">Creaza alt ecuson</button>
	<button onclick="SaveEcuson1()">Descarca Ecuson</button>
	<button type="button" onclick="incarcalogo1()">Incarca Logo</button>
	<br><br><br><br>

	<canvas id="canvas2" width="380" height="250" style="border:1px solid #000000;">
	</canvas>
	<br><br>
	<button onclick="stergedate()">Creaza alt ecuson</button>
	<button onclick="SaveEcuson2()">Descarca Ecuson</button>
	<button type="button" onclick="incarcalogo2()">Incarca Logo</button>


	</div>

	<!--Functia de incarcare a logo-ului in canvas portrait-->
	<script>
	var canvas = document.getElementById('canvas1'),
	context1 = canvas.getContext('2d');

	function incarcalogo1()
	{
	  logo_image = new Image();
	  logo_image.src = 'uploads/logo.png';
	  logo_image.onload = function(){
	  context1.drawImage(logo_image, 10, 10, 40, 40);
	  }
	}
	</script>

	<!--Functia de incarcare a logo-ului in canvas landscape-->
	<script>
	var canvas = document.getElementById('canvas2'),
	context2 = canvas.getContext('2d');

	function incarcalogo2()
	{
	  logo_image = new Image();
	  logo_image.src = 'uploads/logo.png';
	  logo_image.onload = function(){
	  context2.drawImage(logo_image, 10, 10, 40, 40);
	  }
	}
	</script>

	<!--Functia de salvare a ecusonului portrait-->
	<script>
	function SaveEcuson1() {
			var link = document.createElement('a');
					link.download = "ecuson.jpg";
					link.href = canvas1.toDataURL("image/png").replace("image/png", "image/octet-stream");
					link.click();
				  }
	</script>

	<!--Functia de salvare a ecusonului landscape-->
	<script>
	function SaveEcuson2() {
			var link = document.createElement('a');
					link.download = "ecuson.jpg";
					link.href = canvas2.toDataURL("image/png").replace("image/png", "image/octet-stream");
					link.click();
				  }
	</script>

	<!--Sterge datele din ecuson pentru a se putea crea altul-->
	<script>
	function stergedate() {
		location.reload();
	}
	</script>

	<!--Creaza ecusonul landscape-->
	<script>
	//var c = document.getElementById("canvas2");
	//var context = c.getContext("2d");
	//context.fillStyle = '#fff';
	//context.fillRect(0, 0, 380, 250);
	// Create gradient
	//var grd = context.createLinearGradient(10,10,200,0);
	//grd.addColorStop(0,"#00BFFF");
	//context.lineWidth = 2;
	// Fill with gradient
	//context.fillStyle = grd;
	//context.fillRect(0,40,380,70);
	</script>

	<!--Completeaza datele in ecuson-->
	<script>
	function create() {

		var canvas1 = document.getElementById("canvas1");
		var context1 = canvas1.getContext("2d");
		var canvas2 = document.getElementById("canvas2");
		var context2 = canvas2.getContext("2d");
	   
	   if(document.getElementById("format").value == "portrait") {
		    context1.fillStyle = document.getElementById("cul1").value;
			context1.fillRect(0, 0, 250, 330);
			var grd = context1.createLinearGradient(10,10,200,0);
			var cul2 = document.getElementById("cul2").value;
			grd.addColorStop(0, cul2);
			context1.fillStyle = grd;
			context1.fillRect(0,60,250,70);
			context1.lineWidth = 2;
		    context1.fillStyle = document.getElementById("cul").value;
			context1.font ="30px" + ' ' + document.getElementById("font").value;
			context1.fillText("PASS", 90, 110);
			context1.font ="15px" + ' ' + document.getElementById("font").value;
			context1.fillText("Nume: ", 30, 190);
			context1.fillText(document.getElementById("nume").value, 150, 190);
			context1.fillText("Prenume: ", 30, 210);
			context1.fillText(document.getElementById("prenume").value, 150, 210);
			context1.fillText("Sex: ", 30, 230);
			context1.fillText(document.getElementById("sex").value, 150, 230);
			context1.fillText("Rol: ", 30, 250);
			context1.fillText(document.getElementById("rol").value, 150, 250);}
		  else {
			 context2.fillStyle = document.getElementById("cul1").value;
			 context2.fillRect(0, 0, 380, 250);
			 var grd = context2.createLinearGradient(10,10,200,0);
			 var cul2 = document.getElementById("cul2").value;
			 grd.addColorStop(0, cul2);
			 context2.fillStyle = grd;
			 context2.fillRect(0,40,380,70);
			 context2.lineWidth = 2;
			 context2.fillStyle = document.getElementById("cul").value;
			 context2.font ="30px" + ' ' + document.getElementById("font").value;
			 context2.fillText("PASS", 140, 85);
			 context2.font ="15px" + ' ' +  document.getElementById("font").value;
			 context2.fillText("Nume: ", 40, 150);
			 context2.fillText(document.getElementById("nume").value, 160, 150);
			 context2.fillText("Prenume: ", 40, 170);
			 context2.fillText(document.getElementById("prenume").value, 160, 170);
			 context2.fillText("Sex: ", 40, 190);
			 context2.fillText(document.getElementById("sex").value, 160, 190);
			 context2.fillText("Rol: ", 40, 210);
			 context2.fillText(document.getElementById("rol").value, 160, 210);}
	}
	</script>
	<br><br><br><br>
	<?php
	include "form2.php";
	?>
	</div>
	</div>
</body>
</html>
