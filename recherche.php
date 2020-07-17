<?php

if (!isset($_GET["search"])) { header("Location: index.php"); die; }

require "includes/render_monster.php";

$monsters = json_decode(file_get_contents("monsters.json"), true);
$monsters = array_map(function($monster, $k) {
	$monster["id"] = $k;
	return $monster;
}, $monsters, array_keys($monsters));

function matches($a) {
	return !!stristr($a, $_GET["search"]);
}

$res = array_filter($monsters, function($monster) {
	if (matches($monster["name"])) return true;
	if (matches($monster["type"])) return true;

	foreach (["games", "elements", "ailments", "weakness", "info"] as $field) {
		if (isset($monster[$field])) {
			foreach ($monster[$field] as $str) {
				if (matches($str)) return true;
			}
		}
	}

	return false;
});

/*
const res = monsters.filter(monster => {
	if (matches(monster.name)) return true;
	if (matches(monster.type)) return true;
	for (const field of ["games", "elements", "ailments", "weakness", "info"]) {
		if (monster[field]) {
			for (const str of monster[field]) {
				if (matches(str)) return true;
			}
		}
	}

	return false;
});
*/

?>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Autocomplétion Monster Hunter</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
	</head>
	<body>
		<main>
			<?php require "includes/hero.php" ?>
			<section class="section">
				<div class="container">
					<div class="columns">
						<div class="column is-half">
							<div class="menu">
								<ul class="menu-list">
									<li><div class="column"><?= count($res) ?> résultats.</div></li>
									<?php foreach ($res as $monster) {
										renderMonster($monster);
									} ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
		</main>
	</body>
</html>