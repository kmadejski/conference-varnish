<?php

declare(strict_types=1);

include 'functions.php';

$offset = $_GET['offset'];
$limit = $_GET['limit'];

$csv = parseCSV((int) $offset, (int) $limit);

$content = '
<html>
    <body>
        <table>
            <thead>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </thead>
            <tbody>'
                . printCSV($csv) .
            '</tbody>
        </table>
    </body>
</html>';

header('Cache-Control: public, max-age=1800');
echo $content;
