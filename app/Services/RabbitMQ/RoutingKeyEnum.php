<?php

namespace App\Services\RabbitMQ;

use App\Traits\EnumHelperTrait;

enum RoutingKeyEnum: string
{
    use EnumHelperTrait;

    case Empty = '';
    case OK = 'ok';
    case Fail = 'fail';
    case Create = '*.create';
    case Update = '*.update';

    static public function routingName(self $route, ...$args): string
    {
        $routing_name = '';
        $argumant_index = 0;
        foreach (str_split($route->value) as $key => $char) {
            if ($char === '*' || $char === '#') {
                $routing_name .= isset($args[$argumant_index]) ? $args[$argumant_index] : '';
                $argumant_index++;
            }
            else {
                $routing_name .= $char;
            }
        }

        return $routing_name;

    }

}
