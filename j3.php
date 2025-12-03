<?php

	$instructions = file('j3.txt');

	/* STAR 1 */
	$maxes = [];

	foreach($instructions as $instruction) {

		$instruction = trim($instruction);

		$values = [];
		for($i = 0; $i < mb_strlen($instruction); $i++) {
			for($j = $i + 1; $j < mb_strlen($instruction); $j++) {
				$values[] = (int)mb_substr($instruction, $i, 1).mb_substr($instruction, $j, 1);
			}
		}

		$maxes[] = max($values);
	}
	var_dump(array_sum($maxes));

	/* STAR 2 */
	$sum = 0;
	foreach($instructions as $instruction) {

		$instruction = trim($instruction);
		$values = [];
		for($i = 0; $i < mb_strlen($instruction); $i++) {
			$values[] = mb_substr($instruction, $i, 1);
		}

		$value = '';
		for($i = 0; $i < 12; $i++) {
			$currentMaxValue = max(array_slice($values, 0, count($values) - (12 - $i) + 1));
			$currentMaxPos = array_find_key($values, fn($val) => (int)$val === (int)$currentMaxValue);
			$values = array_slice($values, $currentMaxPos+1, count($values));
			$value .= $currentMaxValue;
		}
		$sum += (int)$value;
	}

	var_dump($sum);
