<?php

namespace App\Enums\User;

enum Role : int{
    case CLIENT = 0;
    case SEO = 5;
    case SELLER = 10;
    case CONTENT = 15;
    case ADMIN = 100;

    public function text(){
        return match($this){
            self::CLIENT => 'Клиент',
            self::SEO => 'Сеошник',
            self::SELLER => 'Менеджер отдела продаж',
            self::CONTENT => 'Контент менеджер',
            self::ADMIN => 'Администратор'
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
