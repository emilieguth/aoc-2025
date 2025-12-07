<?php

function print_table($table) {
	echo "\n\nTABLE\n";
	foreach($table as $line) {
		echo $line."\n";
	}
}

$lines = file('j7.txt');

/* STAR 1 */
$table = [];
foreach($lines as $line) {

	$line = trim($line);
	$table[] = $line;
}

print_table($table);

$table[0] = str_replace('S', '|', $table[0]);

$nSplit = 0;
$nTimelines = 0;

foreach(array_keys($table) as $positionLine) {

	if(isset($table[$positionLine + 1]) === FALSE) {
		break;
	}

	$line = $table[$positionLine];

	for($position = 0; $position < mb_strlen($line); $position++) {

		if(mb_substr($line, $position, 1) === '|') {
			$currentNextLine = $table[$positionLine + 1];

			if(mb_substr($currentNextLine, $position, 1) === '.') {

				$newNextLine = '';
				$newNextLine .= mb_substr($table[$positionLine + 1], 0, $position);
				$newNextLine .= '|';
				$newNextLine .= mb_substr($table[$positionLine + 1], $position + 1);
				$table[$positionLine + 1] = $newNextLine;

			} elseif(mb_substr($currentNextLine, $position, 1) === '^') {
				$nSplit++;
				$newNextLine = '';
				$newNextLine .= mb_substr($table[$positionLine + 1], 0, $position - 1);
				$newNextLine .= '|';
				$newNextLine .= mb_substr($table[$positionLine + 1], $position, 1);
				$newNextLine .= '|';
				$newNextLine .= mb_substr($table[$positionLine + 1], $position + 2, mb_strlen($table[$positionLine + 1]) - $position - 2);
				$table[$positionLine + 1] = $newNextLine;

			}
		}
	}

}

print_table($table);

var_dump($nSplit);


/* STAR 2 */

function dd(...$args) {
	foreach($args as $arg) {
		var_dump($arg);
	}
	exit;
}
function d(...$args) {
	foreach($args as $arg) {
		var_dump($arg);
	}
}

$parentsStock = [];
foreach($table as $key => $line) {
	for($i = 0; $i < mb_strlen($line); $i++) {
		$parentsStock[$key][$i] = 0;
	}
}

print_table($table);

foreach($table as $key => $line) {

	d('-----key : '.$key);

	for($i = 0; $i < mb_strlen($line); $i++) {

		if(mb_substr($line, $i, 1) === '|') {

			if($key === 0) {

				$parentsStock[$key][$i] = 1;

			} else {

				$parentsStock[$key][$i] = $parentsStock[$key - 1][$i];

				if($i > 0 and mb_substr($line, $i - 1, 1) === '^') {

					$parentsStock[$key][$i] += $parentsStock[$key - 1][$i - 1];

				}

				if($i + 1 < mb_strlen($line) and mb_substr($line, $i + 1, 1) === '^') {

					$parentsStock[$key][$i] += $parentsStock[$key - 1][$i + 1];

				}
			}
		}

	}

}
var_dump(array_sum($parentsStock[count($table) - 1]));

//-------------- VERSION NON OPTIMISÉE --------------\\

/*function countParents(array $table, int $positionLine, int $position) {

	if($positionLine === 0) {
		return 1;
	}

	if($position === 0) {
		$avant = 0;
	} elseif($table[$positionLine - 1][$position - 1] === '|' and $table[$positionLine][$position - 1] === '^') {
		$avant = countParents($table, $positionLine - 1, $position - 1);
	} else {
		$avant = 0;
	}

	if($table[$positionLine - 1][$position] === '|') {
		$pendant = countParents($table, $positionLine - 1, $position);
	} else {
		$pendant = 0;
	}

	if($position === mb_strlen($table[$positionLine]) - 1) {
		$apres = 0;
	} elseif($table[$positionLine - 1][$position + 1] === '|' and $table[$positionLine][$position + 1] === '^') {
		$apres = countParents($table, $positionLine - 1, $position + 1);
	} else {
		$apres = 0;
	}
	return $avant + $pendant + $apres;
}

$endLine = array_reverse($table)[0];
$count = 0;

for($position = 0; $position < mb_strlen($endLine); $position++) {
	if(mb_substr($endLine, $position, 1) !== '|') {
		continue;
	}
	$parents = countParents($table, count($table) - 1, $position);
	$count += countParents($table, count($table) - 1, $position);
	d('position = '.$position.' : '.$parents);
}
var_dump($count);*/
