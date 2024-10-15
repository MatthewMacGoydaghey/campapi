<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class Profile extends Model
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable = ['name', 'description', 'position', 'user'];

    protected function casts()
    {
        return [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
        ];
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, "profile");
    }
}
