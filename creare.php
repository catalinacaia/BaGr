<?php
$row = 1;
if (($handle = fopen("test.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}

// cache DOM:
var container = document.getElementById('container');

function createSVGtemplate(nume, prenume, sex, rol) {
  var svgTemplate = '<svg width="500" height="300">' +
    '<rect x="50" y="20" rx="20" ry="20" width="250" height="250" style="fill:red;stroke:black;stroke-width:5;opacity:0.5" />' +
    '<text x="140" y="70" style="font-family: Times New Roman;font-size: 30px;stroke: #00ff00;fill: #0000ff;">' + 'Person:</text>' +
    '<text x="70" y="100" style="fill:black;">Nume: ' + nume + '</text>' +
    '<text x="70" y="130">Prenume: ' + prenume + ' </text>' +
    '<text x="70" y="160">Sex: ' + sex + ' </text>' +
	'<text x="70" y="160">Rol: ' + rol + ' </text>' +
    '</svg>';
  return document.createRange().createContextualFragment(svgTemplate)
}



function createTemplates(data) {
  let documentFragment = document.createDocumentFragment();
  for (let i = 0; i < data.length; i++) {
    let filledTemplate = createSVGtemplate(data[i].nume, data[i].prenume, data[i].sex, data[i].rol);
    documentFragment.appendChild(filledTemplate);
  };
  container.appendChild(documentFragment);
}

(function () {
  createTemplates(data)
}())

?>