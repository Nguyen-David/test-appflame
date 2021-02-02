<?php
namespace App\Dto;

/**
 * Class CoordinatesDTO
 * @package App\Dto
 */
class CoordinatesDTO
{
    /**
     * @var string
     */
    private $lantitude;

    /**
     * @var string
     */
    private $loungitude;

    /**
     * @var string
     */
    private $address;
    /**
     * CoordinatesDTO constructor.
     * @param string $lantitude
     * @param string $loungitude
     */
    public function __construct(string $lantitude, string $loungitude)
    {
        $this->lantitude = $lantitude;
        $this->loungitude = $loungitude;
    }

    /**
     * @return string
     */
    public function getLantitude() {
        return $this->lantitude;
    }

    /**
     * @return string
     */
    public function getLoungitude() {
        return $this->loungitude;
    }

    /**
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

}
