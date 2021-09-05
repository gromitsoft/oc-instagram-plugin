<?php

namespace GromIT\Instagram\Classes;

use Illuminate\Contracts\Support\Arrayable;
use ReflectionClass;
use ReflectionProperty;

abstract class Dto implements Arrayable
{
    /**
     * Dto constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->fillProperties($data);
    }

    /**
     * @param array $data
     */
    protected function fillProperties(array $data): void
    {
        $reflect    = new ReflectionClass($this);
        $properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);

        $propertiesList = array_map(
            static fn(ReflectionProperty $property) => $property->getName(),
            $properties
        );

        foreach ($data as $key => $value) {
            if (!in_array($key, $propertiesList, true)) {
                // $className = get_class($this);
                // throw new RuntimeException("Property $key does not exists in class $className.");
                continue;
            }

            $this->$key = $value;
        }
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * @param int $options
     *
     * @return false|string
     * @throws \JsonException
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR | $options);
    }
}
