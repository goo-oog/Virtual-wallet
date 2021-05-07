<?php
declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Wallet
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @property-read User $user
 * @method static Builder|Wallet newModelQuery()
 * @method static Builder|Wallet newQuery()
 * @method static Builder|Wallet query()
 * @method static Builder|Wallet whereCreatedAt($value)
 * @method static Builder|Wallet whereId($value)
 * @method static Builder|Wallet whereName($value)
 * @method static Builder|Wallet whereUpdatedAt($value)
 * @method static Builder|Wallet whereUserId($value)
 * @mixin Eloquent
 */
class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
