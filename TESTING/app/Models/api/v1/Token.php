<?php

namespace App\Models\api\v1;

use Illuminate\Database\Eloquent\Model;

class Token extends Model{

	/* Name of Table */

	protected $table = 'tokens';

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

    protected $fillable = ['id', 'user_id', 'access_token', 'token_status', 'expires_in', 'created_at', 'updated_at'];
}