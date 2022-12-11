<?php


namespace App\Shared\Domain;


use App\Shared\Domain\Aggregate\AggregateRoot;


interface Serializer
{
    public function serialize(AggregateRoot $object, \stdClass $stdClass):?string;

    public function deserialize(\stdClass $stdClass, AggregateRoot $object):void;
};