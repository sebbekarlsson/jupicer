<?php

	$folders = folders_fetch(1000000000);

?>
<title>Folders</title>
<div class="text white-text">
	<ul>
		<?php

			foreach ($folders as $i => $folder) {
				?>
					<li><a class="link" href="index.php?doc=imagefeed.php&folder=<?php echo $folder->name; ?>"><?php echo $folder->name; ?> : <?php echo $folder->get_size(); ?></a></li>
				<?php
			}

		?>
	</ul>
</div>