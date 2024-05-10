<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{

    use HasFactory;
   /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {
        $query->where('user_id', auth()->user()->id)
        ->when($filters['search'] ?? false, fn($query, $search) =>
            
            $query
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('deadline', 'like', '%' . $search . '%')
                ->orWhere('priority', 'like', '%' . $search . '%'));

            $query->where('user_id', auth()->user()->id)
            ->when($filters['priority'] ?? false, fn($query, $priority) =>
                $query
                    ->where('priority', 'like', '%' . $priority . '%'));
        
            $query->where('user_id', auth()->user()->id)
            ->when($filters['deadline_bf'] ?? false, fn($query, $deadline) =>
                $query
                    ->where('deadline', '<=', $deadline));
        
            $query->where('user_id', auth()->user()->id)
            ->when($filters['deadline_af'] ?? false, fn($query, $deadline) =>
                $query
                ->where('deadline', '>', $deadline));    
    }

    public function User(): BelongsTo
    {
      return $this->belongsTo(User::class);
    }
}