<?php

namespace InvestApp\application\models;

class Model
{
    public static function toObject(array $data): static
    {
        $model = new static();
        foreach ($data as $key => $value) {
            $model->$key = $value;
        }
        return $model;
    }

    public function toArray(): array
    {
        return json_decode(json_encode($this), true);
    }
}