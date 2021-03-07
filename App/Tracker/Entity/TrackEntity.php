<?php
/**
 * Created by PhpStorm.
 * User: Holubar
 * Date: 07.03.21
 * Time: 13:20
 */

namespace App\Tracker\Entity;


class TrackEntity
{

    private string $startLocation;

    private string $endLocation;

    private string $transportMethod;

    private string $deliveryCompany;

    /**
     * @return string
     */
    public function getStartLocation(): string
    {
        return $this->startLocation;
    }

    /**
     * @param string $startLocation
     * @return TrackEntity
     */
    public function setStartLocation(string $startLocation): TrackEntity
    {
        $this->startLocation = $startLocation;
        return $this;
    }

    /**
     * @return string
     */
    public function getEndLocation(): string
    {
        return $this->endLocation;
    }

    /**
     * @param string $endLocation
     * @return TrackEntity
     */
    public function setEndLocation(string $endLocation): TrackEntity
    {
        $this->endLocation = $endLocation;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransportMethod(): string
    {
        return $this->transportMethod;
    }

    /**
     * @param string $transportMethod
     * @return TrackEntity
     */
    public function setTransportMethod(string $transportMethod): TrackEntity
    {
        $this->transportMethod = $transportMethod;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryCompany(): string
    {
        return $this->deliveryCompany;
    }

    /**
     * @param string $deliveryCompany
     * @return TrackEntity
     */
    public function setDeliveryCompany(string $deliveryCompany): TrackEntity
    {
        $this->deliveryCompany = $deliveryCompany;
        return $this;
    }


}