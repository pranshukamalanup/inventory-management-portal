<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportBatch extends Model
{
    protected $fillable = [
        'total_rows',
        'processed_rows',
        'failed_rows',
        'status',
    ];
}
