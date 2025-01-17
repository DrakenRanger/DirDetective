<?php

    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(isset($_REQUEST['url']) && !empty($_REQUEST['list'])){
            if(isset($_REQUEST['ext']) && $_REQUEST['ext'] != ""){
                $ext = ".".$_REQUEST['ext'];
            }else{
                $ext = null;
            }
            $data = null;
            $i = 1;
            $flag = 0;
            $url = $_REQUEST['url'];
            $path = "wordlists/".$_REQUEST['list'];
            $file = fopen($path, "r");
            if($file){
                while ($line = fgets($file)) {
                    $stopVal = fopen("stop.txt","r");
                    $stopVal = fgets($stopVal);
                    if($stopVal == 1){
                        echo 3;
                        die(exit());
                    }
                   $line = trim($line);
                   $newUrl = $url."/".$line.$ext;
                   $ch = curl_init($newUrl);
                   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                   curl_setopt($ch, CURLOPT_NOBODY, true); // Perform a HEAD request
                   curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout after 10 seconds
                   curl_exec($ch);

                   $statusCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
                   if($statusCode >= 200 && $statusCode < 400){
                    $flag = 1;
                    $data .= '<tr>
                                <th scope="row">'.$i.'</th>
                                <td>'.$newUrl.'</td>
                                <td>'.$statusCode.'</td>
                                <td>
                                   <a href="'.$newUrl.'" target="_blank">
                                       <button type="button" class="btn btn-warning">VISIT</button>
                                    </a>
                                </td>
                            </tr>';
                    curl_close($ch);
                    $i++;
                    echo $data;
                    flush();
                    ob_flush();
                    usleep(1000000);
                    $data = null;
                   }
                } 
                if($flag == 0){
                    $data .= '<tr><td colspan="4">No Data Found</td></tr>';
                    echo $data;
                }
            }else{
                echo 2;
            }
        }else{
            echo 1;
        }
    }

?> 