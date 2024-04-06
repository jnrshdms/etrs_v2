<?php
	include '../conn.php';

	$method = $_POST['method'];
if($method == 'generateBatchCode'){
		$prefix = "ITC:";
		$dateCode = date('ymd');
		$randomCode = mt_rand(10000,50000);
		echo $prefix."".$dateCode."".$randomCode;
	}

if ($method == 'fetch_for_update') {
	$batch_no = $_POST['batch_no'];
	$employee_num = $_POST['employee_num'];
	$full_name = $_POST['full_name'];
	$sp_id = $_POST['sp_id'];
	$c = 0;

	$select = "SELECT * FROM etrs_training_record WHERE batch_no LIKE '$batch_no%' AND employee_num LIKE '$employee_num%' AND provider LIKE '$sp_id%' AND full_name LIKE '$full_name%' AND theory_training = 'Passed'";
	$stmt = $conn->prepare($select);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;

			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_record" onclick="get_training_record(&quot;'.$j['id'].'~!~'.$j['batch_no'].'~!~'.$j['employee_num'].'~!~'.$j['gender'].'~!~'.$j['full_name'].'~!~'.$j['department'].'~!~'.$j['position'].'~!~'.$j['date_hired'].'~!~'.$j['provider'].'~!~'.$j['unique_id'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['batch_no'].'</td>';
				echo '<td>'.$j['provider'].'</td>';
				echo '<td>'.$j['employee_num'].'</td>';
				echo '<td>'.$j['full_name'].'</td>';
				echo '<td>'.$j['gender'].'</td>';
				echo '<td>'.$j['department'].'</td>';
				echo '<td>'.$j['position'].'</td>';		
				echo '<td>'.$j['unique_id'].'</td>';			
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="11" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
}


// Revisions (Irish)
if ($method == 'update_initial_record_data') {
    $initial_registration_code = $_POST['initial_registration_code'];
    $emp_id = $_POST['emp_id'];
    $initial_process = $_POST['initial_process'];
    $initial_status = $_POST['initial_status'];
    $initial_training_date = $_POST['initial_training_date'];
    $initial_training_end_date_updates = $_POST['initial_training_end_date_updates'];
    $initial_remarks = $_POST['initial_remarks'];
    $sp_id = $_POST['sp_id'];
	$unique_id = $_POST['unique_id'];

	$check = "SELECT id FROM etrs_initial WHERE emp_id = '$emp_id' AND initial_process = '$initial_process' AND initial_status = '$initial_status' AND initial_training_date = '$initial_training_date' AND initial_training_end_dates = '$initial_training_end_date_updates' AND sp_id = '$sp_id' AND initial_remarks = '$initial_remarks' AND unique_id = '$unique_id'";

	$stmt = $conn->prepare($check);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {

		echo 'Training Record Already Exist!';
	
	}else{
    $insert = "INSERT INTO etrs_initial (`emp_id`,`initial_process`,`initial_status`,`initial_training_date`,`initial_registration_code`,`initial_training_end_dates`,`initial_remarks`,`sp_id`,`unique_id`) 
               VALUES ('$emp_id','$initial_process','$initial_status','$initial_training_date','$initial_registration_code','$initial_training_end_date_updates','$initial_remarks','$sp_id','$unique_id')";

    $stmt = $conn->prepare($insert);

    if ($stmt->execute()) {
        echo 'Successfully Updated';
    } else {
        echo 'Error';
    }
  }
}


if ($method == 'fetch_intial') {
	$batch_no = $_POST['batch_no'];
	$emp_id = $_POST['emp_id'];
	$full_name = $_POST['full_name'];
	$eprocess = $_POST['eprocess'];
	$sp_id = $_POST['sp_id'];
	$c = 0;

	$select = "SELECT etrs_training_record.unique_id, etrs_initial.unique_id, etrs_training_record.date_hired, etrs_initial.id, etrs_training_record.batch_no, etrs_training_record.employee_num, etrs_training_record.full_name, etrs_training_record.gender, etrs_training_record.department, etrs_training_record.position, etrs_initial.initial_process, etrs_initial.initial_status, etrs_initial.initial_training_date, etrs_initial.initial_training_end_dates, etrs_initial.initial_remarks, etrs_initial.sp_id FROM etrs_training_record LEFT JOIN etrs_initial ON etrs_training_record.employee_num = etrs_initial.emp_id AND etrs_training_record.provider = etrs_initial.sp_id AND etrs_training_record.unique_id = etrs_initial.unique_id WHERE etrs_initial.initial_process != '' AND etrs_training_record.batch_no LIKE '$batch_no%' AND etrs_initial.emp_id LIKE '$emp_id%' AND etrs_training_record.full_name LIKE '$full_name%' AND etrs_initial.initial_process LIKE '$eprocess%' AND etrs_initial.sp_id LIKE '$sp_id%' GROUP BY etrs_initial.initial_process, etrs_initial.initial_status, etrs_initial.emp_id, etrs_initial.sp_id";
		$stmt = $conn->prepare($select);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;

			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#reupdate_record" onclick="get_for_update(&quot;'.$j['id'].'~!~'.$j['batch_no'].'~!~'.$j['employee_num'].'~!~'.$j['gender'].'~!~'.$j['full_name'].'~!~'.$j['department'].'~!~'.$j['position'].'~!~'.$j['date_hired'].'~!~'.$j['initial_process'].'~!~'.$j['initial_status'].'~!~'.$j['initial_training_date'].'~!~'.$j['initial_training_end_dates'].'~!~'.$j['initial_remarks'].'~!~'.$j['sp_id'].'&quot;)" >';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['batch_no'].'</td>';
				echo '<td>'.$j['sp_id'].'</td>';
				echo '<td>'.$j['employee_num'].'</td>';
				echo '<td>'.$j['full_name'].'</td>';
				echo '<td>'.$j['gender'].'</td>';
				echo '<td>'.$j['department'].'</td>';
				echo '<td>'.$j['position'].'</td>';
				echo '<td>'.$j['initial_process'].'</td>';	
				echo '<td>'.$j['initial_status'].'</td>';		
				echo '<td>'.$j['initial_training_date'].'</td>';
				echo '<td>'.$j['initial_training_end_dates'].'</td>';
				echo '<td>'.$j['initial_remarks'].'</td>';	
				echo '<td>'.$j['unique_id'].'</td>';	
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="11" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
}
 
if ($method == 'update_initial') {
	$id = $_POST['id'];
	$emp_id = $_POST['emp_id'];
	$initial_process = $_POST['initial_process'];
	$initial_status = $_POST['initial_status'];
	$initial_training_date = $_POST['initial_training_date'];
	$initial_training_end_date = $_POST['initial_training_end_date'];
	$initial_remarks = $_POST['initial_remarks'];
	$sp_id = $_POST['sp_id'];

	$check = "SELECT id FROM etrs_initial WHERE initial_training_date = '$initial_training_date' AND initial_training_end_dates	= '$initial_training_end_date' AND initial_process = '$initial_process' AND initial_status = '$initial_status' AND emp_id = '$emp_id' AND sp_id = '$sp_id' AND initial_remarks = '$initial_remarks'";
	$stmt = $conn->prepare($check);
	$stmt->execute();
	if($stmt->rowCount() > 0) {
		echo 'Duplicate Record';
	}else{

	$update ="UPDATE etrs_initial SET initial_process = '$initial_process', initial_status = '$initial_status', initial_training_date = '$initial_training_date', initial_training_end_dates = '$initial_training_end_date', initial_remarks = '$initial_remarks', emp_id = '$emp_id', sp_id = '$sp_id' WHERE id = '$id'";
	$stmt = $conn->prepare($update);
	if($stmt->execute()){
		echo 'success';
	}else{
		echo 'error';
	}
}
}

// Revisions (Vince)
if ($method == 'delete_initial') {
	$id = $_POST['id'];
	$delete = "DELETE FROM etrs_initial WHERE id = '$id'";
	$stmt = $conn->prepare($delete);
	if ($stmt->execute()) {
		echo 'success';
	}else{
		echo 'error';
	}
}

$conn = NULL;
?>