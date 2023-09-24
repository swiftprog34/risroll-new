<?php

namespace App\Enums;

enum PaymentVariant : int{
    case CASH = 0;
    case CARD = 5;
    case ONLINE = 10;

    public function text(){
        return match($this){
            self::CASH => 'Наличные',
            self::CARD => 'Карта',
            self::ONLINE => 'Карта',
        };
    }

    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = $case->text();
        }
        return $array;
    }
}
