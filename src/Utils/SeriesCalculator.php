<?php


namespace App\Utils;


class SeriesCalculator
{
    /**
     * Calculates the maximum value in series defined as follows:
     * a(1), a(2), ... ,a(n)
     * where
     * a(0) = 0, a(1) = 1, a(2i) = a(i), a(2i+1) = a(i) + a(i+1)
     *
     * @param int $n
     * @return int
     */
    public static function getMax(int $n) : int {
        $data = [0, 1];

        for ($i = 2; $i <= $n; $i++) {
            $data[] = $data[intdiv($i, 2)] + $data[($i % 2) === 1 ? intdiv($i, 2)+1 : 0];
        }

        return max($data);
    }
}