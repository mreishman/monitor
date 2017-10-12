<?php

function eq($first, $second)
{
	return ($first === $second);
}

function get($array, $placeInArray)
{
	return $array[$placeInArray];
}

function _plus($first, $second)
{
	$first .= $second;
	return $first;
}

function filterData($dataInner, $maxRowNum)
{
	$dataInnerNewArrayOfArrays = array();
	$dataInner = explode(" ", $dataInner);
	$dataInnerNew = array();
	$dataInnerLength = count($dataInner);
	$counterForRow = 0;
	$endingText = "";
	for ($i = 0; $i < $dataInnerLength; $i++)
	{
		$addToNewArray = true;
		if (eq(get($dataInner, $i), " ") || eq(get($dataInner, $i), ""))
		{
			$addToNewArray = false;
		}
		if ($addToNewArray)
		{
			if ($counterForRow < $maxRowNum)
			{
				$counterForRow++;
				array_push($dataInnerNew, get($dataInner, $i));
			}
			else
			{
				$filterData = preg_replace('/(\r\n|\n|\r)/', ",", get($dataInner, $i));
				if ( strpos($filterData, ",") > -1)
				{
					$dataInnerNewRow = explode(",", $filterData);
					$counterForRow = 0;
					$endingText = _plus($endingText, get($dataInnerNewRow, 0));
					array_push($dataInnerNew, $endingText);
					array_push($dataInnerNewArrayOfArrays, $dataInnerNew);
					$dataInnerNew = array();
					if (!eq(get($dataInnerNewRow, 1.0), " ") && !eq(get($dataInnerNewRow, 1.0), ""))
					{
						array_push($dataInnerNew, get($dataInnerNewRow, 1));
						$counterForRow++;
					}
					$endingText = "";
				}
				else
				{
					$endingText = _plus($endingText, get($dataInner, $i));
				}
			}
		}
	}
	if (count($dataInnerNew) > 0)
	{
		array_push($dataInnerNewArrayOfArrays, $dataInnerNew);
	}
	return $dataInnerNewArrayOfArrays;
}


?>