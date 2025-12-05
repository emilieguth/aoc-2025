<?php

$instructions = file('j5.txt');

/* STAR 1 */
$table = [];
$ingredients = [];

foreach($instructions as $instruction) {

	$instruction = trim($instruction);
	if(mb_strlen($instruction) === 0) {
		continue;
	}
	if(mb_strpos($instruction, '-')) {
		$values = explode('-', $instruction);
		$table[] = ['min' => (int)$values[0], 'max' => (int)$values[1]];
	} else {
		$ingredients[] = (int)$instruction;
	}

}

$fresh = 0;
foreach($ingredients as $ingredient) {
	foreach($table as $range) {
		if($ingredient >= $range['min'] and $ingredient <= $range['max']) {
			$fresh++;
			break;
		}
	}
}

var_dump($fresh);

/* STAR 2 */

$fresh = [];

foreach($table as $values) {

	$min = $values['min'];
	$max = $values['max'];

	$included = false;

	foreach($fresh as &$freshValues) {

		if($min >= $freshValues['min'] and $min <= $freshValues['max']) {

			$included = true;

			if($max >= $freshValues['min'] and $max <= $freshValues['max']) { // inclus dedans => on se casse
				continue;
			}
			if($max > $freshValues['max']) {
				$freshValues['max'] = $max; // on décale la borne max
				continue;
			}

		} else if($max >= $freshValues['min'] and $max <= $freshValues['max']) {

			$included = true;
			$freshValues['min'] = $min; // on décale la borne min

		}

	}

	if($included === false) {

		$fresh[] = ['min' => $min, 'max' => $max];

	}

	// On parse fresh pour vérifier s'il n'y a pas d'overlap
	$freshParse = $fresh;
	foreach($fresh as $key => &$freshValues) {

		foreach($freshParse as $keyParse => $freshParseValues) {

			$min = $freshParseValues['min'];
			$max = $freshParseValues['max'];

			if($min === $freshValues['min'] and $max === $freshParseValues['max']) {
				continue;
			}

			if($min >= $freshValues['min'] and $min <= $freshValues['max']) {

				unset($fresh[$keyParse]);

				if($max >= $freshValues['min'] and $max <= $freshValues['max']) { // inclus dedans => on se casse
					continue;
				}
				if($max > $freshValues['max']) {
					$freshValues['max'] = $max; // on décale la borne max
					continue;
				}

			} else if($max >= $freshValues['min'] and $max <= $freshValues['max']) {

				unset($fresh[$keyParse]);
				$freshValues['min'] = $min; // on décale la borne min

			}

		}

	}

}

$total = 0;
foreach($fresh as $freshValueDisplay) {
	$total += ($freshValueDisplay['max'] - $freshValueDisplay['min'] + 1);
}

var_dump($total);

