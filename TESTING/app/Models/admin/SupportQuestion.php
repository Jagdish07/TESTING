<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class SupportQuestion extends Model
{
    /* Name of Table */

    protected $table = 'support_questions';

    /**
     * The database primary key value.
     *
     * @var string
     */

    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = ['id','support_question', 'created_at', 'updated_at'];

}
