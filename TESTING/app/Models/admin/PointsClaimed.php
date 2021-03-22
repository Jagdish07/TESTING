<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class PointsClaimed extends Model{

	/* Name of Table */

	protected $table = 'pointsclaimed';

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

    protected $fillable = ['id', 'qr_code', 'campaign_id', 'product_id', 'user_id', 'location', 'brand', 'points_claimed', 'created_at', 'updated_at'];

}