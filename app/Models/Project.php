<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "title",
        "author",
        "content",
        "cover_img"
    ];

    public function types() {
        return $this->belongsTo(Type::class);
    }
}
