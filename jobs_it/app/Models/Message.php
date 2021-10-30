<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $tabel = "messages";
    protected $primaryKey = "message_id";
    protected $fillable = [
        'jobs_id',
        'history_id',
        'message',
    ];
}
