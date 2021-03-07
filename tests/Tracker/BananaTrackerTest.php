<?php
/**
 * Created by PhpStorm.
 * User: Holubar
 * Date: 07.03.21
 * Time: 16:42
 */

namespace Tests\Tracker;


use App\Tracker\BananaTracker;
use App\Tracker\Exception\JsonFormatException;
use PHPUnit\Framework\TestCase;

class BananaTrackerTest extends TestCase
{

    private $jsonDir = __DIR__ . "/json/";

    private $outputsDir = __DIR__ . "/outputs/";

    public function testCreateBananaTracker(){
        $tracker = new BananaTracker();
        $this->assertEquals('App\Tracker\BananaTracker', get_class($tracker));
    }

    public function testLoadTracks()
    {
        $tracker = new BananaTracker();

        $this->assertFalse($tracker->loadTracks(""));
        $this->assertFalse($tracker->loadTracks("not Json string"));

        $this->assertTrue($tracker->loadTracks(file_get_contents($this->jsonDir . "oneRecord.json")));
        $this->assertTrue($tracker->loadTracks(file_get_contents($this->jsonDir . "threeRecords.json")));
        $this->assertTrue($tracker->loadTracks(file_get_contents($this->jsonDir . "fiveRecords.json")));

    }

    public function testLoadTracksJsonFormatException()
    {
        $tracker = new BananaTracker();

        $this->expectException(JsonFormatException::class);

        $tracker->loadTracks(file_get_contents($this->jsonDir . "missingEnd.json"));
        $tracker->loadTracks(file_get_contents($this->jsonDir . "missingStart.json"));
    }

    public function testPrintRoute()
    {
        $tracker = new BananaTracker();

        $tracker->loadTracks(file_get_contents($this->jsonDir . "oneRecord.json"));

        $this->expectOutputString(file_get_contents($this->outputsDir . "oneRecord.txt"));
        $tracker->printRoute();
    }

    public function testPrintRouteThree()
    {
        $tracker = new BananaTracker();

        $tracker->loadTracks(file_get_contents($this->jsonDir . "threeRecords.json"));

        $this->expectOutputString(file_get_contents($this->outputsDir . "threeRecords.txt"));
        $tracker->printRoute();
    }

    public function testPrintRouteFive()
    {
        $tracker = new BananaTracker();

        $tracker->loadTracks(file_get_contents($this->jsonDir . "fiveRecords.json"));

        $this->expectOutputString(file_get_contents($this->outputsDir . "fiveRecords.txt"));
        $tracker->printRoute();
    }
}