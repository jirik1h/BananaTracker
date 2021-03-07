<?php
/**
 * Created by PhpStorm.
 * User: Holubar
 * Date: 07.03.21
 * Time: 9:48
 */

require __DIR__ . "/../vendor/autoload.php";

$tracker = new \App\Tracker\BananaTracker();

$tracker->loadTracks(file_get_contents(__DIR__ . "/../tests/Tracker/json/fiveRecords.json"));

$tracker->printRoute();
