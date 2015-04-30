<title>Browsing images</title>
<?php

	if(!(isset($_GET['folder']) || isset($_GET['sort']))){
		$_GET['folder'] = "*";
		$_GET['sort'] = "latest";
	}

	$images = array();

	if($_GET['folder'] == "*" && $_GET['sort'] == "latest"){
		$images = folders_get_images_latest(100);
	}else{
		$images = folder_get_images($_GET['folder']);
	}


?>
<?php if(count($images) > 0){ ?>
<div class="image-feed">	
	<?php
		
		foreach ($images as $i => $img) {
			$size = 100;
			$filename = $img['imageFilename'];
			$image = "thumbs/$filename";
			if(!file_exists("thumbs/$filename")){
				$imeg = "$resizor_location?url=../uploads/$filename&width=$size&height=$size";
				$ch = curl_init($imeg);
				$fp = fopen("thumbs/$filename", 'wb');
				curl_setopt($ch, CURLOPT_FILE, $fp);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_exec($ch);
				curl_close($ch);
				fclose($fp);
			}


			?>
				
				<img id="<?php echo $i; ?>" class="feed-image" imageID="<?php echo $img['imageID']; ?>" src="<?php echo $image; ?>">
				
				
			<?php
		}
	?>
</div>
<?php }else{ ?>
	<div class="text">
		<h1>There was an error</h1>
		<p>
			Something weird happened, or maybe this folder is empty?<br>
			Come back later!
		</p>
	</div>
<?php } ?>
<script>
	$(".feed-image").click(function(){
		var imageID = $(this).attr("imageID");
		var folder = "<?php echo $_GET['folder']; ?>";
		window.location.href="index.php?doc=imageview.php&folder="+folder+"&imageID="+imageID;
	});
</script>