<?php

    function NEW_CSV(array $Data, string $CSVfilename){
        $file=fopen($CSVfilename.".csv","w");
        
        foreach($Data as $field){ 
            fputcsv($file,$field);
        }
        fclose($file);
    }



    function joinFiles(array $files, $result) {
        #lo que hace es leer una linea a la vez de un archivo hasta que acabe
        #y la escribe en el archivo resultado
        #hace esto con todos los files que esten en el array
        if(!is_array($files)) {
            throw new Exception('`$files` deben de estar en un array');
        }

        $wH = fopen($result, "w+");

        foreach($files as $file) {
            $fh = fopen($file, "r");
            while(!feof($fh)) {
                fwrite($wH, fgets($fh));
            }
            fclose($fh);
            unset($fh);
            fwrite($wH, "\n");
        }
        fclose($wH);
        unset($wH);
    }


    
    $user = $_POST["user"]; #el user es el metodo de identificacion
    $user=strtolower($user);

    $task = $_POST["title"];
    $hour = $_POST["hour"];
    $desc = $_POST["desc"];
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
        unlink("TEMPORAL.csv");

        header("Location: s-index.html"); #redirecciona al html

    }else{
        NEW_CSV($NW_DATA,$user);
        unlink("temp.csv");
        unlink("TEMPORAL.csv");

        header("Location: s-index.html"); #redirecciona al html
    }
?>