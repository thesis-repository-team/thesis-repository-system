<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThesisRequest extends Model
{
    protected $fillable = [
        'submitted_by',
        'department_id',
        'thesis_id',
        'title',
        'abstract',
        'description',
        'pdf_file',
        'status',
        'remarks',
        'submitted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function thesis()
    {
        return $this->belongsTo(Thesis::class);
    }

    
    // public function scopePending($query)
    // {
    //     return $query->where('status', 'pending');
    // }

    // public function scopeApproved($query)
    // {
    //     return $query->where('status', 'approved');
    // }

    // public function scopeRejected($query)
    // {
    //     return $query->where('status', 'rejected');
    // }

    // public function scopeByDepartment($query, $departmentId)
    // {
    //     return $query->where('department_id', $departmentId);
    // }

    // public function scopeByUser($query, $userId)
    // {
    //     return $query->where('submitted_by', $userId);
    // }

    // public function scopeByStatus($query, $status)
    // {
    //     return $query->where('status', $status);
    // }

    // public function scopeByThesis($query, $thesisId)
    // {
    //     return $query->where('thesis_id', $thesisId);
    // }

    // public function scopeByDateRange($query, $startDate, $endDate)
    // {
    //     return $query->whereBetween('submitted_at', [$startDate, $endDate]);
    // }

    // public function scopeSearch($query, $searchTerm)
    // {
    //     return $query->where(function ($q) use ($searchTerm) {
    //         $q->where('title', 'like', "%{$searchTerm}%")
    //             ->orWhere('abstract', 'like', "%{$searchTerm}%")
    //             ->orWhere('description', 'like', "%{$searchTerm}%");
    //     });
    // }

}
