<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    /* Name of Table */

    protected $table = 'vouchers';

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
