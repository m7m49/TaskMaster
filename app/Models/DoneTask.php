<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class DoneTask extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {
        $query->where('user_id', auth()->user()->id)
        ->when($filters['search'] ?? false, fn($query, $search) =>
            
            $query
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('deadline', 'like', '%' . $search . '%')
                ->orWhere('priority', 'like', '%' . $search . '%')
                ->orWhere('done_at', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%'));

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

            $query->where('user_id', auth()->user()->id)
            ->when($filters['status'] ?? false, fn($query, $deadline) =>
                $query
                ->where('status', $deadline));    
    }

    function User(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }
}