<?php
	include '../conn.php';

	$method = $_POST['method'];

if($method == 'generateBatchCode'){
		$prefix = "FPTC:";
		$dateCode = date('ymd');
		$randomCode = mt_rand(10000,50000);
		echo $prefix."".$dateCode."".$randomCode;
	}

if ($method == 'fetch_for_update_final_practice') {
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

			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_record_final_practice" onclick="get_training_record_final_practice(&quot;'.$j['id'].'~!~'.$j['batch_no'].'~!~'.$j['employee_num'].'~!~'.$j['gender'].'~!~'.$j['full_name'].'~!~'.$j['department'].'~!~'.$j['position'].'~!~'.$j['date_hired'].'~!~'.$j['provider'].'~!~'.$j['unique_id'].'&quot;)">';
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
if ($method == 'update_final_practice_record_data') {
	$final_practice_registration_code = $_POST['final_practice_registration_code'];
	$emp_id = $_POST['emp_id'];
	$final_practice_process = $_POST['final_practice_process'];
	$final_practice_status = $_POST['final_practice_status'];
	$final_practice_training_date = $_POST['final_practice_training_date'];
	$final_practice_training_end_date = $_POST['final_practice_training_end_date'];
	$final_practice_remarks = $_POST['final_practice_remarks'];
	$sp_id = $_POST['sp_id'];
	$unique_id = $_POST['unique_id'];
    

	   
	$check = "SELECT id FROM etrs_final_practice WHERE emp_id = '$emp_id' AND final_practice_process = '$final_practice_process' AND final_practice_status = '$final_practice_status' AND final_practice_training_date = '$final_practice_training_date' AND final_practice_training_end_date = '$final_practice_training_end_date' AND sp_id = '$sp_id' AND final_practice_remarks = '$final_practice_remarks'unique_id = '$unique_id'";

	$stmt = $conn->prepare($check);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {

		echo 'Training Record Already Exist!';
	
	}else{
		$insert = "INSERT INTO etrs_final_practice (`emp_id`,`final_practice_process`,`final_practice_status`,`final_practice_training_date`,`final_practice_registration_code`,`final_practice_training_end_date`,`final_practice_remarks`,`sp_id`,`unique_id`) VALUES ('$emp_id','$final_practice_process','$final_practice_status','$final_practice_training_date','$final_practice_registration_code', '$final_practice_training_end_date','$final_practice_remarks','$sp_id', '$unique_id')";
		$stmt= $conn->prepare($insert);
		if ($stmt->execute()) {

			echo 'Successfully Updated';
		
		}else{
			
			echo 'Error';
		
		}
	}

}


if ($method == 'fetch_final_practice_view') {
	$batch_no = $_POST['batch_no'];
	$emp_id = $_POST['emp_id'];
	$full_name = $_POST['full_name'];
	$eprocess = $_POST['eprocess'];
	$sp_id = $_POST['sp_id'];
	$c = 0;

	$select = "SELECT etrs_training_record.unique_id,etrs_final_practice.unique_id,etrs_training_record.date_hired,etrs_final_practice.id,etrs_training_record.batch_no,etrs_training_record.employee_num,etrs_training_record.full_name,etrs_training_record.gender,etrs_training_record.department,etrs_training_record.position,
	etrs_final_practice.final_practice_process, etrs_final_practice.final_practice_status, etrs_final_practice.final_practice_training_date, etrs_final_practice.final_practice_registration_code,etrs_final_practice.final_practice_training_end_date,etrs_final_practice.final_practice_remarks, etrs_final_practice.sp_id FROM etrs_training_record LEFT JOIN etrs_final_practice ON etrs_training_record.employee_num = etrs_final_practice.emp_id AND etrs_training_record.provider = etrs_final_practice.sp_id  WHERE etrs_final_practice.final_practice_process != '' AND etrs_training_record.batch_no LIKE '$batch_no%' AND etrs_final_practice.emp_id LIKE '$emp_id%' AND etrs_final_practice.sp_id LIKE '$sp_id%' AND etrs_training_record.full_name LIKE '$full_name%' AND etrs_final_practice.final_practice_process LIKE '$eprocess%' GROUP BY etrs_final_practice.final_practice_status, etrs_final_practice.final_practice_process,etrs_final_practice.sp_id,etrs_final_practice.emp_id";
	$stmt = $conn->prepare($select);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;

			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#final_practice_for_update" onclick="get_for_update_final_practice(&quot;'.$j['id'].'~!~'.$j['batch_no'].'~!~'.$j['employee_num'].'~!~'.$j['gender'].'~!~'.$j['full_name'].'~!~'.$j['department'].'~!~'.$j['position'].'~!~'.$j['date_hired'].'~!~'.$j['final_practice_process'].'~!~'.$j['final_practice_status'].'~!~'.$j['final_practice_training_date'].'~!~'.$j['final_practice_training_end_date'].'~!~'.$j['final_practice_remarks'].'~!~'.$j['sp_id'].'&quot;)" >';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['batch_no'].'</td>';
				echo '<td>'.$j['sp_id'].'</td>';
				echo '<td>'.$j['employee_num'].'</td>';
				echo '<td>'.$j['full_name'].'</td>';
				echo '<td>'.$j['gender'].'</td>';
				echo '<td>'.$j['department'].'</td>';
				echo '<td>'.$j['position'].'</td>';
				echo '<td>'.$j['final_practice_process'].'</td>';	
				echo '<td>'.$j['final_practice_status'].'</td>';		
				echo '<td>'.$j['final_practice_training_date'].'</td>';	
				echo '<td>'.$j['final_practice_training_end_date'].'</td>';	
				echo '<td>'.$j['final_practice_remarks'].'</td>';	
				echo '<td>'.$j['unique_id'].'</td>';	
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="11" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
}

if ($method == 'update_final_practice') {
	$id = $_POST['id'];
	$emp_id = $_POST['emp_id'];
	$final_practice_process = $_POST['final_practice_process'];
	$final_practice_status = $_POST['final_practice_status'];
	$final_practice_training_date = $_POST['final_practice_training_date'];
	$final_practice_training_end_date = $_POST['final_practice_training_end_date'];
	$final_practice_remarks = $_POST['final_practice_remarks'];
	$sp_id	= $_POST['sp_id'];

	$check = "SELECT id FROM etrs_final_practice WHERE emp_id = '$emp_id' AND final_practice_process = '$final_practice_process' AND final_practice_status = '$final_practice_status' AND final_practice_training_date = '$final_practice_training_date' AND final_practice_training_end_date = '$final_practice_training_end_date' AND sp_id = '$sp_id' AND final_practice_remarks = '$final_practice_remarks'";
	$stmt = $conn->prepare($check);
	$stmt->execute();
	if($stmt->rowCount() > 0) {
		echo 'Duplicate Record';
	}else{

	$update ="UPDATE etrs_final_practice SET final_practice_process = '$final_practice_process', final_practice_status = '$final_practice_status', final_practice_training_date = '$final_practice_training_date', final_practice_training_end_date = '$final_practice_training_end_date', final_practice_remarks = '$final_practice_remarks' WHERE id = '$id'";
	$stmt = $conn->prepare($update);
	if($stmt->execute()){
		echo 'success';
	}else{
		echo 'error';
	}
}
}

// Revisions (Vince)
if ($method == 'delete_final_practice') {
	$id = $_POST['id'];
	$delete = "DELETE FROM etrs_final_practice WHERE id = '$id'";
	$stmt = $conn->prepare($delete);
	if ($stmt->execute()) {
		echo 'success';
	}else{
		echo 'error';
	}
}
$conn = NULL;
?>