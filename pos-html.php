<?php
    function write_csv(array $Data, string $CSVfilename){
        if(file_exists($CSVfilename)){
            file_put_contents($CSVfilename,$Data,FILE_APPEND);
        }
    }

    function NEW_CSV(array $Data, string $CSVfilename){
        $file=fopen($CSVfilename.".csv","w");
        
        foreach($Data as $field){ 
            fputcsv($file,$field);
        }
        fclose($file);
    }



    function joinFiles(array $files, $result) {
        if(!is_array($files)) {
            throw new Exception('`$files` must be an array');
        }

        $wH = fopen($result, "w+");

        foreach($files as $file) {
            $fh = fopen($file, "r");
            while(!feof($fh)) {
                fwrite($wH, fgets($fh));
            }
            fclose($fh);
            unset($fh);
            fwrite($wH, "\n"); //usually last line doesn't have a newline
        }
        fclose($wH);
        unset($wH);
    }


    #DATOS A PONER
    $user = $_POST["user"]; #el user es el metodo de log in

    $task = $_POST["title"];
    $hour = $_POST["hour"];
    $desc = $_POST["desc"];
    $NW_DATA=array(array($task,$desc,$hour));


    NEW_CSV($NW_DATA,"temp");

    if(file_exists($user."csv")==true){
        file_put_contents("TEMPORAL.csv","");
        copy("$user.csv","TEMPORAL.csv");
        unlink($user."csv");

        joinFiles(array("TEMPORAL.csv","temp.csv"),$user."csv");
        echo "FILE HAS BEEN WRITTED";
    }else{
        echo "ELSE";
        #NEW_CSV($NW_DATA,$user);
        #header("Location: s-index.html");
    }
?>