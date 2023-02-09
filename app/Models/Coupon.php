<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public function discount(int $total): float
    {
        if ($this->type === 'fixed') {
            return $this->value;
        }

        if ($this->type === 'percent') {
            return round($total * ($this->percent_off / 100));
        }

        return 0;
    }
}
