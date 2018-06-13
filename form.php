<form method="get" autocomplete="off">
	<h3>Creaza ecuson</h3>
	<label>
		Nume:<br><input type="text" name="nume" id="nume" required value="<?php echo $search->nume ?>"><br>
		Prenume:<br><input type="text" name="prenume" id="prenume" required value="<?php echo $search->prenume ?>"><br>
		Sex:<br><div class="autocomplete" style="width:300px;">
								<input id="sex" type="text" name="sex" required value="<?php echo $search->sex ?>">
				     </div><br><br>
		Rol:<br><div class="autocomplete" style="width:300px;">
								<input id="rol" type="text" name="rol" required value="<?php echo $search->rol ?>">
				     </div><br><br>
		Culoare text:<br><input type="color" name="cul" id="cul" value="<?php echo $search->cul ?>"><br><br>
		Font ecuson:<br><div class="autocomplete" style="width:300px;">
								<input id="font" type="text" name="font" required value="<?php echo $search->font ?>">
				     </div><br><br>
		Format ecuson (portrait or landscape):<br><div class="autocomplete" style="width:300px;">
								<input id="format" type="text" name="format" required value="<?php echo $search->format ?>">
				       </div><br><br>
	</label>
	<input type="submit" name="history" value="History" />
	<button type="button" onclick="create()">Creaza</button><br><br>
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
	/*vector care contine tipuri de gender:*/
	var sex = ["feminin","masculin"];
	/*vector care contine posibile roluri:*/
	var rol = ["Vizitator","Stagiar","Personal administrativ","Participant","Invitat special","Profesor","Student","Elev"];

	autocomplete(document.getElementById("font"), font);
	autocomplete(document.getElementById("format"), format);
	autocomplete(document.getElementById("sex"), sex);
	autocomplete(document.getElementById("rol"), rol);
</script>