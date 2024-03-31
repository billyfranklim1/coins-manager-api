<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method updateOrCreate(array $array, $data)
 * @property int $id
 * @property int $coin_id
 * @property string $price_usd
 * @property string $market_cap
 * @property string $volume_24h
 * @property string $percent_change_24h
 * @property string $timestamp
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Coin $coin
 * @method static \Database\Factories\QuoteFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Quote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quote query()
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereCoinId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereMarketCap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote wherePercentChange24h($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote wherePriceUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereVolume24h($value)
 * @mixin \Eloquent
 */
class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'coin_id',
        'price_usd',
        'market_cap',
        'volume_24h',
        'percent_change_24h',
        'timestamp',
    ];

    public function coin()
    {
        return $this->belongsTo(Coin::class);
    }
}
