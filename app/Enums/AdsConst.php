<?php

namespace App\Enums;

abstract class AdsConst
{
    const FREE = 0;
    const PAID = 1;

    const TYPE = [
      self::FREE => 'Free',
      self::PAID => 'Paid',
    ];
}