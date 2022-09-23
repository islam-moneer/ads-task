<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'title', 'description', 'start_date', 'category_id', 'advertiser_id'];

    public function scopePaid($query, $type = true)
    {
        return $query->where('type', $type);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function advertiser()
    {
        return $this->belongsTo(Advertiser::class);
    }
}
