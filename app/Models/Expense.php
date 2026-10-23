<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title','amount','category','user_id'])]
class Expense extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
}
