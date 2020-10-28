<?php

$result = [];
$points = [];

// prefill correct results per round and cards
if (($handle = fopen("dixit.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

        // ignore csv header
        if ($data[0] == "round") {
            continue;
        }

        // prepare arrays if not selected yet
        if (!isset($result[$data[0]])) {
            $result[$data[0]] = [];
            $result[$data[0]]['was_selected'] = [];
        }
        // save correct card
        $result[$data[0]]['correct'] = $data[1];

        // get selected cards except of person of interest
        if (isset($data[4])) {
            $result[$data[0]]['was_selected'][] = $data[4];
        }
    }
    fclose($handle);
}

// calculate points
if (($handle = fopen("dixit.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

        // ignore csv header
        if ($data[0] == "round") {
            continue;
        }

        // check if the color already has points
        if (!isset($points[$data[2]])) {
            $points[$data[2]] = 0;
        }

        // check if the color selected correctly
        if ($result[$data[0]]['correct'] === $data[3] && isset($data[4])) {
            $points[$data[2]] += 3;
        }

        // check if it was the turn of the person
        if ($result[$data[0]]['correct'] == $data[3] && !isset($data[4])) {
            $points[$data[2]] += 3;
        }

        if (isset($data[4])) {
            // check if anybody else selected you
            $points[$data[2]] += count(array_filter($result[$data[0]]['was_selected'], function ($a) use ($data) {
                return $a === $data[3];
            }));
        }
    }
    fclose($handle);
}

print_r($result);
print_r($points);
