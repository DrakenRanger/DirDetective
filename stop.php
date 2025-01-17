<?php

   if(isset($_REQUEST['stop'])){
   	$file = fopen("stop.txt", "w");
      $read = fopen("stop.txt", "r");
      if($_REQUEST['stop'] == 1){
         $data = fgets($read);
         if($data == 1){
            echo 2;
            die();
         }
      } 
      fwrite($file, $_REQUEST['stop']);
   	fclose($file);
   }

?>