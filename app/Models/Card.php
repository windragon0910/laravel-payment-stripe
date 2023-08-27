<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_number',
        'exp_year',
        'exp_month',
        'cvv',
        'card_holder'
    ];

    public function paylogs(): HasMany
    {
        return $this->hasMany(PayLog::class);
    }
}
