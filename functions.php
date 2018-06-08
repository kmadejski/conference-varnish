<?php

declare(strict_types=1);

function parseCSV(int $offset, int $limit): array {
    $csv = array_map('str_getcsv', file('dummy.csv'));
    array_walk($csv, function(&$a) use ($csv) {
        $a = array_combine($csv[0], $a);
    });
    array_shift($csv);
    return array_slice($csv, $offset, $limit);
}

function printCSV(array $csv): string {
    $content = '';
    foreach ($csv as $line) {
        $content .= '<tr>';
        foreach ($line as $field) {
            $content .= '<td>' . $field . '</td>';
        }
        $content .= '</tr>';
    }

    return $content;
}
