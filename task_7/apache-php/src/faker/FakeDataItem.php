<?php

class FakeDataItem
{
    public string $name;
    public string $color;
    public string $date;
    public string $time;
    public string $month;
    public string $century;
    public string $countryCode;
    public string $number;
    public string $latitude;
    public string $longitude;

    public function __construct(string $name,
                                string $color,
                                string $date,
                                string $time,
                                string $month,
                                string $century,
                                string $countryCode,
                                string $number,
                                string $latitude,
                                string $longitude
    )
    {
        $this->name = $name;
        $this->color = $color;
        $this->date = $date;
        $this->time = $time;
        $this->month = $month;
        $this->century = $century;
        $this->countryCode = $countryCode;
        $this->number = $number;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }


}
