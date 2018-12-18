<?php

namespace Maksim_N\EmailSpamList\Models;

use Illuminate\Database\Eloquent\Model;

class EmailSpamList extends Model
{
    protected $table = "email_spam_list";
    protected $fillable = ['email'];
}
