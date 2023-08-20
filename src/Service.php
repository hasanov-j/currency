<?php

namespace HasanovJ\Currency;

class Service
{
    private static $storage;

    public function __construct()
    {
        foreach (HttpClient::getResponse() as $item) {
            self::$storage[] = new Model($item);
        }
    }

    public function getAll(): array
    {
        return self::$storage;
    }

    public function getOneById(int $value): Model
    {
        $data = $this->findOneById($value);

        if ($data == null) {
            throw new \Exception("Model by this CurId - {$value} not found");
        }

        return $data;
    }

    public function findOneById(int $value): Model
    {
        $result = array_filter(self::$storage, function (Model $item) use ($value) {
            return $item->getId() == $value;
        });

        return array_shift($result);
    }

    public function findOneByAbbreviation(string $value): ?Model
    {
        $result = array_filter(self::$storage, function (Model $item) use ($value) {
            return $item->getAbbreviation() == $value;
        });

        return array_shift($result);
    }


    public function getOneByAbbreviation(string $value): Model
    {
        $data = $this->findOneByAbbreviation($value);

        if ($data == null) {
            throw new \Exception("Model by this Abbreviation - {$value} not found");
        }

        return $data;
    }
}