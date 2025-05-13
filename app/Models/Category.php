<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Gunakan tabel yang sesuai dengan migration
    protected $table = 'categories';

    // Optional: field mana saja yang bisa diisi
    protected $fillable = [
        'name',
        'slug',
        'description',
        
    ];
}
