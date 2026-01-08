<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImportFailure extends Model
{
    use HasFactory;

    protected $fillable = [
        'import_batch_id',
        'row_number',
        'row_data',
        'error_message',
    ];

    protected $casts = [
        'row_data' => 'array',
    ];

    public function batch()
    {
        return $this->belongsTo(ImportBatch::class);
    }
}
