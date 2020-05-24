<div class="container">
	<div class="col-md-12">
	<?php 
	$data    = $this->session->flashdata("success");
    $dataerr = $this->session->flashdata("error");
    if($dataerr != ""){
      echo "<div class='alert alert-warning'>Please Try again Either Email already Exist</div>";
    }
    else if($data!= "")

    {
    	echo "<div class='alert alert-success'>Your Successfully register to ChatSystem";
    }
	?>
</div>
	<div class="col-md-6">
		<form action="<?php echo base_url()?>regisdata" method="post">

		<div class="form-class">
			<label>Name:</label>
			<input type="text" name="username" class="form-control" required>
		</div>

		<div class="form-class">
			<label>Email:</label>
			<input type="email" name="email" class="form-control" required>
		</div>

		<div class="form-class">
			<label>Password:</label>
			<input type="password" name="password" class="form-control" required>
		</div>
        <br>
		<div class="form-class">
			<input type="submit" value="Register" class="btn btn-danger">
		</div>
	</div>
</form>
</div>