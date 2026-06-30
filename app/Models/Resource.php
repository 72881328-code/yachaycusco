<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'subject', 'level', 'lang', 
        'type', 'file_path', 'status', 'rejection_reason', 'author_id', 'views', 'downloads'
    ];

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeLevel($query, $level)
    {
        return $level ? $query->where('level', $level) : $query;
    }

    public function scopeSubject($query, $subject)
    {
        return $subject ? $query->where('subject', $subject) : $query;
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }

    public function incrementDownloads(): void
    {
        $this->increment('downloads');
    }
}