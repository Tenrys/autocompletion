<?php

function renderMonster($monster) { ?>
	<li><a href="element.php?id=<?= $monster["id"] ?>">
		<h1 class="subtitle"><img src="icons/<?= $monster["images"][0] ?>" width="24" height="24">&nbsp;<?= $monster["name"] ?></h1>
		<?= isset($monster["info"]) ? "<p>{$monster['info'][0]}</p>" : "" ?>
		<div class="columns mt-0">
			<div class="column">
				<p><b>Elements: </b><?= implode(", ", $monster["elements"]) ?></p>
			</div>
			<div class="column">
				<p><b>Statuts: </b><?= implode(", ", $monster["ailments"]) ?></p>
			</div>
			<div class="column">
				<p><b>Faiblesses: </b><?= implode(", ", $monster["weakness"]) ?></p>
			</div>
		</div>
		<div class="columns">
			<div class="column is-narrow">
				<p><b>Type: </b><?= $monster["type"] ?></p>
			</div>
			<div class="column">
				<p><b>Jeux: </b><?= implode(", ", $monster["games"]) ?></p>
			</div>
		</div>
	</a></li>
<?php }