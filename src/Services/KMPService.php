<?php


namespace App\Services;


class KMPService
{
    // Fills lps[] for given patttern pat[0..M-1]
    public function computeLPSArray($pat, $M, &$lps)
    {
        $len = 0;

        $lps[0] = 0;

        $i = 1;
        while ($i < $M) {
            if ($pat[$i] == $pat[$len]) {
                $len++;
                $lps[$i] = $len;
                $i++;
            }
            else
            {
                if ($len != 0) {
                    $len = $lps[$len - 1];
                }
                else
                {
                    $lps[$i] = 0;
                    $i++;
                }
            }
        }

    }
}