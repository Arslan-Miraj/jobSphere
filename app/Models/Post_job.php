<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post_job extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'title', 'category_id', 'job_type_id', 'vacancy', 'location', 'description', 'benefits', 'resposibilities', 'qualifications','keywords', 'experience', 'company_name', 'company_location', 'company_website', 'deleted', 'is_featured', 'salary' 
    ];

    public function jobType(){
        return $this->belongsTo(Job_type::class);
    }

    public function category(){
        return $this->belongsTo(Job_category::class);
    }
}
