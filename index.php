<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Autocomplétion Monster Hunter</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.19/lodash.min.js"></script>
		<!-- <script src="https://cdn.jsdelivr.net/npm/fuse.js/dist/fuse.js"></script> -->
	</head>
	<body>
		<main>
			<?php require "includes/hero.php" ?>
			<section class="section">
				<div class="container">
					<div class="columns is-centered">
						<div class="column is-half">
							<div class="columns">
								<form action="recherche.php" class="column my-0">
									<div class="field">
										<div class="control"><input type="text" class="search input" name="search" placeholder="🔎 Rechercher..."></div>
									</div>
								</form>
							</div>
							<div class="columns">
								<div class="column">
									<div class="menu">
										<ul id="autocomplete" class="menu-list"></ul>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</section>
		</main>

		<script src="index.js"></script>
	</body>
</html>