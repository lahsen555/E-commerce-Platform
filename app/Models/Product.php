<?php

namespace App\Models;

use App\Contracts\Likeable;
use App\Models\Concerns\Likes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Algolia\ScoutExtended\Searchable\Aggregatable;
// use App\Traits\Aggregatable;
use Algolia\ScoutExtended\Searchable\Meilisearch;

class Product extends Model implements Likeable
{
    use HasFactory;
    use Likes;
    use Searchable, Aggregatable;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = ['user_id'];

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }
    
}
