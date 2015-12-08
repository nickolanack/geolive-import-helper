<?php
include_once dirname(__DIR__) . '/administrator/components/com_geolive/core.php';
include_once Core::LibDir() . DS . 'easycsv' . DS . 'EasyCsv.php';

$csv = EasyCsv::OpenCsv(__DIR__ . DS . 'sites.csv');
Core::LoadPlugin('Maps');
$layers = MapController::GetAllLayers();

$ShowNew = true;
$ShowExisting = false;

?><pre><?php

foreach ($layers as $layer) {
    /* @var $layer Layer */
    print_r(array(
        $layer->getId(),
        $layer->getName()
    ));
}

$layerMap = array(
    'community paper' => 1,
    'daily paper - free' => 1,
    'daily paper - paid' => 1,
    'online' => 4,
    'TV - private' => 3,
    'TV - public' => 3,
    'radio - public' => 2,
    'radio - private' => 2
);

if (!EasyCsv::DistinctValues($csv, 'Name')) {
    die('Expected \'Name\' field to contain unique values');
}

EasyCsv::IterateRows_Assoc($csv, 
    function ($row) use($layerMap, $ShowNew, $ShowExisting) {

        //$typeOfNews=$row['Type of news'];
        $typeOfNews=trim(array_shift(explode(':',$row['0'])));
        
        if (key_exists($typeOfNews, $layerMap)) {
            
            if (MapController::GetFeatureWithName($row['Name'])) {
                if ($ShowSkipped) {
                    echo 'Existing Marker: ' . $row['Name'] . "\n";
                }
                return; // skip.
            } else {}
            
            $marker = new Marker();
            $marker->setCoordinates($row['LAT_Y'], $row['LONG_X'])
                ->setName($row['Name'])
                ->setDescription($row['What happened?'])
                ->setLayerId($layerMap[$typeOfNews]);
            
            if ($ShowNew) {
                echo 'New Marker: ' . print_r(json_encode($marker->getMetadata(), JSON_PRETTY_PRINT)) . "\n";
            }
            
            // MapController::StoreMapFeature($marker);
        } else {
            die('Unknown value in \'Type of News\': ' . $typeOfNews);
        }
    });
?>
</pre>