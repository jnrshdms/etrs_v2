<?php 
include 'conn.php';
$method = $_POST['method'];

if ($method == 'fetch_viewer') {
	$c = 0;
	$employee_num = $_POST['employee_num'];
	$full_name = $_POST['full_name'];
	$batch_no = $_POST['batch_no'];
	$department = $_POST['department'];
	$sp_id = $_POST['sp_id'];
   
	$select = "SELECT * FROM etrs_training_record WHERE";

	if (!empty($full_name)) {
		$select = $select . " full_name LIKE '$full_name%'";
	} else {		
		$select = $select . " full_name != ''";
	}

	if (!empty($batch_no)) {
		$select = $select . " AND batch_no LIKE '$batch_no%'";
	}

	if (!empty($department)) {
		$select = $select . " AND department LIKE '$department%'";
	}

	if (!empty($employee_num)) {
		$select = $select . " AND employee_num LIKE '$employee_num%'";
	}

	if (!empty($sp_id)) {
		$select = $select . " AND provider LIKE '$sp_id%'";
	}

	$stmt = $conn->prepare($select);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;
			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#status" onclick="get_training_record_ptt(&quot;'.$j['id'].'~!~'.$j['batch_no'].'~!~'.$j['provider'].'~!~'.$j['employee_num'].'~!~'.$j['maiden_name'].'~!~'.$j['full_name'].'~!~'.$j['gender'].'~!~'.$j['department'].'~!~'.$j['position'].'~!~'.$j['date_hired'].'~!~'.$j['theory_training'].'~!~'.$j['training_date'].'~!~'.$j['training_end_date'].'~!~'.$j['theory_remarks'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['batch_no'].'</td>';
				echo '<td>'.$j['provider'].'</td>';
				echo '<td>'.$j['employee_num'].'</td>';
				echo '<td>'.$j['maiden_name'].'</td>';
				echo '<td>'.$j['full_name'].'</td>';
				echo '<td>'.$j['gender'].'</td>';
				echo '<td>'.$j['department'].'</td>';	
				echo '<td>'.$j['position'].'</td>';
				echo '<td>'.$j['spdate_hired'].'</td>';
				echo '<td>'.$j['date_hired'].'</td>';
				echo '<td>'.$j['theory_training'].'</td>';
				echo '<td>'.$j['training_date'].'</td>';
				echo '<td>'.$j['training_end_date'].'</td>';
				echo '<td>'.$j['theory_remarks'].'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="13" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
}

if ($method == 'fetch_export_viewer') {
	$c = 0;
	$employee_num = $_POST['employee_num'];
	$full_name = $_POST['full_name'];
	$batch_no = $_POST['batch_no'];
	$department = $_POST['department'];
	$sp_id = $_POST['sp_id'];

	$query = "SELECT * FROM etrs_export_training_detailss WHERE full_name LIKE '$full_name%' AND batch_no LIKE '$batch_no%' AND department LIKE '$department%' AND theory_training = 'Passed' AND employee_num LIKE '$employee_num%' AND provider LIKE '$sp_id%'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;
			echo '<tr>';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['batch_no'].'</td>';
				echo '<td>'.$j['provider'].'</td>';
				echo '<td>'.$j['employee_num'].'</td>';
				echo '<td>'.$j['maiden_name'].'</td>';
				echo '<td>'.$j['full_name'].'</td>';
				echo '<td>'.$j['gender'].'</td>';
				echo '<td>'.$j['department'].'</td>';	
				echo '<td>'.$j['position'].'</td>';
				echo '<td>'.$j['spdate_hired'].'</td>';
				echo '<td>'.$j['date_hired'].'</td>';
				echo '<td>'.$j['theory_training'].'</td>';
				echo '<td>'.$j['training_date'].'</td>';
				echo '<td>'.$j['training_end_date'].'</td>';
				echo '<td>'.$j['theory_remarks'].'</td>';
				echo '<td>'.$j['initial_process'].'</td>';
				echo '<td>'.$j['initial_status'].'</td>';
				echo '<td>'.$j['initial_training_date'].'</td>';
				echo '<td>'.$j['initial_training_end_dates'].'</td>';
				echo '<td>'.$j['initial_remarks'].'</td>';
				echo '<td>'.$j['final_process'].'</td>';
				echo '<td>'.$j['final_status'].'</td>';
				echo '<td>'.$j['final_training_date'].'</td>';
				echo '<td>'.$j['final_training_ends_dates'].'</td>';
				echo '<td>'.$j['final_remarks'].'</td>';
				echo '<td>'.$j['initial_practice_process'].'</td>';
				echo '<td>'.$j['initial_practice_status'].'</td>';
				echo '<td>'.$j['initial_practice_training_date'].'</td>';
				echo '<td>'.$j['initial_practice_training_end_date'].'</td>';
				echo '<td>'.$j['initial_practice_remarks'].'</td>';
				echo '<td>'.$j['final_practice_process'].'</td>';
				echo '<td>'.$j['final_practice_status'].'</td>';
				echo '<td>'.$j['final_practice_training_date'].'</td>';
				echo '<td>'.$j['final_practice_training_end_date'].'</td>';
				echo '<td>'.$j['final_practice_remarks'].'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="13" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
			}
}

