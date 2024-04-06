<?php
	include '../conn.php';

	$method = $_POST['method'];
if($method == 'generateBatchCode'){
		$prefix = "FTC:";
		$dateCode = date('ymd');
		$randomCode = mt_rand(10000,50000);
		echo $prefix."".$dateCode."".$randomCode;
	}
 
if ($method == 'fetch_for_update_final') {
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

			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_final_record" onclick="get_training_final_record(&quot;'.$j['id'].'~!~'.$j['batch_no'].'~!~'.$j['employee_num'].'~!~'.$j['gender'].'~!~'.$j['full_name'].'~!~'.$j['department'].'~!~'.$j['position'].'~!~'.$j['date_hired'].'~!~'.$j['provider'].'~!~'.$j['unique_id'].'&quot;)">';
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
if ($method == 'update_final_record_data') {
	$final_registration_code = $_POST['final_registration_code'];
	$emp_id = $_POST['emp_id'];
	$final_process = $_POST['final_process'];
	$final_status = $_POST['final_status'];
	$final_training_date = $_POST['final_training_date'];
	$final_training_end_date_updates = $_POST['final_training_end_date_updates'];
	$final_remarks = $_POST['final_remarks'];
	$sp_id = $_POST['sp_id'];
	$unique_id = $_POST['unique_id'];

	$check = "SELECT id FROM etrs_final WHERE emp_id = '$emp_id' AND final_process = '$final_process' AND final_status = '$final_status' AND final_training_date = '$final_training_date' AND final_training_ends_dates = '$final_training_end_date_updates' AND sp_id = '$sp_id' AND final_remarks = '$final_remarks'AND unique_id = '$unique_id'";
	$stmt = $conn->prepare($check);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {

		echo 'Training Record Already Exist!';
	
	}else{
		$insert = "INSERT INTO etrs_final (`emp_id`,`final_process`,`final_status`,`final_training_date`,`final_registration_code`,`final_training_ends_dates`,`final_remarks`,`sp_id`, `unique_id`) VALUES ('$emp_id','$final_process','$final_status','$final_training_date','$final_registration_code','$final_training_end_date_updates','$final_remarks','$sp_id', '$unique_id')";
		$stmt= $conn->prepare($insert);
		if ($stmt->execute()) {

			echo 'Successfully Updated';
		
		}else{
			
			echo 'Error';
		
		}
	}

}

if ($method == 'fetch_final') {
	$batch_no = $_POST['batch_no'];
	$emp_id = $_POST['emp_id'];
	$full_name = $_POST['full_name'];
	$eprocess = $_POST['eprocess'];
	$sp_id = $_POST['sp_id'];
	$c = 0;

	$select = "SELECT etrs_training_record.unique_id,etrs_final.unique_id,etrs_training_record.date_hired,etrs_final.id,etrs_training_record.batch_no,etrs_training_record.employee_num,etrs_training_record.full_name,etrs_training_record.gender,etrs_training_record.department,etrs_training_record.position,etrs_final.final_process,etrs_final.final_status,etrs_final.final_training_date,etrs_final.final_training_ends_dates,etrs_final.final_remarks,etrs_final.sp_id FROM etrs_training_record LEFT JOIN etrs_final ON etrs_training_record.employee_num = etrs_final.emp_id AND etrs_training_record.provider = etrs_final.sp_id AND  etrs_training_record.unique_id = etrs_final.unique_id WHERE etrs_final.final_process != '' AND etrs_training_record.batch_no LIKE '$batch_no%' AND etrs_final.emp_id LIKE '$emp_id%' AND etrs_final.sp_id LIKE '$sp_id%' AND etrs_training_record.full_name LIKE '$full_name%' AND etrs_final.final_process LIKE '$eprocess%' GROUP BY etrs_final.final_status,etrs_final.final_process,etrs_final.sp_id,etrs_final.emp_id";
	$stmt = $conn->prepare($select);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;

			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#final_for_update" onclick="get_for_update_final(&quot;'.$j['id'].'~!~'.$j['batch_no'].'~!~'.$j['employee_num'].'~!~'.$j['gender'].'~!~'.$j['full_name'].'~!~'.$j['department'].'~!~'.$j['position'].'~!~'.$j['date_hired'].'~!~'.$j['final_process'].'~!~'.$j['final_status'].'~!~'.$j['final_training_date'].'~!~'.$j['final_training_ends_dates'].'~!~'.$j['final_remarks'].'~!~'.$j['sp_id'].'&quot;)" >';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['batch_no'].'</td>';
				echo '<td>'.$j['sp_id'].'</td>';
				echo '<td>'.$j['employee_num'].'</td>';
				echo '<td>'.$j['full_name'].'</td>';
				echo '<td>'.$j['gender'].'</td>';
				echo '<td>'.$j['department'].'</td>';
				echo '<td>'.$j['position'].'</td>';
				echo '<td>'.$j['final_process'].'</td>';	
				echo '<td>'.$j['final_status'].'</td>';	
				echo '<td>'.$j['final_training_date'].'</td>';		
				echo '<td>'.$j['final_training_ends_dates'].'</td>';	
				echo '<td>'.$j['final_remarks'].'</td>';
				echo '<td>'.$j['unique_id'].'</td>';		
			echo '</tr>';
		} 
	}else{
		echo '<tr>';
			echo '<td colspan="11" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
}

if ($method == 'update_final') {
	$id = $_POST['id'];
	$emp_id = $_POST['emp_id'];
	$final_process = $_POST['final_process'];
	$final_status = $_POST['final_status'];
	$final_training_date = $_POST['final_training_date'];
	$final_training_ends_dates = $_POST['final_training_ends_dates'];
	$final_remarks = $_POST['final_remarks'];
	$sp_id = $_POST['sp_id'];

	$check = "SELECT id FROM etrs_final WHERE emp_id = '$emp_id' AND final_process = '$final_process' AND final_status = '$final_status' AND final_training_date = '$final_training_date' AND final_training_ends_dates = '$final_training_ends_dates' AND sp_id = '$sp_id' AND final_remarks = '$final_remarks'";
	$stmt = $conn->prepare($check);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		echo 'Duplicate Record';
	}else{
		$update = "UPDATE etrs_final SET final_process = '$final_process', final_status = '$final_status', final_training_date = '$final_training_date', final_training_ends_dates = '$final_training_ends_dates', final_remarks = '$final_remarks', emp_id = '$emp_id', sp_id = '$sp_id' WHERE id = '$id'";
		$stmt2 = $conn->prepare($update);
		if($stmt2->execute()){
			echo 'success';
		}else{
			echo 'error';
		}
	}
}

// Revisions (Vince)
if ($method == 'delete_final') {
	$id = $_POST['id'];
	$delete = "DELETE FROM etrs_final WHERE id = '$id'";
	$stmt = $conn->prepare($delete);
	if ($stmt->execute()) {
		echo 'success';
	}else{
		echo 'error';
	}
}


$conn = NULL;
?>