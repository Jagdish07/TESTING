<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class QrCodes extends Model{

	/* Name of Table */

	protected $table = 'qrcodes';

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

    protected $fillable = ['id', 'product_id', 'qr_code', 'status', 'created_at', 'updated_at'];

}