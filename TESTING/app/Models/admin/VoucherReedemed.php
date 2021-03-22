<?php

namespace App\Models\admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class VoucherReedemed extends Model
{
    /* Name of Table */

    protected $table = 'voucher_reedemeds';

    /**
     * The database primary key value.
     *
     * @var string
     */

    protected $primaryKey = 'id';
}
