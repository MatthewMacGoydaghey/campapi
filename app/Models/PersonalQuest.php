<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class PersonalQuest extends Model
{
    use HasFactory;
    use HasApiTokens;
    protected $fillable = ["title", "description", "scores", "status", "sent_by", "sent_to"];

    protected function casts()
    {
        return [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
        ];
    }

    public function sentTo(): BelongsTo {
        return $this->belongsTo(User::class, "sent_to");
    }

    public function sentBy(): BelongsTo {
        return $this->belongsTo(User::class, "sent_by");
    }
}