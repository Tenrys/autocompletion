<?php

if (!isset($_GET["id"])) { header("Location: index.php"); die; }

require "includes/render_monster.php";

$monsters = json_decode(file_get_contents("monsters.json"), true);
$monsters = array_map(function($monster, $k) {
	$monster["id"] = $k;
	return $monster;
}, $monsters, array_keys($monsters));

$monster = $monsters[$_GET["id"]] ?? null;

if (!isset($monster)) { header("Location: index.php"); die; }

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
					<div class="menu">
						<ul class="menu-list">
							<?php renderMonster($monster); ?>
						</ul>
					</div>
				</div>
			</section>
		</main>
	</body>
</html>