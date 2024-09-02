<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    use HasFactory, Notifiable;

    public static function getGanjilGenap($n)
    {
        $details = [];

        for($i = 1; $i <= $n; $i++) {
            $details[] = [
                'number' => $i,
                'type' => $i % 2 === 0 ? 'Genap' : 'Ganjil',
            ];
        }
        return $details;
    }

    public static function getFibonacci($n)
    {
        $fib = [0,1];
        for($i = 2; $i <= $n; $i++) {
            $fib[] = $fib[$i - 1] + $fib[$i - 2];
        }
        return $fib;
    }

    public static function getPrima($n)
    {
        $prima = [];
        for($i = 1; $i <= $n; $i++) {
            $prima[] = [
                'number' => $i,
                'type' => isPrima($i) ? 'Prima' : 'Bukan Prima',
            ];
        }
        return $prima;
    }
}

function isPrima($n)
    {
        if($n < 2) {
            return false;
        }
        for($i = 2; $i < $n; $i++) {
            if($n % $i === 0) {
                return false;
            }
        }
        return true;
    }
