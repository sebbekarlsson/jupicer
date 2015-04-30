<?php $folders = folders_fetch(100); ?>
<div class="menu">
	<ul>
		<li><a class="menubtn" href="index.php?doc=imagefeed.php&sort=latest&folder=*"><span>Latest</span></a></li>
		<?php

			foreach ($folders as $i => $folder) {
				?>
					<li><a class="menubtn" href="index.php?doc=imagefeed.php&folder=<?php echo $folder->name; ?>"><span><?php echo $folder->name; ?></span></a></li>
				<?php
			}

		?>
	</ul>
</div>