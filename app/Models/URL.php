<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class URL extends Model
{
    protected $table = "urls";
    protected $guarded = [""];

    public static function boot(){
        parent::boot();
        static::creating(function ($item){
            Log::info('Inserting authenticated user id '. $item);
            $item->user_id = auth()->user()->id;
        });


    }

    public function visitors(): HasMany
    {
        return $this->hasMany(Visitor::class,'url_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
