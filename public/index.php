<?php
/**
 * Created by PhpStorm.
 * User: Holubar
 * Date: 07.03.21
 * Time: 9:48
 */

require "../vendor/autoload.php";

$track1 = new stdClass();
$track1->startLocation = "Fazenda São Francisco Citros, Brazil";
$track1->endLocation = "São Paulo–Guarulhos International Airport, Brazil";
$track1->transportMethod = "Truck";
$track1->deliveryCompany = "Correios";

$track2 = new stdClass();
$track2->startLocation = "São Paulo–Guarulhos International Airport, Brazil";
$track2->endLocation = "Porto International Airport, Portugal";
$track2->transportMethod = "Flight";
$track2->deliveryCompany = "LATAM";

$track3 = new stdClass();
$track3->startLocation = "Porto International Airport, Portugal";
$track3->endLocation = "Adolfo Suárez Madrid–Barajas Airport, Spain";
$track3->transportMethod = "Van";
$track3->deliveryCompany = "AnyVan";

$track4 = new stdClass();
$track4->startLocation = "Adolfo Suárez Madrid–Barajas Airport, Spain";
$track4->endLocation = "London Heathrow, UK";
$track4->transportMethod = "Flight";
$track4->deliveryCompany = "DHL";

$track5 = new stdClass();
$track5->startLocation = "London Heathrow, UK";
$track5->endLocation = "Loft Digital, London, UK";
$track5->transportMethod = "Van";
$track5->deliveryCompany = "City Sprint";

$json = json_encode([$track4, $track2, $track3, $track5, $track1]);

$tracker = new \App\Tracker\BananaTracker();

$tracker->loadTracks($json);

$tracker->printRoute();
