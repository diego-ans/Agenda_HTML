function send(){
    var xhr = new XMLHttpRequest();
    xhr.open("POST","pos-html.php");
    xhr.onload=function(){
        var jsvar=this.response;
        console.log(jsvar)
        //document.getElementById("ERROR").innerHTML=jsvar;
    }
xhr.send();
} //NO ESTA ACTIVA