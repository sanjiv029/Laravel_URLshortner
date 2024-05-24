<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visitor extends Model
{
    protected $fillable = [
         'ip','user_agent','url_id' // add other attributes as needed
    ];
    public function url(): BelongsTo
    {
        return $this->belongsTo(Url::class,'url_id');
    }
}
