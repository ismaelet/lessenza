<?php

$searchWord = $_GET['searchWord'] ?? null;
$results = \Legacy\System\Classes\DB::select(
	"items.id, IF(quantity IS NOT NULL AND quantity > 0 AND receivedDate <= NOW() AND expirationDate > NOW(), 1, 0) as inStock
	FROM items
	LEFT OUTER JOIN item_stocks
		ON items.id = item_stocks.itemId
	WHERE
		name LIKE CONCAT('%',?,'%')
	ORDER BY inStock DESC, name ASC
	LIMIT 7",
	[$searchWord]
);

while ($result = $results->fetch_assoc()) {
	$item = new Product($result['id']);
	$resultName = $item->name;
	$matchPos = strpos(strtolower($resultName), strtolower($searchWord));
	$matchLength = strlen($searchWord);
	$resultName = substr($resultName, 0, $matchPos) . '<strong>' . substr($resultName, $matchPos, $matchLength) . '</strong>' . substr($resultName, $matchPos + $matchLength);
?>

	<a class="h-search_suggestion" href="<?= $item->url ?>">
		<h3><?= $resultName ?></h3>
	</a>

<?php } ?>