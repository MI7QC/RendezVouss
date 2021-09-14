<?php
include 'database.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>PHP Tutorial</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<h4>Excel Upload Rendez-Vous</h4>
			<!--  affichage du message  succes si requete sql a passé-->
			<div class="container-full-width">
				<?php if (isset($_GET['message'])) { ?>
					<span class="message"><?php echo $_GET['message']; ?></span>
				<?php } ?>
			</div>
		<hr>
	<form method="post" action="file-upload-Solo.php" enctype="multipart/form-data">
		<div class="form-group row">
			<label class="col-md-3">Select File</label>
			<div class="col-md-8">
				<input type="file" name="file-upload-Solo" class="form-control"/>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-3"></label>
			<div class="col-md-8">
				<input type="submit" name="submit" class="btn btn-primary">
			</div>
		</div>
	</form>
		</div>
	</div>

	<form action="file-upload.php" method="post">
		<label class="col-md-3">Colect all folder</label>
    	<input type="submit" name="someAction"   class="btn btn-primary" />
	</form>
</div>
<!-- <script src="script/main.js"></script> -->
</body>
</html>