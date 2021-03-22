<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model{

	/* Name of Table */

	protected $table = 'locations';

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

    protected $fillable = ['id', 'cnpj_number', 'name', 'brand', 'state', 'city', 'created_at', 'updated_at'];

}