<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    /* Name of Table */

    protected $table = 'support_tickets';

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

    protected $fillable = ['id', 'user_id'.'Support_title_id','remarks', 'created_at', 'updated_at'];
}
