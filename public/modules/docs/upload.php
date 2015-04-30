<title>Upload image</title>
<div class="content-bg" style="background-image:url(images/fallingstars.gif);">
	<span>
		<form method="post" enctype="multipart/form-data">
			<h1>Upload</h1>
			Select image:
			<input type="file" name="uploaded_file"><br><br>
			<input class="struct intext" name="upload_folder" placeholder="Folder">
			<input class="struct intext" name="upload_text" placeholder="Text"><br>
			<input class="struct btn" name="upload" type="submit" value="Upload">
			<?php

				if(isset($_POST['upload'])){

					if(!is_loggedin()){
						echo "<p>You need to be singed in to do this!</p>";
						return;
					}

					$file = $_FILES['uploaded_file'];
					$foldername = strip_tags(strtolower($_POST['upload_folder']));
					$text = $_POST['upload_text'];

					$folder = new Folder($foldername);
					$folder->make();

					$extensions = array("jpg", "JPG", "jpeg", "JPEG", "png", "bmp", "gif");
					$extension = pathinfo($file['name'], PATHINFO_EXTENSION);

					$newname = random_string(10).".$extension";
					
					if(!in_array($extension, $extensions)){
						echo "<p>This file is bad.</p>";
						return;
					}

					if(strlen($foldername) <= 3){
						echo "<p>Foldername must be at least 3 characters!</p>";
						return;
					}

					if(strlen($foldername) > 120){
						echo "<p>Foldername is too long!</o>";
						return;
					}

					if(substr_count($foldername, "&") > 0){
						echo "<p>Please choose another foldername, this one is ugly.</p>";
						return;
					}

					if(strlen($file['tmp_name']) < 3){
						echo "<p>This file is bad.</p>";
						return;
					}

					if(move_uploaded_file($file['tmp_name'], "uploads/$newname")){
						$dbq = $db->prepare("INSERT INTO images (imageFilename, imageText, folderName, userID) VALUES('$newname', '$text', '$foldername', $USER->id)");
						$dbq->execute();
						$lastID = $db->lastInsertId();
						?>
							<script>
								window.location.href="index.php?doc=imageview.php&folder=<?php echo $foldername ?>&imageID=<?php echo $lastID ?>";
							</script>
						<?php
					}
				}

			?>
		</form>
	</span>
</div>