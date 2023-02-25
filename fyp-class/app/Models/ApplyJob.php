<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplyJob extends Model
{
    use HasFactory;
    protected $fillable = ['name','address','email','contact','user_id','job_id','resume'];

    /**
     * Get the job that owns the ApplyJob
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id','id');
    }
}
