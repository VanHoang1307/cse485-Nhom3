<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationDocument extends Model
{
    use HasFactory;

    protected $table = 'application_documents';

    protected $fillable = [
        'application_id',
        'document_name',
        'document_type',
        'file_path',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}