<html>
<head>
	<link href="<?php echo base_url()?>/css/bootstrap.min.css" rel="stylesheet">
	<script src="<?php echo base_url()?>/js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><b>Chat</b></a>
    </div>
    <ul class="nav navbar-nav">   
	<?php 
       if(isset($this->session->userdata["userid"])==true){?> 
         <li><a href="<?php echo base_url()?>/dash">Dashboard</a></li>
        
        <li><a href="<?php echo base_url()?>/logout">Logout</a></li>
  <?php   } ?>
    	<?php 
       if(isset($this->session->userdata["userid"])==false){ ?>
          <li><a href="<?php echo base_url()?>/regis">Register</a></li>
          <li><a href="<?php echo base_url()?>/login">Login</a></li>
    <?php   } ?>
    </ul>
  </div>
</nav>
