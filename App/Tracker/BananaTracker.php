<?php
/**
 * Created by PhpStorm.
 * User: Holubar
 * Date: 07.03.21
 * Time: 13:03
 */

namespace App\Tracker;


use App\Tracker\Entity\TrackEntity;
use App\Tracker\Exception\JsonFormatException;

class BananaTracker
{

    /** @var TrackEntity[] */
    private $tracks;

    /**
     * @param string $json
     * @return bool
     * @throws JsonFormatException
     */
    public function loadTracks(string $json) : bool
    {
        $this->tracks = [];

        $jsonDecoded = json_decode($json);

        if(json_last_error() !== JSON_ERROR_NONE || empty($jsonDecoded)){
            return false;
        }

        if(is_object($jsonDecoded)){
            $this->validateJsonRecord($jsonDecoded);
            $track = new TrackEntity();
            $track->setStartLocation($jsonDecoded->startLocation)
                ->setEndLocation($jsonDecoded->endLocation)
                ->setTransportMethod($jsonDecoded->transportMethod?? "unknown")
                ->setDeliveryCompany($jsonDecoded->deliveryCompany?? "unknown");
            $this->tracks[$track->getEndLocation()] = $track;
        }else{
            foreach ($jsonDecoded as $record){
                $this->validateJsonRecord($record);
                $track = new TrackEntity();
                $track->setStartLocation($record->startLocation)
                    ->setEndLocation($record->endLocation)
                    ->setTransportMethod($record->transportMethod?? "unknown")
                    ->setDeliveryCompany($record->deliveryCompany?? "unknown");
                $this->tracks[$track->getEndLocation()] = $track;
            }
        }

        return true;
    }

    /**
     * @return TrackEntity[]|array
     */
    private function getRoute()
    {
        if(empty($this->tracks)){
            return [];
        }

        if(count($this->tracks) == 1){
            return $this->tracks;
        }

        $curTrack = null;

        foreach ($this->tracks as $track){
            if(!array_key_exists($track->getStartLocation(), $this->tracks)){
                $curTrack = $track;
                break;
            }
        }

        $list = [];

        $list[]  = $curTrack;
        $founded = true;

        while($founded){
            $founded = false;
            foreach ($this->tracks as $track){
                if($track->getStartLocation() == $curTrack->getEndLocation()){
                    $curTrack = $track;
                    $list[] = $curTrack;
                    $founded = true;
                    break;
                }
            }
        }

        return $list;
    }

    /**
     * Prints route loaded from json
     */
    public function printRoute()
    {
        $list = $this->getRoute();

        if(empty($list)){
            printf("Missing route data!\n");
        }

        foreach ($list as $step)
        {
            printf("From %s to %s by %s (%s)\n",
                $step->getStartLocation(),
                $step->getEndLocation(),
                $step->getTransportMethod(),
                $step->getDeliveryCompany());
        }
    }

    /**
     * @param array $record
     * @throws JsonFormatException
     */
    private function validateJsonRecord(\stdClass $record)
    {
        if(empty($record->startLocation)){
            throw new JsonFormatException("Missing start location");
        }

        if(empty($record->endLocation)){
            throw new JsonFormatException("Missing end location");
        }
    }
}