if($method == 'fetch_theory_training_taken'){
	$id = $_POST['id'];
	$batch_no = $_POST['batch_no'];
	$provider = $_POST['provider'];
	$employee_num = $_POST['employee_num'];
	$maiden_name = $_POST['maiden_name'];
	$full_name = $_POST['full_name'];
	$gender = $_POST['gender'];
	$department = $_POST['department'];
	$position = $_POST['position'];

	

	// $query ="SELECT * FROM etrs_training_record WHERE employee_num = '$employee_num' AND provider = '$provider'  GROUP BY batch_no,theory_training";
	$query ="SELECT * FROM etrs_training_record WHERE id = '$id' GROUP BY batch_no,theory_training";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
				echo '<tr>';
					echo '<td>'.$j['batch_no'].'</td>';
					echo '<td>'.$j['theory_training'].'</td>';
					echo '<td>'.$j['training_date'].'</td>';
					echo '<td>'.$j['training_end_date'].'</td>';
					echo '<td>'.$j['theory_remarks'].'</td>';
				echo '</tr>';
		}
	}else{
		echo '<tr>';
				echo '<td colspan="5">No Result</td>';
		echo '</tr>';
	}
}


if ($method =='fetch_training_taken') {

	$id = $_POST['id'];
	$batch_no = $_POST['batch_no'];
	$provider = $_POST['provider'];
	$employee_num = $_POST['employee_num'];
	$maiden_name = $_POST['maiden_name'];
	$full_name = $_POST['full_name'];
	$gender = $_POST['gender'];
	$department = $_POST['department'];
	$position = $_POST['position'];


	/*$select ="SELECT etrs_training_record.id,etrs_training_record.employee_num,etrs_initial.initial_process, etrs_initial.initial_training_date, etrs_initial.initial_training_end_dates,etrs_initial.initial_status, etrs_initial.initial_remarks
FROM etrs_training_record LEFT JOIN etrs_initial ON etrs_training_record.employee_num = etrs_initial.emp_id AND etrs_training_record.provider = etrs_initial.sp_id  WHERE etrs_training_record.employee_num = '$employee_num' AND etrs_training_record.provider = '$provider'";*/
// 	$select ="SELECT etrs_training_record.id,etrs_training_record.employee_num,etrs_initial.initial_process, etrs_initial.initial_training_date, etrs_initial.initial_training_end_dates,etrs_initial.initial_status, etrs_initial.initial_remarks
// FROM etrs_training_record LEFT JOIN etrs_initial ON etrs_training_record.employee_num = etrs_initial.emp_id AND etrs_training_record.provider = etrs_initial.sp_id  WHERE etrs_training_record.id = '$id'";
$select = "SELECT etrs_training_record.id, etrs_training_record.employee_num, etrs_training_record.unique_id, etrs_initial.initial_process, etrs_initial.initial_training_date, etrs_initial.initial_training_end_dates, etrs_initial.initial_status, etrs_initial.initial_remarks FROM etrs_training_record LEFT JOIN etrs_initial ON etrs_training_record.employee_num = etrs_initial.emp_id AND etrs_training_record.provider = etrs_initial.sp_id AND etrs_training_record.unique_id = etrs_initial.unique_id WHERE etrs_training_record.id = '$id'";
$stmt = $conn->prepare($select);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			echo '<tr>';
					echo '<td>'.$j['initial_process'].'</td>';
					echo '<td>'.$j['initial_training_date'].'</td>';
					echo '<td>'.$j['initial_training_end_dates'].'</td>';
					echo '<td>'.$j['initial_status'].'</td>';
					echo '<td>'.$j['initial_remarks'].'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="1" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
	}
}

