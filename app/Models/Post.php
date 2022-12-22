<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'body',
        'category_id'
    ];
    
    public function getPaginateByLimit(int $limit_count = 5)
    {
        return $this::with('category')->orderby('updated_at', 'DESC')->Paginate($limit_count);
        // モデル :: with(リレーション名) -> paginate()またはget()など;という形は、Eagerローディングという機能を使う書き方。
    }
    
    // Categoryに対するリレーション
    //「1対多」の関係なので単数系に
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
