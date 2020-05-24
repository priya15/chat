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
    	echo "<div class='alert alert-success'>Data added successfully";
    }
	?>
</div>
	<div class="col-md-6">
		<form action="<?php echo base_url()?>edit" method="post">

		<div class="form-class">
			<label>Name:</label>
			<input type="text" name="username" class="form-control" value="<?php echo $userdata[0]["username"]?>" required>
		</div>

		<div class="form-class">
			<label>Email:</label>
			<input type="email" name="email" class="form-control" value="<?php echo $userdata[0]["email"]?>" required>
			<input type="hidden" name="id" class="form-control" value="<?php echo $userdata[0]["id"]?>">
		</div>

		<div class="form-class">
			<label>Password:</label>
			<input type="password" name="password" class="form-control" value="<?php echo md5($userdata[0]["password"])?>" required>
		</div>

		<div class="form-class">
			<input type="submit" value="Edit" class="btn btn-danger">
		</div>
	</div>
</form>
</div>