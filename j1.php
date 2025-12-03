<?php

	/* STAR 1 */

	$instructions = file('./j1.txt');
	$start = 50;
	$zeroPositionCount = 0;

	$position = $start;
	foreach($instructions as $instruction) {

		$instruction = trim($instruction);
		$direction = mb_substr($instruction, 0, 1);
		$number = (int)mb_substr($instruction, 1);

		if($direction === 'L') {
			$position -= $number;
		} else {
			$position += $number;
		}

		$position %= 100;

		if($position === 0) {
			$zeroPositionCount++;
		}

	}

	var_dump($zeroPositionCount);

	/* STAR 2 */

	$instructions = file('./j1.txt');
	$start = 50;
	$zeroPositionCount = 0;

	$position = $start;
	foreach($instructions as $instruction) {

		$instruction = trim($instruction);
		$direction = mb_substr($instruction, 0, 1);
		$number = (int)mb_substr($instruction, 1);

		if($direction === 'L') {
			for($i = 1; $i <= $number; $i++) {
				$position -= 1;
				if($position < 0) {
					$position = 99;
				}
				if($position === 0) {
					$zeroPositionCount++;
				}
			}
		} else {
			for($i = 1; $i <= $number; $i++) {
				$position += 1;
				if($position > 99) {
					$position = 0;
				}
				if($position === 0) {
					$zeroPositionCount++;
				}
			}
		}
	}
	var_dump($zeroPositionCount);
