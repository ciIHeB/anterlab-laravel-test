<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Allow mass assignment on these fields
    protected $fillable = ['user_id', 'title', 'description'];

    // Define the relationship to the User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
