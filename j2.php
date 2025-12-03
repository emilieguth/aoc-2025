<?php

	$instructions = explode(',', file_get_contents('j2.txt'));

	/* STAR 1 */

	$invalidIds = [];

	foreach($instructions as $instruction) {

		[$firstId, $lastId] = explode('-', $instruction);
		for($i = (int)$firstId; $i <= (int)$lastId; $i++) {
			for($position = 0; $position < mb_strlen($i); $position++) {
				$currentStr = mb_substr($i, 0, $position);
				if($i === (int)($currentStr.$currentStr)) {
					$invalidIds[] = $i;
					continue;
				}
			}
		}
	}
	var_dump(array_sum($invalidIds));

	/* STAR 2 */

	$instructions = explode(',', file_get_contents('j2.txt'));
	$invalidIds = [];

	foreach($instructions as $instruction) {

		[$firstId, $lastId] = explode('-', $instruction);
		for($i = (int)$firstId; $i <= (int)$lastId; $i++) {
			for($position = 1; $position < mb_strlen($i); $position++) {
				$currentStr = mb_substr($i, 0, $position);
				$repeats = mb_strlen($i) / mb_strlen($currentStr);
				$test = '';
				for($pos = 0; $pos < $repeats; $pos++) {
					$test .= $currentStr;
				}
				if((int)$test === $i) {
					$invalidIds[] = $i;
				}
			}
		}
	}
	$invalidIds = array_unique($invalidIds);
	var_dump(array_sum($invalidIds));
