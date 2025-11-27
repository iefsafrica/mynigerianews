<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulkMail extends Model
{
    use HasFactory;

    protected $table = 'bulk_mails';

    protected $fillable = [
        'email',
        'subject',
        'body',
    ];

    protected $casts = [
        'email' => 'string',
        'subject' => 'string',
        'body' => 'string',
    ];
}
