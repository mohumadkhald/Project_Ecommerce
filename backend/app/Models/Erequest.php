<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Erequest.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Erequest extends Model
{
    use HasFactory;

    protected $table = 'erequests';

    protected $fillable = [
        'user_id',
        'post_id',
        'status',
        // Add other columns as needed
    ];

    // Define relationships with other models, if any

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}

