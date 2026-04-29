<?php

namespace App\Enums;

enum EmploymentType: string
{
    case FullTime = 'full-time';
    case PartTime = 'part-time';
    case Casual   = 'casual';

    public function label(): string
    {
        return match($this) {
            self::FullTime => 'Full-time',
            self::PartTime => 'Part-time',
            self::Casual   => 'Casual',
        };
    }
}
