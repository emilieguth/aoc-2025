<?php

	$instructions = file('j4.txt');

	/* STAR 1 */
	$table = [];

	foreach($instructions as $instruction) {

		$instruction = trim($instruction);
		$row = [];
		for($i = 0; $i < mb_strlen($instruction); $i++) {
			$row[] = mb_substr($instruction, $i, 1);
		}

		$table[] = $row;

	}

	$nbRoll = 0;
	$tableCopy = $table;

	foreach($table as $row => $rowData) {
		foreach($rowData as $col => $value) {

			echo $value;

			if($value !== '@') {
				continue;
			}

			$nbAdjacents = 0;

			for($currentRow = $row - 1; $currentRow <= $row + 1; $currentRow++) {
				for($currentCol = $col - 1; $currentCol <= $col + 1; $currentCol++) {

					if(
						isset($table[$currentRow][$currentCol]) === FALSE
						or ($currentRow === $row and $currentCol === $col)
					) {
						continue;
					}

					if($table[$currentRow][$currentCol] === '@') {
						$nbAdjacents++;
					}

					if($nbAdjacents >= 4) {
						break 2;
					}

				}
			}

			if($nbAdjacents < 4) {
				$tableCopy[$row][$col] = 'x';
				$nbRoll++;
			}
		}
		echo "\n";
	}

	echo "\n";

	for($row = 0; $row < count($table); $row++) {
		for($col = 0; $col < count($table[$row]); $col++) {
			echo $tableCopy[$row][$col];
		}
		echo "\n";
	}

	var_dump($nbRoll);



	/* STAR 2 */
	$table = [];

	foreach($instructions as $instruction) {

		$instruction = trim($instruction);
		$row = [];
		for($i = 0; $i < mb_strlen($instruction); $i++) {
			$row[] = mb_substr($instruction, $i, 1);
		}

		$table[] = $row;

	}

	$nbRoll = 0;
	$tableCopy = $table;

	$hasRemoved = TRUE;

	while($hasRemoved) {

		$hasRemoved = FALSE;

		foreach($table as $row => $rowData) {
			foreach($rowData as $col => $value) {

				echo $value;

				if($value !== '@') {
					continue;
				}

				$nbAdjacents = 0;

				for($currentRow = $row - 1; $currentRow <= $row + 1; $currentRow++) {
					for($currentCol = $col - 1; $currentCol <= $col + 1; $currentCol++) {

						if(
							isset($table[$currentRow][$currentCol]) === FALSE
							or ($currentRow === $row and $currentCol === $col)
						) {
							continue;
						}

						if($table[$currentRow][$currentCol] === '@') {
							$nbAdjacents++;
						}

						if($nbAdjacents >= 4) {
							break 2;
						}

					}
				}

				if($nbAdjacents < 4) {
					$table[$row][$col] = 'x';
					$nbRoll++;
					$hasRemoved = TRUE;
				}
			}
			echo "\n";
		}
	}


	echo "\n";

	for($row = 0; $row < count($table); $row++) {
		for($col = 0; $col < count($table[$row]); $col++) {
			echo $tableCopy[$row][$col];
		}
		echo "\n";
	}

	var_dump($nbRoll);

