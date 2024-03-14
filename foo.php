<?php

/**
 * @param array $intervals An array of intervals to merge.
 * @return array The merged intervals.
 */
function foo($intervals)
{
    // Sorts the given array of intervals based on the first element of each interval.
    usort($intervals, function ($a, $b) {

        return $a[0] - $b[0];
    });

    $currentInterval = null;
    $result = [];

    foreach ($intervals as $interval) {
        if ($currentInterval === null || $currentInterval[1] < $interval[0]) {
            //new interval
            $currentInterval = $interval;
            $result[] = $currentInterval;
        } else {
            // merge intervals
            $currentInterval[1] = max($currentInterval[1], $interval[1]);
        }
    }
    return $result;
}

// Test cases
$tests = [
    [[0, 5], [3, 10]],  // Attendu: [[0, 10]]
    [[0, 5], [2, 4]],   // Attendu: [[0, 5]]
    [[7, 8], [3, 6], [2, 4]],  // Attendu: [[2, 6], [7, 8]]
    [[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]], // Attendu: [[1, 10], [15, 20]]
];

// Run the tests
foreach ($tests as $test) {
    $result = foo($test);
    echo "Test: " . json_encode($test) . "\n";
    echo "Résultat: " . json_encode($result) . "\n\n";
}
