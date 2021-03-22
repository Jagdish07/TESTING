<?php

namespace App\Models\api\v1;

use Illuminate\Database\Eloquent\Model;

class Users extends Model{

	protected $table = 'users';

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

    protected $fillable = ['id', 'name','email', 'password', 'username', 'phone_number', 'social_type', 'social_id', 'cpf_number', 'address', 'brand', 'profile_pic', 'remember_token', 'verify_token', 'device_type', 'device_token', 'status', 'created_at', 'updated_at','gender','city','school','interest','distance','about','phone'];
}

?>