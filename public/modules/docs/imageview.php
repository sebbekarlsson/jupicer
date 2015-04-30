<title>Viewing image</title>
<?php

	$filename = "";
	$ids = array();
	$imageID = $_GET['imageID'];
	$folder = $_GET['folder'];
	$sql = "SELECT * FROM images WHERE imageID <= $imageID AND folderName='$folder' ORDER BY imageDate DESC LIMIT 3";
	if($folder == "*"){
		$sql = "SELECT * FROM images WHERE imageID <= $imageID ORDER BY imageDate DESC LIMIT 3";
	}
	$result = $db->query($sql);
	$count = 0;
	while(($row = $result->fetch()) != false){
		if($count == 0){
			$filename = $row['imageFilename'];
			$text = $row['imageText'];
			$date = $row['imageDate'];
			$uploader = new User($row['userID']);
			$uploader->fetch_build();
		}
		array_push($ids, $row['imageID']);
		$count++;
	}
	$nextID = $ids[1];

	$comments = array();

	$result = $db->query("SELECT * FROM comments WHERE imageID=$imageID ORDER BY commentDate DESC");
	while(($row = $result->fetch()) != false){
		array_push($comments, $row);
	}

?>
<div class="imageview" style="background-image:url(uploads/<?php echo $filename ?>);">
	<div class="infobox">
		<p>
			<?php echo $text; ?>
		</p>
	</div>
</div>
<nav class="image-data-bar">
	<ul class="left">
		<li class="hide-small">Uploaded by: <span class="orange-text"><?php echo $uploader->username; ?></span></li>
		<li class="hide-small"><?php echo $date; ?></li>
		<li class="hide-small"><a class="barbtn" href="uploads/<?php echo $filename; ?>">Source</a></li>
	</ul>
	<ul class="right">
		<?php if(is_loggedin()){ ?>
		<li><a class="barbtn" id="comment">Comment</a></li>
		<?php } ?>
	</ul>
</nav>
<form method="post" class="image-form">
	<input class="intext" type="text" name="form_comment" placeholder="Comment">
	<?php

		if(isset($_POST['form_comment'])){
			if(!is_loggedin()){
				?>
					<script> alert("You need to be signed in to publish a comment."); </script>
				<?php

				return;
			}
			$comment = new Comment(0);
			$comment->text = $_POST['form_comment'];
			$comment->userID = $USER->id;
			$comment->imageID = $imageID;
			$comment->publish();

			?>
				<script> window.location.href=window.location.href; </script>
			<?php
		}

	?>
</form>
<div class="comment-feed">
	<?php

		foreach ($comments as $i => $comment) {
			$user = new User($comment['userID']);
			$user->fetch_build();
			?>	

				<div class="comment">
					<div class="comment-top">
						<ul class="left">
							<li class="orange-text"><?php echo $user->username; ?></li>
							<li><?php echo $comment['commentDate']; ?></li>
						</ul>
					</div>
					<div class="comment-text">
						<p><?php echo $comment['commentText']; ?></p>
					</div>
				</div>

			<?php
		}

	?>
</div>
<script>
	$(".imageview").click(function(){
		nextImage();
	});

	$("#comment").click(function(){
		$(".image-form").css("display","block");
		$(".image-form").hide().fadeIn();
	});


	function nextImage(){
		var url = window.location.href;
		var imageID = <?php echo $nextID ?>;
		var folder = "<?php echo $folder; ?>";
		window.location.href="index.php?doc=imageview.php&folder="+folder+"&imageID="+imageID;
	}


	function getVar(variable){
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
	}
</script>