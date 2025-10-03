<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;
    protected $table    = 'expenses';
    protected $fillable = [
        'user_id',
        'category_id',
        'amount',
        'description',
        'date',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function getCategoryNameAttribute()
    {
        return $this->category ? $this->category->name : null;
    }
}
