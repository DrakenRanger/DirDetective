<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon"  href="images/dirdetective.png">
		<title>DirDetective</title>
		<script type="text/javascript" src="jquery/jquery.js"></script>
		<script type="text/javascript" src="index.js"></script>
		<link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
			<div class="offcanvas-header">
				<h5 class="offcanvas-title" id="offcanvasTopLabel">How to Use <b><u><i>DirDetective</i></u></b></h5>
				<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body">
				<ul class="list-group list-group-flush">
                          <li class="list-group-item">
                          	<b>Enter URL:</b> Input the website URL in the "ADD URL" section. Remove http://, https://, or trailing slashes (/). For example, enter www.example.com instead of www.example.com/.
                          </li>
                          <li class="list-group-item">
                          	<b>Enable Extension Search (Optional):</b> To search specific extensions (e.g., index.php or search.php), enable the "Use Any Extension?" button.
                          </li>
                          <li class="list-group-item">
                          	<b>Input Extension:</b> Once enabled, enter the desired extension in the provided input field. Use only the name, e.g., php or html (omit dots or special characters).
                          </li>
                          <li class="list-group-item">
                          	<b>Select Wordlist:</b> Choose a wordlist from the provided options. Alternatively, upload a custom wordlist (note: custom wordlists will be deleted after a while).
                          </li>
                          <li class="list-group-item"><b>Start Busting:</b> Click the "Blast" button to initiate the process.</li>
                          <li class="list-group-item"><b>View Results:</b> The discovered links will appear in the "Finding Links" table.</li>
                          <li class="list-group-item"><b>Stop Busting:</b> Use the "STOP Busting" button to halt the process.</li>
                          <li class="list-group-item">
                            <b>Session Management:</b> Before starting a new session, reload the page or click the "Reload" button to generate a new session. This step is mandatory for subsequent searches.
                          </li>
                          <li class="list-group-item">
                             <b>Read Instructions:</b> Click the "How to Use?" button anytime for guidance
                          </li>
                        </ul>
                        <hr>
                        <br>
                        <b>Enjoy responsibly and stay tuned for more crazy tools!</b>
			</div>
		</div>
		<!-- This Section For Heading and Form Section -->
		<div class="logo">
			<img src="images/dirdetective.png" width="200" height="200">
		</div>
		<div class="container">
			<h1 class="text-center text-danger mt-sm-4 mt-md-3 mt-lg-0" id="header">DirDetective</h1>
			<marquee id="warning"><p>Warning: Use responsibly. Unauthorized use may lead to legal issues. Author isn’t responsible.</p></marquee>
			<div class="row mt-5 d-flex justify-content-center">
				<!-- Starting of URL Giving Form -->
				<div class="col-sm-12 col-md-7 col-lg-5 mt-sm-4 mt-md-2 mt-lg-0">
					<div class="shadow p-5 mb-5 bg-body-tertiary rounded">
						<div class="input-group mb-3">
							<input type="text" class="form-control" placeholder="Add URL" aria-describedby="button-addon2" id="input-url">
						</div>
						<select class="form-select mt-3" aria-label="Default select example" id="wordlist">
							<option value="" selected>Choose Wordlist</option>
							<?php
							$files = glob("wordlists/*");
							print_r($files);
							$n = count($files);
							for ($i=0; $i < $n; $i++) {
							$data = $files[$i];
							$data = explode("/", $data);
							$data = $data[1];
							echo "<option value='".$data."'>".$data."</option>";
							}
							?>
						</select>
						<div class="form-check form-switch mt-3">
							<input class="form-check-input" type="checkbox" role="switch" id="extDes">
							<label class="form-check-label" for="flexSwitchCheckDefault">You Want To Use Any Extension?</label>
						</div>
						<div class="input-group mt-3">
							<input type="text" class="form-control" placeholder="Give Extension" aria-describedby="button-addon2" id="extension">
						</div>
						<div class="d-grid gap-2 mt-3">
							<button class="btn btn-primary" type="button" id="blast">BLAST</button>
						</div>
					</div>
				</div>
				<!-- Starting of URL Giving Form -->
				<div class="col-sm-12 col-md-7 col-lg-5 mt-5 mb-5">
					<div class="row">
						<label>Import Custom Wordlist:</label>
					</div>
					<form method="POST" enctype="multipart/form-data">
						<div class="input-group  shadow p-5 bg-body-tertiary rounded">
							<input type="file" class="form-control" id="list" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="list">
							<button class="btn btn-outline-secondary" type="submit" name="upload">Upload</button>
						</div>
					</form>
					<div class="row mt-2 p-4">
						<button class="btn btn-danger glow-effect" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
						      <b>How To Use It?</b>
					      </button>
					</div>
				</div>
			</div>
		</div>
		<!-- End of Heading and Form Section -->
		<div class="conatiner-fluid">
			<div class="row d-flex justify-content-center">
				<div class="col-sm-12 col-lg-7 shadow p-5 mb-5 bg-body-tertiary rounded" id="table_pannel">
					<div class="alert alert-success" role="alert" id="alert">
						Busting Stopped Successfully
					</div>
					<button class="btn btn-info" id="restore-btn">RESTORE<img src="images/restore.svg"></button>
					<button class="btn btn-danger" id="stop-btn">STOP BUSTING</button>
					<h3 class="text-center p-3">Finding Links</h3>
					<table class="table table-hover" id="output_table">
						<thead>
							<tr class="table-dark">
								<th scope="col">Sl. No.</th>
								<th scope="col">Link</th>
								<th scope="col">Status Code</th>
								<th scope="col">Visit</th>
							</tr>
						</thead>
						<tbody id="link-tbody">
							<tr>
								<th colspan="4" class="text-center">Do Your Work First</th>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="bootstrap/bootstrap.js"></script>
	</body>
</html>
<?php
if(isset($_REQUEST['upload'])){
if($_FILES['list']['name'] != null){
$file = $_FILES['list']['name'];
$ext = explode(".",$file);
$ext = $ext[1];
$ext = strtolower($ext);
if($ext == "txt"){
move_uploaded_file($_FILES['list']['tmp_name'], "wordlists/".$_FILES['list']['name']);
echo "<script>
location.href='index.php';
</script>";
}else{
echo "<script>
alert('Upload `.txt` file only');
location.href='index.php';
</script>";
}
}
}
?>