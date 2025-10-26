<?php

declare(strict_types=1);

namespace App\Dtos;

abstract class BaseDto
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function fromArray(array $attrs): static
    {
        $instance = new static();

        foreach ($attrs as $key => $value) {
            if (property_exists($instance, $key)) {
                $instance->{$key} = $value;
            }
        }

        return $instance;
    }
}
