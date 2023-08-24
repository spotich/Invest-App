<?php

namespace InvestApp\application\traits;

trait SortingStringsTrait
{
    private function sortStrings(array $strings): array
    {
        uasort($strings, function ($a, $b) {
            if (strlen($a) === strlen($b)) {
                return 0;
            }
            return (strlen($a) < strlen($b)) ? -1 : 1;
        });
        return $strings;
    }
}