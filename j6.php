<?php

$lines = file('j6.txt');

/* STAR 1 */
$table = [];
$operatorPosition = count($lines) - 1;
$operators = [];
foreach($lines as $linePosition => $line) {

	$line = trim($line);
	$elements = explode(' ', $line);
	$index = 0;
	$lineElements = [];
	foreach($elements as $key => $element) {
		if(mb_strlen($element) === 0) {
			unset($elements[$key]);
			continue;
		}
		if($linePosition === $operatorPosition) {
			$operators[] = $element;
		} else {
			$lineElements[] = (int)$element;
		}
	}
	if(count($lineElements) > 0) {
		$table[] = $lineElements;
	}
}

$results = array_shift($table);

foreach($table as $line) {
	foreach($line as $key => $value) {
		if($operators[$key] === '+') {
			$results[$key] += $value;
		} else if($operators[$key] === '*') {
			$results[$key] *= $value;
		}
	}
}

var_dump(array_sum($results));


/* STAR 2 */

$lines = file('j6.txt');
$maxLineCount = 0;
foreach($lines as &$line) {
	$line = str_replace("\n", '', $line);
	$maxLineCount = max($maxLineCount, mb_strlen($line));
}

foreach($lines as &$line) {
	$line = str_pad($line, $maxLineCount);
}

$operators = array_values(array_filter(explode(' ', array_pop($lines)), fn($value) => $value));
$results = [];
foreach($operators as $key => $operator) {
	if($operator === '*') {
		$results[$key] = 1;
	} else {
		$results[$key] = 0;
	}
}

$positionInOperators = count($operators) - 1;
for($position = $maxLineCount; $position > 0; $position--) {
	$number = '';
	foreach($lines as &$line) {
		$number .= mb_substr($line, -1);
		$line = mb_substr($line, 0, mb_strlen($line) - 1);
	}

	if(mb_strlen(trim($number)) === 0) {
		$positionInOperators --;
	} else {
		if($operators[$positionInOperators] === '*') {
			$results[$positionInOperators] *= (int)$number;
		} else {
			$results[$positionInOperators] += (int)$number;
		}
	}
}

var_dump(array_sum($results));
