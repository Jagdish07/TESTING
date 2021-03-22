<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Campaigns extends Model{

	/* Name of Table */

	protected $table = 'campaigns';

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

    protected $fillable = ['id', 'product_id', 'location_id', 'brands', 'gift_cards', 'name', 'start_date', 'end_date', 'duration', 'image', 'status', 'created_at', 'updated_at'];

}