if ($method == 'fetch_needs_initial'){
	$id = $_POST['id'];
	$batch_no = $_POST['batch_no'];
	$provider = $_POST['provider'];
	$employee_num = $_POST['employee_num'];
	$maiden_name = $_POST['maiden_name'];
	$full_name = $_POST['full_name'];
	$gender = $_POST['gender'];
	$department = $_POST['department'];
	$position = $_POST['position'];

	$query = "SELECT etrs_initial_process.processs, etrs_initial.initial_process, etrs_training_record.employee_num FROM etrs_initial_process
LEFT JOIN etrs_initial ON etrs_initial.initial_process != etrs_initial_process.processs
LEFT JOIN etrs_training_record ON etrs_training_record.employee_num = etrs_initial.emp_id
WHERE etrs_training_record.employee_num = '$employee_num'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
			foreach($stmt->fetchALL() as $j){
				echo '<tr>';
					echo '<td>'.$j['processs'].'</td>';
			echo '</tr>';
			}
	}else{
		echo '<tr>';
			echo '<td colspan="1" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
	}
}

if ($method =='fetch_training_taken_final') {

	$id = $_POST['id'];
	$batch_no = $_POST['batch_no'];
	$provider = $_POST['provider'];
	$employee_num = $_POST['employee_num'];
	$maiden_name = $_POST['maiden_name'];
	$full_name = $_POST['full_name'];
	$gender = $_POST['gender'];
	$department = $_POST['department'];
	$position = $_POST['position'];

	/*$select ="SELECT etrs_training_record.id,etrs_training_record.employee_num,etrs_final.final_process, etrs_final.final_training_date, etrs_final.final_training_ends_dates,etrs_final.final_status, etrs_final.final_remarks
FROM etrs_training_record LEFT JOIN etrs_final ON etrs_training_record.employee_num = etrs_final.emp_id AND etrs_training_record.provider = etrs_final.sp_id  WHERE etrs_training_record.employee_num = '$employee_num' AND etrs_training_record.provider = '$provider'";*/
	$select ="SELECT etrs_training_record.unique_id, etrs_training_record.id,etrs_training_record.employee_num,etrs_final.final_process, etrs_final.final_training_date, etrs_final.final_training_ends_dates,etrs_final.final_status, etrs_final.final_remarks
FROM etrs_training_record LEFT JOIN etrs_final ON etrs_training_record.employee_num = etrs_final.emp_id AND etrs_training_record.provider = etrs_final.sp_id  AND etrs_training_record.unique_id = etrs_final.unique_id WHERE etrs_training_record.id = '$id'";
	$stmt = $conn->prepare($select);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			echo '<tr>';
					echo '<td>'.$j['final_process'].'</td>';
					echo '<td>'.$j['final_training_date'].'</td>';
					echo '<td>'.$j['final_training_ends_dates'].'</td>';
					echo '<td>'.$j['final_status'].'</td>';
					echo '<td>'.$j['final_remarks'].'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="1" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
	}
}

