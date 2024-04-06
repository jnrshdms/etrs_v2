<?php
	include '../conn.php';

	$method = $_POST['method'];

if($method == 'generateBatchCode'){
		$prefix = "IPTC:";
		$dateCode = date('ymd');
		$randomCode = mt_rand(10000,50000);
		echo $prefix."".$dateCode."".$randomCode;
	}

if ($method == 'fetch_for_update_initial_practice') {
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

			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_record_intial_practice" onclick="get_training_record_initial_practice(&quot;'.$j['id'].'~!~'.$j['batch_no'].'~!~'.$j['employee_num'].'~!~'.$j['gender'].'~!~'.$j['full_name'].'~!~'.$j['department'].'~!~'.$j['position'].'~!~'.$j['date_hired'].'~!~'.$j['provider'].'~!~'.$j['unique_id'].'&quot;)">';
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
if ($method == 'update_initial_practice_record_data') {
	$initial_practice_registration_code = $_POST['initial_practice_registration_code'];
	$emp_id = $_POST['emp_id'];
	$initial_practice_process = $_POST['initial_practice_process'];
	$initial_practice_status = $_POST['initial_practice_status'];
	$initial_practice_training_date = $_POST['initial_practice_training_date'];
	$initial_practice_training_end_date = $_POST['initial_practice_training_end_date'];
	$initial_practice_remarks = $_POST['initial_practice_remarks'];
	$sp_id = $_POST['sp_id'];
	$unique_id = $_POST['unique_id'];
  
	$check = "SELECT id FROM etrs_initial_practice WHERE emp_id = '$emp_id' AND initial_practice_process = '$initial_practice_process' AND initial_practice_status = '$initial_practice_status' AND initial_practice_training_date = '$initial_practice_training_date' AND initial_practice_training_end_date = '$initial_practice_training_end_date' AND sp_id = '$sp_id' AND initial_practice_remarks = '$initial_practice_remarks'AND unique_id = '$unique_id'";

	$stmt = $conn->prepare($check);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {

		echo 'Training Record Already Exist!';
	
	}else{
		$insert = "INSERT INTO etrs_initial_practice (`emp_id`,`initial_practice_process`,`initial_practice_status`,`initial_practice_training_date`,`initial_practice_registration_code`,`initial_practice_training_end_date`,`initial_practice_remarks`,`sp_id`, `unique_id`) VALUES ('$emp_id','$initial_practice_process','$initial_practice_status','$initial_practice_training_date','$initial_practice_registration_code','$initial_practice_training_end_date','$initial_practice_remarks','$sp_id', '$unique_id')";
		$stmt= $conn->prepare($insert);
		if ($stmt->execute()) {

			echo 'Successfully Updated';
		
		}else{
			
			echo 'Error';
		
		}
	}

}


if ($method == 'fetch_initial_practice_view') {
	$batch_no = $_POST['batch_no'];
	$emp_id = $_POST['emp_id'];
	$full_name = $_POST['full_name'];
	$eprocess = $_POST['eprocess'];
	$sp_id = $_POST['sp_id'];
	$c = 0;

	$select = "SELECT etrs_training_record.unique_id,etrs_initial_practice.unique_id,etrs_training_record.date_hired,etrs_initial_practice.id,etrs_training_record.batch_no,etrs_training_record.employee_num,etrs_training_record.full_name,etrs_training_record.gender,etrs_training_record.department,etrs_training_record.position,
	etrs_initial_practice.initial_practice_process, etrs_initial_practice.initial_practice_status, etrs_initial_practice.initial_practice_training_date, etrs_initial_practice.initial_practice_registration_code,etrs_initial_practice.initial_practice_training_end_date,etrs_initial_practice.initial_practice_remarks,etrs_initial_practice.sp_id FROM etrs_training_record LEFT JOIN etrs_initial_practice ON etrs_training_record.employee_num = etrs_initial_practice.emp_id AND etrs_training_record.provider = etrs_initial_practice.sp_id AND  etrs_training_record.unique_id = etrs_initial_practice.unique_id WHERE etrs_initial_practice.initial_practice_process != '' AND etrs_training_record.batch_no LIKE '$batch_no%' AND etrs_initial_practice.emp_id LIKE '$emp_id%' AND etrs_initial_practice.sp_id LIKE '$sp_id%' AND etrs_training_record.full_name LIKE '$full_name%' AND etrs_initial_practice.initial_practice_process LIKE '$eprocess%' GROUP BY etrs_initial_practice.initial_practice_status, etrs_initial_practice.initial_practice_process,etrs_initial_practice.sp_id,etrs_initial_practice.emp_id";
	$stmt = $conn->prepare($select);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;

			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#initial_practice_for_update" onclick="get_for_update_initial_practice(&quot;'.$j['id'].'~!~'.$j['batch_no'].'~!~'.$j['employee_num'].'~!~'.$j['gender'].'~!~'.$j['full_name'].'~!~'.$j['department'].'~!~'.$j['position'].'~!~'.$j['date_hired'].'~!~'.$j['initial_practice_process'].'~!~'.$j['initial_practice_status'].'~!~'.$j['initial_practice_training_date'].'~!~'.$j['initial_practice_training_end_date'].'~!~'.$j['initial_practice_remarks'].'~!~'.$j['sp_id'].'&quot;)" >';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['batch_no'].'</td>';
				echo '<td>'.$j['sp_id'].'</td>';
				echo '<td>'.$j['employee_num'].'</td>';
				echo '<td>'.$j['full_name'].'</td>';
				echo '<td>'.$j['gender'].'</td>';
				echo '<td>'.$j['department'].'</td>';
				echo '<td>'.$j['position'].'</td>';
				echo '<td>'.$j['initial_practice_process'].'</td>';	
				echo '<td>'.$j['initial_practice_status'].'</td>';		
				echo '<td>'.$j['initial_practice_training_date'].'</td>';	
				echo '<td>'.$j['initial_practice_training_end_date'].'</td>';
				echo '<td>'.$j['initial_practice_remarks'].'</td>';	
				echo '<td>'.$j['unique_id'].'</td>';	
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="11" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
}


if ($method == 'update_initial_practice') {
	$id = $_POST['id'];
	$emp_id = $_POST['emp_id'];
	$initial_practice_process = $_POST['initial_practice_process'];
	$initial_practice_status = $_POST['initial_practice_status'];
	$initial_practice_training_date = $_POST['initial_practice_training_date'];
	$initial_practice_training_end_date = $_POST['initial_practice_training_end_date'];
	$initial_practice_remarks = $_POST['initial_practice_remarks'];
	$sp_id = $_POST['sp_id'];

	$check = "SELECT id FROM etrs_initial_practice WHERE emp_id = '$emp_id' AND initial_practice_process = '$initial_practice_process' AND initial_practice_status = '$initial_practice_status' AND initial_practice_training_date = '$initial_practice_training_date' AND initial_practice_training_end_date = '$initial_practice_training_end_date' AND sp_id	= '$sp_id' AND initial_practice_remarks = '$initial_practice_remarks'";
	$stmt = $conn->prepare($check);
	$stmt->execute();
	if($stmt->rowCount() > 0) {
		echo 'Duplicate Record';
	}else{

	$update ="UPDATE etrs_initial_practice SET initial_practice_process = '$initial_practice_process', initial_practice_status = '$initial_practice_status', initial_practice_training_date = '$initial_practice_training_date', initial_practice_training_end_date = '$initial_practice_training_end_date', initial_practice_remarks = '$initial_practice_remarks' WHERE id = '$id'";
	$stmt = $conn->prepare($update);
	if($stmt->execute()){
		echo 'success';
	}else{
		echo 'error';
	}
}
}

// Revisions (Vince)
if ($method == 'delete_initial_practice') {
	$id = $_POST['id'];
	$delete = "DELETE FROM etrs_initial_practice WHERE id = '$id'";
	$stmt = $conn->prepare($delete);
	if ($stmt->execute()) {
		echo 'success';
	}else{
		echo 'error';
	}
}
$conn = NULL;
?>