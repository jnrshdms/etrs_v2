
 <?php
    // error_reporting(0);
    require '../conn.php';
    if(isset($_POST['upload'])){
        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                //READ FILE
                $csvFile = fopen($_FILES['file']['tmp_name'],'r');
                // SKIP FIRST LINE
                fgetcsv($csvFile);
                // PARSE
                $error = 0;
                while(($line = fgetcsv($csvFile)) !== false){
                    $sp_id = $line[0];
                    $emp_id = $line[1];
                    $initial_practice_process = $line[2];
                    $initial_practice_status = $line[3];
                    $initial_practice_training_date = $line[4];
                    $initial_practice_training_end_date = $line[5];
                    $initial_practice_remarks = $line[6];
                    $unique_id = $line[7];
                    
                    // CHECK IF BLANK DATA
                    if ($line[0] == '' || $line[1] == '' || $line[2] == '' || $line[3] == '' || $line[4] == '' || $line[5] == '' || $line[6] == '' || $line[7] == '') {
                        // IF BLANK DETECTED ERROR += 1
                        $error = $error + 1;
                    }else{

                        // CHECK DATA
                    $prevQuery = "SELECT id,emp_id,initial_practice_process,initial_practice_training_date FROM etrs_initial_practice WHERE emp_id = '$line[1]' AND initial_practice_process = '$line[2]' AND sp_id = '$line[0]' AND initial_practice_training_date = '$line[4]' ";
                    $res = $conn->prepare($prevQuery);
                    $res->execute();
                    if($res->rowCount() > 0){
                        foreach($res->fetchALL() as $x){
                            $id = $x['id'];
                            $initial_practice_process = $x['initial_practice_process'];
                        }

                        $dates = new DateTime($initial_practice_training_date);
                        $training_dates = date_format($dates, "Y-m-d");

                        $datess = new DateTime($initial_practice_training_end_date);
                        $training_end_dates = date_format($datess, "Y-m-d");
                        
                        $update = "UPDATE etrs_initial_practice SET emp_id = '$emp_id', initial_practice_process = '$initial_practice_process', initial_practice_status = '$initial_practice_status', initial_practice_training_date = '$training_dates', initial_practice_registration_code = '$iptc', initial_practice_training_end_date = '$training_end_dates', sp_id = '$sp_id', initial_practice_remarks = '$initial_practice_remarks' WHERE id ='$id' AND sp_id = '$sp_id' AND emp_id = '$emp_id' AND initial_practice_process = '$initial_practice_process' AND initial_practice_status = '$initial_practice_status' AND initial_practice_training_date = '$training_dates' AND initial_practice_training_end_date = '$training_end_dates'";
                        $stmt = $conn->prepare($update);
                        if($stmt->execute()){
                            $error = 0;
                        }else{
                            $error = $error + 1;
                        }
                        
                    }else{
                        $dates = new DateTime($initial_practice_training_date);
                        $training_dates = date_format($dates, "Y-m-d");


                        $datess = new DateTime($initial_practice_training_end_date);
                        $training_end_dates = date_format($datess, "Y-m-d");

                        // Revisions (Irish)
                        $insert = "INSERT INTO etrs_initial_practice (`unique_id`,`emp_id`,`initial_practice_process`,`initial_practice_status`,`initial_practice_training_date`,`initial_practice_registration_code`,`initial_practice_training_end_date`,`sp_id`,`initial_practice_remarks`) VALUES ('$unique_id','$emp_id','$initial_practice_process','$initial_practice_status','$training_dates','$iptc','$training_end_dates','$sp_id','$initial_practice_remarks')";
                        $stmt = $conn->prepare($insert);
                        if($stmt->execute()){
                            $error = 0;
                        }else{
                            $error = $error + 1;
                        }
                    }
                    }
                }
                
                fclose($csvFile);
               if($error == 0){
                    echo '<script>
                    var x = confirm("SUCCESS! # OF ERRORS '.$error.' ");
                    if(x == true){
                        location.replace("../../page/ptt/initial_practice_import.php");
                    }else{
                        location.replace("../../page/ptt/initial_practice_import.php");
                    }
                </script>'; 
               }else{
                    echo '<script>
                    var x = confirm("WITH ERROR! # OF ERRORS '.$error.' ");
                    if(x == true){
                        location.replace("../../page/ptt/initial_practice_import.php");
                    }else{
                        location.replace("../../page/ptt/initial_practice_import.php");
                    }
                </script>'; 
               }
            }else{
                echo '<script>
                        var x = confirm("CSV FILE NOT UPLOADED! # OF ERRORS '.$error.' ");
                        if(x == true){
                            location.replace("../../page/ptt/initial_practice_import.php");
                        }else{
                            location.replace("../../page/ptt/initial_practice_import.php");
                        }
                    </script>';
            }
        }else{
            echo '<script>
                        var x = confirm("INVALID FILE FORMAT! # OF ERRORS '.$error.' ");
                        if(x == true){
                            location.replace("../../page/ptt/initial_practice_import.php");
                        }else{
                            location.replace("../../page/ptt/initial_practice_import.php");
                        }
                    </script>';
        }
        
    }

    // KILL CONNECTION
    $conn = null;
?>