<?php
include_once dirname(__DIR__) . '/administrator/components/com_geolive/core.php';

include_once Core::LibDir() . DS . 'easycsv' . DS . 'EasyCsv.php';

$csv = EasyCsv::OpenCsv(__DIR__ . DS . 'sites.csv');

Core::LoadPlugin('Maps');
Core::LoadPlugin('Attributes');
?><pre><?php

print_r(EasyCsv::GetHeader($csv));

// foreach (array_diff(EasyCsv::GetHeader($csv), array(
// 'id',
// 'Name',
// 'LAT_Y',
// 'LONG_X',
// 'What happened?'
// )) as $field) {
// echo $field;
// $u = EasyCsv::DistinctValues($csv, $field);
// sort($u);
// print_r($u);
// }

// $icons = EasyCsv::DistinctValues($csv, 'Icon');

// sort($icons);
// print_r($icons);

$tableMetadata = AttributesTable::GetMetadata('newsAttributes');

EasyCsv::IterateRows_Assoc($csv, 
    function ($row) use($tableMetadata) {
        
        $marker = MapController::GetFeatureWithName($row['Name']);
        if (!$marker) {
            echo 'no marker for row: ' . print_r($row, true);
        }
        
        $urls = array();
        if (!empty($row['Source 1'])) {
            $urls[] = $row['Source 1'];
        }
        if (!empty($row['Source 2'])) {
            $urls[] = $row['Source 2'];
        }
        
        $date = strtotime($row['Date']);
        
        $attributes = array(
            'paperType' => $row['Type of news'],
            'transitionType' => $row['Transition'],
            'transitionDate' => date('Y-m-d', $date),
            'owner' => $row['Ownership'],
            'community' => $row['Town'],
            'url' => $urls
        );
        
        // AttributesRecord::Set($marker->getId(), $marker->getType(), $attributes, $tableMetadata);
    });

?>


</pre>