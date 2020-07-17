let monsters;
let timeout;
const autocomplete = $("#autocomplete");
const search = $(".search");

(async () => {
	monsters = await $.ajax("monsters.json");
	monsters = monsters.map((monster, k) => {
		monster.id = k;
		return monster;
	});
})();

search.on("input", evt => {
	if (!autocomplete) return;

	const query = evt.target.value;

	function matches(a) {
		return a.toLowerCase().indexOf(query.toLowerCase()) !== -1;
	}

	if (timeout) {
		clearTimeout(timeout);
	}

	timeout = setTimeout(async () => {
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

		/*
		const fuse = new Fuse(monsters, {
			keys: [
				{ name: "name", weight: 2 },
				"type",
				"games",
				"elements",
				"ailments",
				"weakness",
			],
		});
		let res = fuse.search(query);
		if (res) res = res.map(item => item.item);
		*/

		autocomplete.empty();

		if (res) {
			autocomplete.append(
				`<li><div class="column">${res.length} résultats. (10 affichés uniquement)</div></li>`
			);

			for (const monster of _.sortBy(res, "name").slice(0, 10)) {
				function highlight(a) {
					return a.replace(new RegExp(`(${_.escapeRegExp(query)})`, "gi"), "<b>$1</b>");
				}

				let html = `
					<li><a href="element.php?id=${monster.id}">
						<h1 class="subtitle"><img src="icons/${monster.images[0]}" width="24" height="24">&nbsp;${highlight(
					monster.name
				)}</h1>
						${monster.info && monster.info[0] ? `<p>${highlight(monster.info[0])}</p>` : ""}
					</a></li>
				`;

				autocomplete.append(html);
			}
		}

		timeout = null;
	}, 500);
});
