<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function list()
    {
        return $this->belongsTo(TaskList::class, 'listId');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tagId');
    }
}
