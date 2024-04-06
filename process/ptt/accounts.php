<?php
	include '../conn.php';

	$method = $_POST['method'];

if ($method == 'fetch_accounts') {
	$full_name = $_POST['full_name'];
	$c = 0;
	$query = "SELECT * FROM etrs_account WHERE fname LIKE '$full_name%' AND section = 'PTT'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;

			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" onclick="get_account(&quot;'.$j['id'].'~!~'.$j['username'].'~!~'.$j['password'].'~!~'.$j['role'].'~!~'.$j['fname'].'&quot;)">';
					echo '<td>'.$c.'</td>';
					echo '<td>'.$j['username'].'</td>';
					echo '<td>'.$j['fname'].'</td>';
					// echo '<td>'.$j['password'].'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="3">No Result</td>';
		echo '</tr>';
	}
}

if ($method == 'register') {
	$full_name = $_POST['full_name'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$check = "SELECT id FROM etrs_account WHERE username = '$username'";
	$stmt = $conn->prepare($check);
	$stmt->execute();
	if($stmt->rowCount() > 0){
		echo 'Training Record Already Exist!';
	}else{
		$query = "INSERT INTO etrs_account (`username`,`password`,`section`,`fname`) VALUES ('$username','$password','PTT','$full_name')";
		$stmt2 = $conn->prepare($query);
		if ($stmt2->execute()) {
			echo 'success';
		}else{
			echo 'error';
		}
	}
}


if ($method == 'update_account') {
	$id = $_POST['id'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$fname = $_POST['fname'];

	

	$update ="UPDATE etrs_account SET username = '$username', password = '$password', fname = '$fname', section = 'PTT' WHERE id = '$id'";
	$stmt = $conn->prepare($update);
	if($stmt->execute()){
		echo 'success';
	}else{
		echo 'error';
	}
}

$conn = NULL;
?>