<?php

$inputArray = [[1, 2, 3, 4, 5, 6, 7], [22, 23, 24, 25, 26, 27, 8], [21, 36, 37, 38, 39, 28, 9], [20, 35, 42, 41, 40, 29, 10], [19, 34, 33, 32, 31, 30, 11], [18, 17, 16, 15, 14, 13, 12]];
$result = SpiralReadArray($inputArray);
echo implode(" ", $result);

function SpiralReadArray($inputArray)
{
	$rowsCount = count($inputArray);
	$columnsCount = count($inputArray[0]);
	$result = [$columnsCount * $rowsCount];
	$serchIndex = 0;
	$minColumnIndex = 0;
	$maxColumnIndex = $columnsCount - 1;
	$minRowIndex = 0;
	$maxRowIndex = $rowsCount - 1;
	while (true) {
		if (IsInvalidColumnIndex($maxColumnIndex, $minColumnIndex)) {
			break;
		}

		GetRegularRowArrayValues($inputArray, $minColumnIndex, $maxColumnIndex, $result, $serchIndex, $minRowIndex);
		if (IsInvalidRowIndex($maxRowIndex, $minRowIndex)) {
			break;
		}

		GetRegularColumnArrayValues($inputArray, $minRowIndex, $maxRowIndex, $result, $serchIndex, $maxColumnIndex);
		if (IsInvalidColumnIndex($maxColumnIndex, $minColumnIndex)) {
			break;
		}

		GetReverseRowArrayValues($inputArray, $maxColumnIndex, $minColumnIndex, $result, $serchIndex, $maxRowIndex);
		if (IsInvalidRowIndex($maxRowIndex, $minRowIndex)) {
			break;
		}

		GetReverseColumnArrayValues($inputArray, $minRowIndex, $maxRowIndex, $result, $serchIndex, $minColumnIndex);
	}
	return $result;
}

function IsInvalidColumnIndex($maxColumnIndex, $minColumnIndex)
{
	return $maxColumnIndex - $minColumnIndex < 0;
}

function GetRegularRowArrayValues($inputArray, $minColumnIndex, $maxColumnIndex, &$result, &$serchIndex, &$minRowIndex)
{
	for ($currentColumnIndex = $minColumnIndex; $currentColumnIndex <= $maxColumnIndex; $currentColumnIndex++) {
		$result[$serchIndex++] = $inputArray[$minRowIndex][$currentColumnIndex];
	}
	$minRowIndex++;
}

function IsInvalidRowIndex($maxRowIndex, $minRowIndex)
{
	return $maxRowIndex - $minRowIndex < 0;
}

function GetRegularColumnArrayValues($inputArray, $minRowIndex, $maxRowIndex, &$result, &$serchIndex, &$maxColumnIndex)
{
	for ($currentRowIndex = $minRowIndex; $currentRowIndex <= $maxRowIndex; $currentRowIndex++) {
		$result[$serchIndex++] = $inputArray[$currentRowIndex][$maxColumnIndex];
	}
	$maxColumnIndex--;
}

function GetReverseRowArrayValues($inputArray, $maxColumnIndex, $minColumnIndex, &$result, &$serchIndex, &$maxRowIndex)
{
	for ($currentColumnIndex = $maxColumnIndex; $currentColumnIndex >= $minColumnIndex; $currentColumnIndex--) {
		$result[$serchIndex++] = $inputArray[$maxRowIndex][$currentColumnIndex];
	}
	$maxRowIndex--;
}

function GetReverseColumnArrayValues($inputArray, $minRowIndex, $maxRowIndex, &$result, &$serchIndex, &$minColumnIndex)
{
	for ($currentRowIndex = $maxRowIndex; $currentRowIndex >= $minRowIndex; $currentRowIndex--) {
		$result[$serchIndex++] = $inputArray[$currentRowIndex][$minColumnIndex];
	}
	$minColumnIndex++;
}
