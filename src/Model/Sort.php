<?php


namespace App\Model;


class Sort
{
    public function bubbleSort(array $arr): array
    {
        $size = count($arr) - 1;
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size - $i; $j++) {
                $k = $j + 1;
                if ($arr[$k] < $arr[$j]) {
                    list($arr[$j], $arr[$k]) = array($arr[$k], $arr[$j]);
                }
            }
        }
        return $arr;
    }


    public function selectSort(array $arr): array
    {
        $size = count($arr);

        for ($i = 0; $i < $size - 1; $i++) {
            $min = $i;

            for ($j = $i + 1; $j < $size; $j++) {
                if ($arr[$j] < $arr[$min]) {
                    $min = $j;
                }
            }

            $temp = $arr[$i];
            $arr[$i] = $arr[$min];
            $arr[$min] = $temp;
        }

        return $arr;
    }


    public function insertSort(array $arr): array
    {
        $count = count($arr);
        if ($count <= 1) {
            return $arr;
        }

        for ($i = 1; $i < $count; $i++) {
            $cur_val = $arr[$i];
            $j = $i - 1;

            while (isset($arr[$j]) && $arr[$j] > $cur_val) {
                $arr[$j + 1] = $arr[$j];
                $arr[$j] = $cur_val;
                $j--;
            }
        }

        return $arr;
    }

    public function quickSort(array $arr): array
    {
        $count = count($arr);
        if ($count <= 1) {
            return $arr;
        }

        $first_val = $arr[0];
        $left_arr = array();
        $right_arr = array();

        for ($i = 1; $i < $count; $i++) {
            if ($arr[$i] <= $first_val) {
                $left_arr[] = $arr[$i];
            } else {
                $right_arr[] = $arr[$i];
            }
        }

        $left_arr = $this->quickSort($left_arr);
        $right_arr = $this->quickSort($right_arr);

        return array_merge($left_arr, array($first_val), $right_arr);
    }


    public function radixSort($array)
    {
        //Create a bucket of arrays
        $bucket = array_fill(0, 9, array());
        $maxDigits = 0;
        //Determine the maximum number of digits in the given array.
        foreach ($array as $value) {
            $numDigits = strlen((string)$value);
            if ($numDigits > $maxDigits)
                $maxDigits = $numDigits;
        }
        $nextSigFig = false;
        for ($k = 0; $k < $maxDigits; $k++) {
            for ($i = 0; $i < count($array); $i++) {
                if (!$nextSigFig)
                    $bucket[$array[$i] % 10][] = $array[$i];
                else
                    $bucket[floor(($array[$i] / pow(10, $k))) % 10][] = $array[$i];
            }
            //Reset array and load back values from bucket.
            $array = array();
            for ($j = 0; $j < count($bucket); $j++) {
                foreach ($bucket[$j] as $value) {
                    $array[] = $value;
                }
            }
            //Reset bucket
            $bucket = array_fill(0, 9, array());
            $nextSigFig = true;
        }
        return $array;
    }
}