if ($method == 'fetch_needs_final'){
	$id = $_POST['id'];
	$batch_no = $_POST['batch_no'];
	$provider = $_POST['provider'];
	$employee_num = $_POST['employee_num'];
	$maiden_name = $_POST['maiden_name'];
	$full_name = $_POST['full_name'];
	$gender = $_POST['gender'];
	$department = $_POST['department'];
	$position = $_POST['position'];

	$query = "SELECT etrs_final_process.final_processs, etrs_final.final_process, etrs_training_record.employee_num FROM etrs_final_process
LEFT JOIN etrs_final ON etrs_final.final_process != etrs_final_process.final_processs
LEFT JOIN etrs_training_record ON etrs_training_record.employee_num = etrs_final.emp_id
WHERE etrs_training_record.employee_num = '$employee_num'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
			foreach($stmt->fetchALL() as $j){
				echo '<tr>';
					echo '<td>'.$j['final_processs'].'</td>';
			echo '</tr>';
			}
	}else{
		echo '<tr>';
			echo '<td colspan="1" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
	}
}


if ($method =='fetch_training_taken_sb_initial') {

	$id = $_POST['id'];
	$batch_no = $_POST['batch_no'];
	$provider = $_POST['provider'];
	$employee_num = $_POST['employee_num'];
	$maiden_name = $_POST['maiden_name'];
	$full_name = $_POST['full_name'];
	$gender = $_POST['gender'];
	$department = $_POST['department'];
	$position = $_POST['position'];

	/*$select ="SELECT etrs_training_record.id,etrs_training_record.employee_num,etrs_initial_practice.initial_practice_process, etrs_initial_practice.initial_practice_training_date, etrs_initial_practice.initial_practice_training_end_date,etrs_initial_practice.initial_practice_status, etrs_initial_practice.initial_practice_remarks
FROM etrs_training_record
 LEFT JOIN etrs_initial_practice ON etrs_training_record.employee_num = etrs_initial_practice.emp_id AND etrs_training_record.provider = etrs_initial_practice.sp_id WHERE etrs_training_record.employee_num = '$employee_num' AND etrs_training_record.provider = '$provider'";*/
 	$select ="SELECT etrs_training_record.unique_id, etrs_training_record.id,etrs_training_record.employee_num,etrs_initial_practice.initial_practice_process, etrs_initial_practice.initial_practice_training_date, etrs_initial_practice.initial_practice_training_end_date,etrs_initial_practice.initial_practice_status, etrs_initial_practice.initial_practice_remarks
FROM etrs_training_record
 LEFT JOIN etrs_initial_practice ON etrs_training_record.employee_num = etrs_initial_practice.emp_id AND etrs_training_record.provider = etrs_initial_practice.sp_id AND etrs_training_record.unique_id = etrs_initial_practice.unique_id WHERE etrs_training_record.id = '$id'";
	$stmt = $conn->prepare($select);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			echo '<tr>';
					echo '<td>'.$j['initial_practice_process'].'</td>';
					echo '<td>'.$j['initial_practice_training_date'].'</td>';
					echo '<td>'.$j['initial_practice_training_end_date'].'</td>';
					echo '<td>'.$j['initial_practice_status'].'</td>';
					echo '<td>'.$j['initial_practice_remarks'].'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="1" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
	}
}

