<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    $_SESSION['loggedIn'] = 0;
}

?>


<?php require_once "Database.php"; ?>
<?php 
$is_admin = 0;
if(isset($_POST['username']) && $_POST['username'] != "") $username = $_POST['username'];
if(isset($_POST['pass']) && $_POST['pass'] != "") $pass = md5($_POST['pass']);


if(isset($username) && isset($pass)){
	$db = new Database();
	$result = $db->checkLogin($username,$pass);
	if(!empty($result)){
		if($result['is_admin'] ==  1) $is_admin = 1;
		$_SESSION['loggedIn'] = 1;
		$_SESSION['fullname'] = $result['fullname'];
	} 
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FrontEndPage</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">

</head>

<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">Navbar</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
    </ul>
  </div>

  <?php 	
  if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1)	{
  	echo "Logged In: " . $_SESSION['fullname'] . "&nbsp;"
  	?>	
		<a href="logout.php" class="btn btn-danger float-right">Log Out</a>
	<?php } else { ?>
   <a href="login.php" class="btn btn-success float-right">Log In</a>&nbsp;
   <?php } ?>

</nav>
<div class="container">
	<div class="row">
		<div class="col-6">
			<h1>My Users</h1>
		</div>
		<div class="col-6">
			<?php if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1) { ?>
			<button type="button" class="btn btn-primary m-1 float-right" data-toggle="modal" data-target="#addModal">Add user</button>
			<?php } ?>
		</div>
	</div>
	<div class="row">
		<div class="col-12" id="showUsers" >
			
				<!-- here was the table -->
			
		</div>
	</div>
</div>

<!-- The Modal -->
<div class="modal" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add new user</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

      	<form action="" method="post" id="add-form">

          <div class="form-group">
            <input type="text" name="fname" class="form-control" placeholder="First Name" required="required">
          </div>
          <div class="form-group">
            <input type="text" name="lname" class="form-control" placeholder="Last Name" required="required">
          </div>
          <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="Email" required="required">
          </div>
      		<div class="form-group">
      			<input type="text" name="phone" class="form-control" placeholder="Phone" required="required">
      		</div>
      		<div class="form-group">
      			<input type="submit" name="insert" id="insert" value="Add user" class="btn btn-danger btn-block">
      		</div>

      	</form>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit User</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

      	<form action="" method="post" id="edit-form">

          <div class="form-group">
            <input type="text" name="fname" id="fname" class="form-control" required="required">
          </div>
          <div class="form-group">
            <input type="text" name="lname" id="lname" class="form-control" required="required">
          </div>
          <div class="form-group">
            <input type="text" name="email" id="email" class="form-control"  required="required">
          </div>
      		<div class="form-group">
      			<input type="text" name="phone" id="phone" class="form-control" required="required">
      		</div>
      		<input type="hidden" name="id" id="id" value="">
      		<div class="form-group">
      			<input type="submit" name="update" id="update" value="Update User" class="btn btn-danger btn-block">
      		</div>

      	</form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<!-- jQuery library -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!--Datatables script -->
<script src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>

<!--SweetAlert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	$(document).ready( function () {

	    showAllUsers();

			function showAllUsers(){
				$.ajax({
		          url:"action.php",
		          type: "POST",
		          data: {action:"view",is_admin:<?php echo $is_admin;?>},
		          success: function(response){
		          	//To be done
		          	// let tabledata = '<table calss="table table-striped">' + response + '</table>';
		          	$('#showUsers').html(response);
		          	$('table').DataTable();
	        			}
	      		 });
			  }

	    // $('table').DataTable();

	    $('#insert').click(function(e) {
	      
	      if($("#insert")[0].checkValidity()){
	        e.preventDefault();
	        $.ajax({
	          url:"action.php",
	          type: "POST",
	          data: $("#add-form").serialize()+"&action=insert",
	          success: function(response){
	            Swal.fire({
	              title: "User added succesfully",
	              icon: "success"
	            });                                 // Delete Semi-column if it doesnt work!
	            $("#addModal").modal("hide");
	            $("#add-form")[0].reset();
	          }
	        });
	        showAllUsers();
	      }
	    });

	    $('body').on("click", ".delBtn",function(e){
	    	e.preventDefault();
	    	var del_id = $(this).attr("id");

	    	Swal.fire({
	    		title:"Are you sure you want to delete this item",
	    		text: "You cannot undo this",
	    		icon:"warning",
	    		showCancelButton: true,
	    		confirmButtonText: "Yes, do it!"
	    	}).then(result =>{
	    		if(result.isConfirmed){
	    		 	$.ajax({
	         	 		url:"action.php",
	         			type: "POST",
	        			data:{del_id:del_id,action:"delete"},
	         			success:function(response){
	         				Swal.fire(
	         					'Deleted!',
	         					'User deleted successfully',
	         					'success'
	         				)
	          				showAllUsers();
	          			}
	        		});
	    		}
	    	})

	    });

	    $('body').on("click", ".editBtn",function(e){
	    	e.preventDefault();
	    	var edit_id = $(this).attr("id");
	    		$.ajax({
	         	 	url:"action.php",
	         		type: "POST",
	        		data:{edit_id:edit_id,action:"edit"},
	         		success:function(response){
	          			//console.log(response);
	          			data = JSON.parse(response);
	          			$('#id').val(data.id);
	          			$('#fname').val(data.first_name);
	          			$('#lname').val(data.last_name);
	          			$('#email').val(data.email);
	          			$('#phone').val(data.phone);

	          		}
	        	});
	    });


	$('#update').click(function(e) {
	      
	      if($("#edit-form")[0].checkValidity()){
	        e.preventDefault();
	        $.ajax({
	          url:"action.php",
	          type: "POST",
	          data: $("#edit-form").serialize()+"&action=update",
	          success: function(response){
	            Swal.fire({
	              title: "User updated succesfully",
	              icon: "success"
	            });                                 // Delete Semi-column if it doesnt work!
	            $("#editModal").modal("hide");
	            $("#edit-form")[0].reset();
	          }
	        });
	        showAllUsers();
	      }
	    });


	}); // end of doc
</script>

</body>
</html>