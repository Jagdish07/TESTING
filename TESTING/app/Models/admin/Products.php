<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Products extends Model{

	/* Name of Table */

	protected $table = 'products';

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

    protected $fillable = ['id', 'name', 'sku', 'sku_product', 'description', 'brand', 'image', 'points_per_sale', 'created_at', 'updated_at'];

}