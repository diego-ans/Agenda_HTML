<?php

    function NEW_CSV(array $Data, string $CSVfilename){
        $file=fopen($CSVfilename.".csv","w");
        
        foreach($Data as $field){ 
            fputcsv($file,$field);
        }
        fclose($file);
    }



    function joinFiles(array $files, $result) {
        #requiere un array de archivos, y un tercer archivo para escribir los datos

        #lo que hace es leer una linea a la vez de un archivo hasta que acabe
        #y la escribe en el archivo resultado
        #hace esto con todos los files que esten en el array
        if(!is_array($files)) {
            throw new Exception('los archivos deben de estar en un array');
        }

        $wH = fopen($result, "w+");

        foreach($files as $file) {
            $fh = fopen($file, "r");
            while(!feof($fh)) {
                fwrite($wH, fgets($fh)); #Lee una linea a la vez y la escribe
            }
            fclose($fh);
            unset($fh); #unset sirve para desmarcar la variable
            fwrite($wH, "\n");
        }
        fclose($wH);
        unset($wH);
    }

    #AQUI COMIENZA TODO #####################################

    $user = $_POST["user"]; #el user es el metodo de identificacion
    $user=strtolower($user);

    $task = $_POST["title"];
    $hour = $_POST["hour"];
    $desc = $_POST["desc"];

    if($user =="" || $task =="" || $hour==""){
        echo "Llena todos los campos";
    }


    $NW_DATA=array(array($task,$desc,$hour));
    NEW_CSV($NW_DATA,"temp");


    #si el archivo con el nombre de la var user existe
    #se le agregan los datos ya conseguidos con post

    #sino, se crea un archivo con ese nuevo usuario y
    #se agregan los datos
    if(file_exists($user.".csv")==true){
        file_put_contents("TEMPORAL.csv","");
        copy("$user.csv","TEMPORAL.csv");
        unlink($user.".csv");


        joinFiles(array("TEMPORAL.csv","temp.csv"),$user.".csv");
        unlink("temp.csv");
        unlink("TEMPORAL.csv");#borra los archivo
        
        echo "Archivo guardado";
        header("Location: s-index.html"); #redirecciona al html

    }else{
        NEW_CSV($NW_DATA,$user);
        unlink("temp.csv"); #borra el archivo

        echo "Nuevo usuario agregado";
        header("Location: s-index.html"); #redirecciona al html
    }
?>