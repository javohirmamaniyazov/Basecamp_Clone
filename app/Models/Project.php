<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

<<<<<<< HEAD
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

=======
>>>>>>> c766dae1abeaa52b54701cdc953f137cc50bca09
    public function user()
    {
        return $this->belongsTo(User::class);
    }

<<<<<<< HEAD

}
=======
    public function attachments()
{
    return $this->hasMany(Attachment::class);
}
}
>>>>>>> c766dae1abeaa52b54701cdc953f137cc50bca09
