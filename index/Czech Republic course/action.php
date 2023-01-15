<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
   
}
?>
<?php
require_once "Database.php";
$db = new Database();


if(isset($_POST['action']) && $_POST['action'] == "insert"){
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$db->insert($fname,$lname,$email,$phone);
}


if(isset($_POST['action']) && $_POST['action'] == "view"){

	$is_admin = $_POST['is_admin'];
	$output = "";
	$data = $db->read();

	$output .= '<table class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>E-mail</th>
						<th>Phone</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';

	foreach ($data as $row) { 

		$output .= '<tr>
			<td>' . $row["id"] . '</td>
			<td>' . $row["first_name"] . '</td>
			<td>' . $row["last_name"] . '</td>
			<td>' . $row["email"] . '</td>
			<td>' . $row["phone"] . '</td>
			<td>';

			if(isset($_SESSION['loggedIn'])
				&&
				$_SESSION['loggedIn'] == 1
				&&
				$is_admin = 1

			){
				
				$output .= 
				'<button class="btn btn-primary editBtn" id="'.$row["id"].'" data-toggle="modal" data-target="#editModal">Edit</button>&nbsp;
				<button class="btn btn-danger delBtn" id="'.$row["id"].'">Delete</button>';
			}


		$output .=	'</td>
			</tr>';
	}
	
	$output .= '</tbody>
			</table>';

	echo $output;

}

if(isset($_POST['action']) && $_POST['action'] == "delete"){
	$del_id = $_POST['del_id'];
	$db->delete($del_id);
}

if(isset($_POST['action']) && $_POST['action'] == "edit"){
	$edit_id = $_POST['edit_id'];
	$row= $db->getUserbyId($edit_id);
	echo $row;
}


if(isset($_POST['action']) && $_POST['action'] == "update"){
	$id = $_POST['id'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$db->update($id,$fname,$lname,$email,$phone);
}

?>