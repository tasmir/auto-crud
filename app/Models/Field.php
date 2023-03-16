<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Field extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded =['id', 'created_at', 'updated_at'];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = Auth::check() ? Auth::id() : null;
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::check() ? Auth::id() : null;
        });

        static::deleting(function ($model) {
            $model->deleted_by = Auth::check() ? Auth::id() : null;
            $model->save();
        });
    }
}
