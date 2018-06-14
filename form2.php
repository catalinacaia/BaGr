<form enctype="multipart/form-data" action="uploadtxt.php" method="POST">
    <p>Selectati fisierul cu datele pentru ecusoane (format acceptat .txt):</p>
    <input type="file" name="uploaded_file"></input><br />
    <input type="submit" value="Upload"></input>
 </form>
<form method="POST" autocomplete="off" action="crearecsv.php">
	<h3>Creaza ecusoane</h3>
	<label>
		Font ecuson:<br><div class="autocomplete" style="width:300px;">
								<input id="font2" type="text" name="font2" required value="">
				     </div><br><br>
		Format ecuson (portrait or landscape):<br><div class="autocomplete" style="width:300px;">
								<input id="format2" type="text" name="format2" required value="">
				       </div><br><br>
		Culoare text:<br><input id="cul2" type="color" name="cul2"><br>
		Culoare ecuson:<br><input type="color" name="cul3" id="cul3" value="<?php echo $search->cul3 ?>"><br><br>
		Culoare border PASS:<br><input type="color" name="cul4" id="cul4" value="<?php echo $search->cul4 ?>"><br><br>
		<input type="submit" value="Creare" name="submit"><br>
	</label>
</form>

<script>
	function autocomplete(inp, arr) {
	  /*functia de autocomplete are nevoie de 2 parametri,
	  elementul text field si un vector cu posibile variante de autocomplete*/
	  var currentFocus;
	  /*executa functia cand utilizatorul tasteaza in text field*/
	  inp.addEventListener("input", function(e) {
		  var a, b, i, val = this.value;
		  /*inchide posibilele liste cu valori de autocomplete deschise deja*/
		  closeAllLists();
		  if (!val) { return false;}
		  currentFocus = -1;
		  /*creaza un  element DIV care va contine elementele (values):*/
		  a = document.createElement("DIV");
		  a.setAttribute("id", this.id + "autocomplete-list");
		  a.setAttribute("class", "autocomplete-items");
		  /*adauga elementul DIV ca copil al containerului de autocomplete:*/
		  this.parentNode.appendChild(a);
		  /*pentru fiecare element din vector...*/
		  for (i = 0; i < arr.length; i++) {
			/*verifica daca elementul incepe cu aceleasi litere ca si valoarea text field-ului:*/
			if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
			  /*creaza un element DIV pentru fiecare element care se potriveste:*/
			  b = document.createElement("DIV");
			  /*aplica bold style la literele care se potrivesc:*/
			  b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
			  b.innerHTML += arr[i].substr(val.length);
			  /*insereaza un input field care va retine valorile elementelor curente ale vectorului:*/
			  b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
			  /*executa o functie atunci cand clientul da clic pe valoarea unui element din lista (elementul DIV):*/
			  b.addEventListener("click", function(e) {
				  /*insereaza valoarea selectata in text field:*/
				  inp.value = this.getElementsByTagName("input")[0].value;
				  /*inchide listele cu valori de autocomplete*/
				  closeAllLists();
			  });
			  a.appendChild(b);
			}
		  }
	  });
	  /*executa functia cand este apasata o tasta de la tastatura:*/
	  inp.addEventListener("keydown", function(e) {
		  var x = document.getElementById(this.id + "autocomplete-list");
		  if (x) x = x.getElementsByTagName("div");
		  if (e.keyCode == 40) {
			/*daca este apasata tasta sageata in jos, se incrementeaza valoarea variabilei currentFocus*/
			currentFocus++;
			/*face elementul curent mai vizibil:*/
			addActive(x);
		  } else if (e.keyCode == 38) { //up
			/*daca este apasata tasta sageata in sus, se decrementeaza valoarea variabilei currentFocus*/
			currentFocus--;
			/*face elementul curent mai vizibil:*/
			addActive(x);
		  } else if (e.keyCode == 13) {
			/*daca este apasata tasta ENTER, previne forularul sa fie submitted*/
			e.preventDefault();
			if (currentFocus > -1) {
			  /*simuleaza un click pe elementul selectat la apasarea tastei ENTER:*/
			  if (x) x[currentFocus].click();
			}
		  }
	  });
	  function addActive(x) {
		/*clasifica un element ca fiind "active":*/
		if (!x) return false;
		/*elimina clasa "active" pe toate elementele:*/
		removeActive(x);
		if (currentFocus >= x.length) currentFocus = 0;
		if (currentFocus < 0) currentFocus = (x.length - 1);
		/*adauga clasa "autocomplete-active":*/
		x[currentFocus].classList.add("autocomplete-active");
	  }
	  function removeActive(x) {
		/*elimina clasa "active" pentru toate elementele autocomplete:*/
		for (var i = 0; i < x.length; i++) {
		  x[i].classList.remove("autocomplete-active");
		}
	  }
	  function closeAllLists(elmnt) {
		/*inchide toate listele de autocomplete din document, cu exceptia celei transmise ca argument*/
		var x = document.getElementsByClassName("autocomplete-items");
		for (var i = 0; i < x.length; i++) {
		  if (elmnt != x[i] && elmnt != inp) {
			x[i].parentNode.removeChild(x[i]);
		  }
		}
	  }
	  document.addEventListener("click", function (e) {
		  closeAllLists(e.target);
		  });
	}

	/*vector care contine tipuri de font:*/
	var font = ["Arial","Bahnschrift","Bahnschrift Condensed","Bahnschrift Light","Calibri","Cambria","Candara","Comic Sans MS","Consolas","Constantia","Copperplate Gothic Bold","Corbel","DaunPenh","Courier new","Dotum","Estrangelo Edessa","Franklin Gothic Medium","Georgia","Gill Sans Nova","Impact","Lucinda console","Tahoma","Times New Roman","Palatino Linotype","Rockwell Nova","Trebuchet MS","Verdana"];
	/*vector care contine tipurile de format ale ecusonului:*/
	var format = ["landscape","portrait"];

	autocomplete(document.getElementById("font2"), font);
	autocomplete(document.getElementById("format2"), format);
</script>