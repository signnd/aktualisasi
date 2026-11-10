<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;

    protected $table = 'informasi';

    protected $fillable = [
        'judul', 'ringkasan', 'kategori', 'foto', 'fotos', 'teks', 'dokumentasi', 'user_id', 'created_at'
    ];

    protected function casts(): array
    {
        return [
            'fotos' => 'array',
        ];
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
