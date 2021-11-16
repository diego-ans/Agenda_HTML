/*
DEBE DE EDITAR UNICAMENTE UNA LINEA, INVESTIGA COMO SIRVE EL CSV, Y COMO SE
HACE EL FORMATEO PARA QUE SEA CORRECTO Y NO HAYA ERRORES DE COMPATIBILIDAD

*/

function getData() {
    let title=document.getElementById("in-title").value;
    let hora=document.getElementById("in-hour").value;
    let desc=document.getElementById("in-text").value;

    let information=[title,hora,desc];

    return information;
}

function parseData (DataArray) {
    let title=DataArray[0];
    let hour=DataArray[1];
    let desc=DataArray[2];

    var finalResult="";

    title=title+"\n";
    hour=hour+"\n";
    desc=desc+"\n";
    
    finalResult=title+hour+desc;

    return finalResult;
}


function NewfileLine (title,hour,desc) {
    let DataArr=[title,hour,desc];
    var nw_Line=parseData(DataArr);
    
    
}

function Main() {

    var infoarray=getData();

    NewfileLine(infoarray[0],infoarray[1],infoarray[2]);
}