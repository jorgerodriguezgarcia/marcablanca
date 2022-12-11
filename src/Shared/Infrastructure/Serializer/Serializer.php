<?php


namespace App\Shared\Infrastructure\Serializer;


use App\Shared\Domain\Aggregate\AggregateRoot;

class Serializer implements \App\Shared\Domain\Serializer
{
    public function serialize(AggregateRoot $object, \stdClass $stdClass): ?string
    {
        // TODO: Implement serialize() method.
    }

    public function deserialize(\stdClass $stdClass, AggregateRoot $object): void
    {
        foreach ($stdClass as $key => $value) {
            $method = "set".str_replace("wbmer", "", $key);

            if (method_exists($object, $method)) {
                $type = (new \ReflectionClass($object))->getMethod($method)->getParameters()[0]->getType()->getName();

                switch ($type) {
                    case "int":
                        $object->$method((int)$value);
                        break;
                    case "bool":
                        $object->$method((bool)$value);
                        break;
                    case "float":
                        $object->$method((float)$value);
                        break;
                    case "DateTimeInterface":
                        if ($date = \DateTime::createFromFormat("Y-m-d H:i:s", $value." 00:00:00")) {
                        } elseif ($date = \DateTime::createFromFormat("Y-m-d H:i:s", $value)) {
                        }
                        $object->$method($date !== false ? $date : null);
                        break;
                    default:
                        $object->$method($value);
                }
            }
        }
    }
}//class