<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public static function getInf($id){
		$data = User::where('id',$id)->get();
		return $data[0];
	}

	public static function getRol($num){
		switch ($num) {
			case 1:
				return 'Administrador';
				break;

			case 2:
				return 'Promotor';
				break;

			case 3:
				return 'Agencia';
				break;

			case 4:
				return 'Taquilla';
				break;

			case 5:
				return 'Usuario';
				break;

			default:
				return 'No definido';
				break;
		}
	}
}
