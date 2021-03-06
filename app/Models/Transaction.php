<?php
declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int $wallet_id
 * @property string $description
 * @property int $amount
 * @property int $is_fraudulent
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Wallet $wallet
 * @method static Builder|Transaction newModelQuery()
 * @method static Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Query\Builder|Transaction onlyTrashed()
 * @method static Builder|Transaction query()
 * @method static Builder|Transaction whereAmount($value)
 * @method static Builder|Transaction whereCreatedAt($value)
 * @method static Builder|Transaction whereDeletedAt($value)
 * @method static Builder|Transaction whereDescription($value)
 * @method static Builder|Transaction whereId($value)
 * @method static Builder|Transaction whereIsFraudulent($value)
 * @method static Builder|Transaction whereUpdatedAt($value)
 * @method static Builder|Transaction whereWalletId($value)
 * @method static \Illuminate\Database\Query\Builder|Transaction withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Transaction withoutTrashed()
 * @mixin Eloquent
 */
class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'wallet_id',
        'description',
        'amount',
        'is_fraudulent'
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
