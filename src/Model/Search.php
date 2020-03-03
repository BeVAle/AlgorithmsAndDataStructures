<?php


namespace App\Model;


use App\Services\KMPService;

class Search
{
    /**
     * @param string $pat
     * @param string $txt
     * @param int $simpleInt
     * @return string
     */
    public function rabinSearch(string $pat, string $txt, int $simpleInt = 101): string
    {
        $M = strlen($pat);
        $N = strlen($txt);
        $p = 0;
        $t = 0;
        $h = 1;
        $d = 1;

        for ($i = 0; $i < $M - 1; $i++) {
            $h = ($h * $d) % $simpleInt;
        }

        for ($i = 0; $i < $M; $i++) {
            $biPat = ord($pat[$i]);
            $biTxt = ord($txt[$i]);
            $p = ($d * $p + $biPat) % $simpleInt;
            $t = ($d * $t + $biTxt) % $simpleInt;
        }

        for ($i = 0; $i <= $N - $M; $i++) {
            if ($p == $t) {
                for ($j = 0; $j < $M; $j++) {
                    if ($txt[$i + $j] != $pat[$j]) {
                        break;
                    }
                }
                if ($j == $M) {
                    return "index: " . $i;
                }
            }

            if ($i < $N - $M) {
                $t = ($d * ($t - ord($txt[$i]) * $h) + ord($txt[$i + $M])) % $simpleInt;
                if ($t < 0) {
                    $t = ($t + $simpleInt);
                }
            }
        }

        return "Nity";
    }

    /**
     * @param $pat
     * @param $txt
     * @return string
     */
    public function mooreSearch($pat, $txt): string
    {
        return "Nity";
    }

    /**
     * @param $pat
     * @param $txt
     * @return string
     */
    public function KMPSearch($pat, $txt): string
    {
        $M = strlen($pat);
        $N = strlen($txt);
        $lps = array_fill(0, $M, 0);

        (new KMPService())->computeLPSArray($pat, $M, $lps);

        $i = 0;
        $j = 0;
        while ($i < $N) {
            if ($pat[$j] == $txt[$i]) {
                $j++;
                $i++;
            }

            if ($j == $M) {
               return "Index " . ($i - $j);
            }
            else if ($i < $N && $pat[$j] != $txt[$i]) {
                if ($j != 0)
                    $j = $lps[$j - 1];
                else
                    $i = $i + 1;
            }
        }

        return "Nity";
    }

}