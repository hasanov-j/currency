<?php

namespace HasanovJ\Currency;

class Model
{
    private int $Cur_ID;

    private \DateTime $date;

    private string $Cur_Abbreviation;

    private int $Cur_Scale;

    private string $Cur_Name;

    private float $Cur_OfficialRate;

    public function __construct(array $fields)
    {
        foreach ($fields as $key => $field) {
            if (property_exists(self::class, $key)) {
                $this->{$key} = $field;
            }
        }
    }

    public function getAbbreviation(): string
    {
        return $this->Cur_Abbreviation;
    }

    public function getName(): string
    {
        return $this->Cur_Name;
    }

    public function getId()
    {
        return $this->Cur_ID;
    }

    public function getCurOfficialRate(): float
    {
        var_dump($this->Cur_OfficialRate);die;

        return $this->Cur_OfficialRate;
    }
}