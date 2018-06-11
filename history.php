<ul>
	<?php
	foreach ($searches as $s) {
	?>
	 <li><a href="search.php?<?php echo $s->toQueryString() ?>">
	 		<?php echo $s->nume?> - <?php echo $s->prenume?> - <?php echo $s->sex?> - <?php echo $s->rol?> - <?php echo $s->cul?> - <?php echo $s->font?> - <?php echo $s->format?>
		  </a></li>
	<?php
	}
	?>
</ul>