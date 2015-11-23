<?php

namespace Elytus\LimoncelloBundle\Config;

use \Neomerx\Limoncello\Config\Config as C;
use REST\BillBundle\Entity\Charge;
use REST\CustomerBundle\Entity\Customer;
use REST\CustomerBundle\Entity\Location;
use REST\InvoiceBundle\Entity\Invoice;
use REST\PlayBundle\Entity\ChargeSchema;
use REST\PlayBundle\Entity\CustomerSchema;
use REST\PlayBundle\Entity\InvoiceSchema;
use REST\PlayBundle\Entity\LocationSchema;
use REST\PlayBundle\Entity\Post;
use REST\PlayBundle\Entity\PostSchema;

class ExampleConfig implements ConfigInterface
{
    public static function getConfig()
    {
        return [
            /*
            |--------------------------------------------------------------------------
            | Mapping between objects and their schemas
            |--------------------------------------------------------------------------
            |
            | Here you can specify what schemas should be used for object on encoding
            | to JSON API format.
            |
            | Supported schemas: as a class name, as closure.
            |
            */
            C::SCHEMAS => [
                Invoice::class =>InvoiceSchema::class,
                Customer::class => CustomerSchema::class,
                Charge::class => ChargeSchema::class,
                Location::class => LocationSchema::class
            ],
            /*
            |--------------------------------------------------------------------------
            | JSON encoding options
            |--------------------------------------------------------------------------
            |
            | Here you can specify options to be used while converting data to actual
            | JSON representation with json_encode function.
            |
            | For example if options are set to JSON_PRETTY_PRINT then returned data
            | will be nicely formatted with spaces.
            |
            | see http://php.net/manual/en/function.json-encode.php
            |
            | If this section is omitted default values will be used.
            |
            */
            C::JSON => [
                //C::JSON_OPTIONS    => JSON_PRETTY_PRINT,
                C::JSON_DEPTH      => C::JSON_DEPTH_DEFAULT,
            ]
        ];
    }

}