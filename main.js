//Esta funcion sirve para leer y
//cargar los elementos de un archivo csv a una tabla html

function Upload() {
    var fileUpload = document.getElementById("fileupload");
    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt)$/;

    if (regex.test(fileUpload.value.toLowerCase())){
    
        if (typeof (FileReader) != "undefined"){
            var reader = new FileReader();
            reader.onload = function (e){
                var table = document.createElement("table");
                var rows = e.target.result.split("\n");

                for (var i = 0; i < rows.length; i++){
                    var cells = rows[i].split(",");

                    if (cells.length > 1){
                        var row = table.insertRow(-1);

                        for (var j = 0; j < cells.length; j++){
                            var cell = row.insertCell(-1);
                            cell.innerHTML = cells[j];
                        }
                    }
                }

                var dvCSV = document.getElementById("dvCSV");
                dvCSV.innerHTML = "";
                dvCSV.appendChild(table);
            }
            reader.readAsText(fileUpload.files[0]);
        } else {
            alert("El navegador no soporta html 5");
        }
    } else {
        alert("Formato de archivo no valido.");
    }
}