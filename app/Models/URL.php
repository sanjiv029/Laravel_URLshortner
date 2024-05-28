<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class URL extends Model
{
    protected $table = "urls";
    protected $guarded = ["

    "];

    public function visitors(): HasMany
    {
        return $this->hasMany(Visitor::class,'url_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
