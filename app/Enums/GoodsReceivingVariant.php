<?php

namespace App\Enums;

enum GoodsReceivingVariant : int{
    case DELIVERY = 0;
    case FREE_DELIVERY = 5;
    case PICKUP = 10;

    public function text(){
        return match($this){
            self::DELIVERY => 'Доставка',
            self::FREE_DELIVERY => 'Бесплатная доставка',
            self::PICKUP => 'Самовывоз',
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
