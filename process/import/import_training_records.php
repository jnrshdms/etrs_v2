<?php
    // error_reporting(0);
    require '../conn.php';
    // Revisions (Irish)
    function generate_etrs_request_id($unique_id)
	{
		if ($unique_id == "") {
			$unique_id = date("ymdh");
			$rand = substr(md5(microtime()), rand(0, 26), 5);
			$unique_id = 'ETRS:' . $unique_id;
			$unique_id = $unique_id . '' . $rand;
		}
		return $unique_id;
	}


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
                    $batch_no = $line[0];
                    $provider = $line[1];
                    $employee_num = $line[2];
                    $maiden_name = $line[3];
                    $full_name = $line[4];
                    $gender = $line[5];
                    $department = $line[6];
                    $position = $line[7];
                    $spdate_hired = $line[8];
                    $date_hired = $line[9];
                    $theory_training = $line[10];
                    $training_date = $line[11];
                    $training_end_date = $line[12];
                    $theory_remarks = $line[13];

                     // Revisions (Irish)
                     $unique_id = '';
                     $unique_id = generate_etrs_request_id($unique_id);

                    // CHECK IF BLANK DATA
                    if($line[0] == '' || $line[1] == '' || $line[2] == '' || $line[3] == '' || $line[4] == '' || $line[5] == '' || $line[6] == '' || $line[7] == '' || $line[8] == '' || $line[9] == '' || $line[10] == '' || $line[11] == '' || $line[12] == '' || $line[13] == ''){
                        // IF BLANK DETECTED ERROR += 1
                        $error = $error + 1;
                    }else{
                        // CHECK DATA
                    $prevQuery = "SELECT id,training_date,training_end_date,theory_remarks FROM etrs_training_record WHERE employee_num = '$line[2]' AND full_name = '$line[4]' AND provider = '$line[1]' AND training_date = '$line[11]' AND training_end_date = '$line[12]' AND theory_remarks = '$line[13]'";
                    $res = $conn->prepare($prevQuery);
                    $res->execute();
                    if($res->rowCount() > 0){
                        foreach($res->fetchALL() as $x){
                            $id = $x['id'];
                            $training_dates = $x['training_date'];
                            $training_end_dates = $x['training_end_date'];
                            $theory_remarkss = $x['theory_remarks']; 
                        }

                         // $dates = new DateTime($training_date);
                         //    $training_dates = date_format($dates, "Y-m-d");

                         //    $datesss = new DateTime($training_end_date);
                         //    $training_end_dates = date_format($datesss, "Y-m-d");

                         //    $datess = new DateTime($date_hired);
                         //    $date_hireds = date_format($datess, "Y-m-d");

                         //    $datesssss = new DateTime($spdate_hired);
                         //    $spdates = date_format($datesssss, "Y-m-d");


                        $update = "UPDATE etrs_training_record SET batch_no = '$batch_no', provider = '$provider', employee_num = '$employee_num',maiden_name = '$maiden_name', full_name = '$full_name', gender = '$gender', department = '$department', position = '$position', date_hired = '$date_hired', theory_training = '$theory_training', training_date = '$training_date', training_end_date = '$training_end_date', theory_remarks = '$theory_remarks', registration_code = '$tc', spdate_hired = '$spdate_hired' WHERE id = '$id' AND training_date = '$training_dates' AND training_end_date = '$training_end_dates' AND theory_remarks = '$theory_remarkss'";
                        $stmt = $conn->prepare($update);
                        if($stmt->execute()){
                            $error = 0;
                        }else{
                            $error = $error + 1;
                        }
                        
                    }else{

                        //  $dates = new DateTime($training_date);
                        // $training_dates = date_format($dates, "Y-m-d");

                        // $datess = new DateTime($date_hired);
                        // $date_hireds = date_format($datess, "Y-m-d");

                        // $datesss = new DateTime($training_end_date);
                        // $training_end_dates = date_format($datesss, "Y-m-d");

                        //   $datesssss = new DateTime($spdate_hired);
                        // $spdates = date_format($datesssss, "Y-m-d");

                        // Revisions (Irish) 
                        $insert = "INSERT INTO etrs_training_record (`unique_id`,`batch_no`,`provider`,`employee_num`,`maiden_name`,`full_name`,`gender`,`department`,`position`,`date_hired`,`theory_training`,`training_date`,`training_end_date`,`theory_remarks`,`spdate_hired`) VALUES ('$unique_id','$batch_no','$provider','$employee_num','$maiden_name','$full_name','$gender','$department','$position','$date_hired','$theory_training','$training_date','$training_end_date','$theory_remarks','$spdate_hired')";
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
                        location.replace("../../page/ptt/register.php");
                    }else{
                        location.replace("../../page/ptt/register.php");
                    }
                </script>'; 
               }else{
                    echo '<script>
                    var x = confirm("WITH ERROR! # OF ERRORS '.$error.' ");
                    if(x == true){
                        location.replace("../../page/ptt/register.php");
                    }else{
                        location.replace("../../page/ptt/register.php");
                    }
                </script>'; 
               }
            }else{
                echo '<script>
                        var x = confirm("CSV FILE NOT UPLOADED! # OF ERRORS '.$error.' ");
                        if(x == true){
                            location.replace("../../page/ptt/register.php");
                        }else{
                            location.replace("../../page/ptt/register.php");
                        }
                    </script>';
            }
        }else{
            echo '<script>
                        var x = confirm("INVALID FILE FORMAT! # OF ERRORS '.$error.' ");
                        if(x == true){
                            location.replace("../../page/ptt/register.php");
                        }else{
                            location.replace("../../page/ptt/register.php");
                        }
                    </script>';
        }
        
    }

    // KILL CONNECTION
    $conn = null;
?>