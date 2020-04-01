<?php
$errMsg = "";
$filename ="";
$filetype = "";
$filesize = "";
if($_SERVER["REQUEST_METHOD"]=="POST" ) {
	if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed = array("jpg", "jpeg" , "gif" , "png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
		if(in_array(pathinfo($filename)["extension"], $allowed)){ 
			if( $filesize < 1024 * 1024 ){
				move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/" . $filename);
			}else{$errMsg = "Invalid file size";}
		}else{$errMsg = "Invalid file type";}
	}else{$errMsg = "File upload failure";}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload Form</title>
	<style>
		.error{color:red;}
	</style>
</head>
<body>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <h2>Upload File</h2>
        <label for="fileSelect">Filename:</label>
        <input type="file" name="photo" id="fileSelect">
        <input type="submit" name="submit" value="Upload">
        <p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 1 MB.</p>
    </form>
	<p class="error"><?php echo $errMsg; ?></p>
	<?php  
			if( !empty($filename) && file_exists("uploads/" . $filename)){
				echo "<img src='" . "uploads/" . $filename . "'> ";
			}
	?>
</body>
</html>