if ($method == 'fetch_needs_sb_initial'){
	$id = $_POST['id'];
	$batch_no = $_POST['batch_no'];
	$provider = $_POST['provider'];
	$employee_num = $_POST['employee_num'];
	$maiden_name = $_POST['maiden_name'];
	$full_name = $_POST['full_name'];
	$gender = $_POST['gender'];
	$department = $_POST['department'];
	$position = $_POST['position'];

	$query = "SELECT etrs_initial_practice_process.initial_practice_processs, etrs_initial_practice.initial_practice_process, etrs_training_record.employee_num
FROM etrs_initial_practice_process
LEFT JOIN etrs_initial_practice ON etrs_initial_practice.initial_practice_process != etrs_initial_practice_process.initial_practice_processs
LEFT JOIN etrs_training_record ON etrs_training_record.employee_num = etrs_initial_practice.emp_id
WHERE etrs_training_record.employee_num = '$employee_num'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
			foreach($stmt->fetchALL() as $j){
				echo '<tr>';
					echo '<td>'.$j['initial_practice_processs'].'</td>';
			echo '</tr>';
			}
	}else{
		echo '<tr>';
			echo '<td colspan="1" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
	}
}

if ($method =='fetch_training_taken_sb_final') {

	$id = $_POST['id'];
	$batch_no = $_POST['batch_no'];
	$provider = $_POST['provider'];
	$employee_num = $_POST['employee_num'];
	$maiden_name = $_POST['maiden_name'];
	$full_name = $_POST['full_name'];
	$gender = $_POST['gender'];
	$department = $_POST['department'];
	$position = $_POST['position'];

	/*$select ="SELECT etrs_training_record.id,etrs_training_record.employee_num,etrs_final_practice.final_practice_process ,etrs_final_practice.final_practice_training_date,etrs_final_practice.final_practice_training_end_date,etrs_final_practice.final_practice_status,etrs_final_practice.final_practice_remarks FROM etrs_training_record
 LEFT JOIN etrs_final_practice ON etrs_training_record.employee_num = etrs_final_practice.emp_id AND etrs_training_record.provider = etrs_final_practice.sp_id WHERE etrs_training_record.employee_num = '$employee_num' AND etrs_training_record.provider = '$provider'";*/
 	$select ="SELECT etrs_training_record.unique_id, etrs_training_record.id,etrs_training_record.employee_num,etrs_final_practice.final_practice_process ,etrs_final_practice.final_practice_training_date,etrs_final_practice.final_practice_training_end_date,etrs_final_practice.final_practice_status,etrs_final_practice.final_practice_remarks FROM etrs_training_record
 LEFT JOIN etrs_final_practice ON etrs_training_record.employee_num = etrs_final_practice.emp_id AND etrs_training_record.provider = etrs_final_practice.sp_id AND etrs_training_record.unique_id = etrs_final_practice.unique_id WHERE etrs_training_record.id = '$id'";
	$stmt = $conn->prepare($select);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			echo '<tr>';
					echo '<td>'.$j['final_practice_process'].'</td>';
					echo '<td>'.$j['final_practice_training_date'].'</td>';
					echo '<td>'.$j['final_practice_training_end_date'].'</td>';
					echo '<td>'.$j['final_practice_status'].'</td>';
					echo '<td>'.$j['final_practice_remarks'].'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="1" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
	}
}

if ($method == 'fetch_needs_sb_final'){
	$id = $_POST['id'];
	$batch_no = $_POST['batch_no'];
	$provider = $_POST['provider'];
	$employee_num = $_POST['employee_num'];
	$maiden_name = $_POST['maiden_name'];
	$full_name = $_POST['full_name'];
	$gender = $_POST['gender'];
	$department = $_POST['department'];
	$position = $_POST['position'];

	$query = "SELECT etrs_final_practice_process.final_practice_processs, etrs_final_practice.final_practice_process, etrs_training_record.employee_num
FROM etrs_final_practice_process
LEFT JOIN etrs_final_practice ON etrs_final_practice.final_practice_process != etrs_final_practice_process.final_practice_processs
LEFT JOIN etrs_training_record ON etrs_training_record.employee_num = etrs_final_practice.emp_id  
WHERE etrs_training_record.employee_num = '$employee_num'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
			foreach($stmt->fetchALL() as $j){
				echo '<tr>';
					echo '<td>'.$j['final_practice_processs'].'</td>';
			echo '</tr>';
			}
	}else{
		echo '<tr>';
			echo '<td colspan="1" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
	}
}
?>