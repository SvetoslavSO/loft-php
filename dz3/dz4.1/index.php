<?php

interface TariffInterface
{
  public function countPrice():int;
  public function addService($service):self;
  public function getMinutes():int;
  public function getDistance():int;
}

interface ServiceInterface
{
  public function apply($tariff, &$cost);
}

abstract class Tariff implements TariffInterface
{
    protected $pricePerKilometer;
    protected $pricePerMinute;
    protected $distance;
    protected $minutes;
    protected $services = [];

    public function __construct(int $distance,int $minutes)
    {
        $this->distance = $distance;
        $this->minutes = $minutes;
    }

    public function countPrice():int
    {
        $cost = $this->distance * $this->pricePerKilometer + $this->minutes * $this->pricePerMinute;

        if ($this->services) {
            foreach ($this->services as $service) {
                $service->apply($this, $cost);
            }
        }

        return $cost;
    }

    public function addService ($service): TariffInterface
    {
        array_push($this->services, $service);
        return $this;
    }

    public function getMinutes():int
    {
        return $this->minutes;
    }

    public function getDistance():int
    {
        return $this->distance;
    }
}

class baseTariff extends Tariff
{
    protected $pricePerKilometer = 10;
    protected $pricePerMinute = 3;
}

class studentTariff extends Tariff
{
    protected $pricePerKilometer = 4;
    protected $pricePerMinute = 1;
}

class hourlyTariff extends Tariff
{
    protected $pricePerKilometer = 0;
    protected $pricePerMinute = 200 / 60;

    public function __construct ($distance, $minutes)
    {
        parent::__construct($distance, $minutes);
        $this->minutes = $this->minutes - $this->minutes % 60 + 60;
    }
}

class ServiceGPS implements ServiceInterface
{
    private $pricePerHour;

    public function __construct($pricePerHour) 
    {
        $this->pricePerHour = $pricePerHour;
    }

    public function apply($tariff, &$cost)
    {
        $hours = ceil($tariff->getMinutes()/60);
        $cost += $this->pricePerHour * $hours;
    }
}

class Driver implements ServiceInterface
{
    private $price;

    public function __construct($price) 
    {
        $this->price = $price;
    }

    public function apply($tariff, &$cost)
    {
        $cost += $this->price;
    }
}

$baseDrive = new baseTariff(5, 60);
$baseDrive->addService(new ServiceGPS(15))->addService(new Driver(100));
echo $baseDrive->countPrice(), ' base tariff with 1h gps and driver <br>';

$hourlyDrive = new hourlyTariff(5, 15);
echo $hourlyDrive->countPrice(), ' hourly tariff <br>';

$studentDrive = new studentTariff(5, 15);
echo $studentDrive->countPrice(), ' student tariff <br>';
