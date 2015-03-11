<?php

class UsersController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 * GET /usuarios/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$rules = array(
			'Usuario'    	    => 'required|min:4|max:28|unique:users,usuario',
			'Email'    	        => 'required|min:5|max:300|email|unique:users,email',
			'password'    	    => 'required|min:6|max:28',
			'rol'    	        => 'required|min:1|max:48',
			'Nombre'    	    => 'required|min:2|max:30',
			'Apellido'    	    => 'required|min:2|max:30',
			'Cedula'    	    => 'required|min:5|max:13',
			'Direccion'    	    => 'min:0|max:300',
			'Ciudad'    	    => 'min:0|max:28',
			'Telefono'    	    => 'required|min:0|max:28',
			'Dueno'    	        => 'min:0|max:28',
			'banco'    	        => 'min:0|max:30',
			'grupo'    	        => 'min:0|max:2',
			'numero_cuenta'    	=> 'min:0|max:50',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			Session::flash('modalName','.users-create');
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {
			if (User::where('usuario', e(Input::get('Usuario')))->count() == 1) {
				return Redirect::back()
				->withErrors($validator)
				->withInput(Input::except('password'));
			} else {
				$user = new User;
				$user->nombre          = e(Input::get('Nombre'));
				$user->apellido        = e(Input::get('Apellido'));
				$user->cedula          = e(Input::get('Cedula'));
				$user->direccion       = e(Input::get('Direccion'));
				$user->ciudad          = e(Input::get('Ciudad'));
				$user->telefono        = e(Input::get('Telefono'));
				$user->dueno           = e(Input::get('Dueno'));
				$user->banco           = e(Input::get('banco'));
				$user->numero_cuenta   = e(Input::get('numero_cuenta'));
				$user->usuario 		   = e(Input::get('Usuario'));
				$user->email   		   = e(Input::get('Email'));
				$user->password        = Hash::make(e(Input::get('password')));
				$user->grupo_id        = e(Input::get('Dueno'));
				$user->rol             = e(Input::get('rol'));
				$user->save();

				Session::flash('successMsj', 'Usuario creado con exito!');
				return Redirect::back();
			}
		}
	}


	/**
	 * Update the specified resource in storage.
	 * PUT /usuarios/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$rules = array(
			'Usuario'    	    => 'required|min:4|max:28|unique:users,usuario,'.Input::get('id').'',
			'Email'    	        => 'required|min:5|max:300|email|unique:users,email,'.Input::get('id').'',
			'password'    	    => 'min:6|max:28',
			'rol'    	    	=> 'required',
			'Nombre'    	    => 'required|min:2|max:30',
			'Apellido'    	    => 'required|min:2|max:30',
			'Cedula'    	    => 'required|min:5|max:13',
			'Direccion'    	    => 'min:0|max:300',
			'Ciudad'    	    => 'min:0|max:28',
			'Telefono'    	    => 'required|min:0|max:28',
			'Dueno'    	        => 'min:0|max:28',
			'banco'    	        => 'min:0|max:30',
			'numero_cuenta'    	=> 'min:0|max:50',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

			$user = User::find(Input::get('id'));
			$user->nombre          = e(Input::get('Nombre'));
			$user->apellido        = e(Input::get('Apellido'));
			$user->cedula          = e(Input::get('Cedula'));
			$user->direccion       = e(Input::get('Direccion'));
			$user->ciudad          = e(Input::get('Ciudad'));
			$user->telefono        = e(Input::get('Telefono'));
			$user->dueno           = e(Input::get('Dueno'));
			$user->banco           = e(Input::get('banco'));
			$user->numero_cuenta   = e(Input::get('numero_cuenta'));
			$user->usuario 		   = e(Input::get('Usuario'));
			$user->email   		   = e(Input::get('Email'));
			$user->rol             = e(Input::get('rol'));

			if (Input::get('password') != null) {
				$user->password = Hash::make(e(Input::get('password')));
			}

			if ($user->save()){
				Session::flash('successMsj', 'Usuario modificado con exito!');
				return Redirect::to('/admin-usuarios');
			} else {
				Session::flash('successMsj', 'Usuario no modificado ?!');
				return Redirect::back()
				->withErrors($validator)
				->withInput();
			}

		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /usuarios/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();
		Session::flash('successMsj', 'Usuario eliminado con exito!');
		return Redirect::back();
	}

	public function changeState($id)
	{
		$User = User::find($id);
			if($User->estado == 0)
				$User->estado = 1;
			else
				$User->estado = 0;
		$User->save();
		return Redirect::back();
	}

	public function showinfuser($id)
	{
		if (Auth::user()->id == $id) {
			return View::make('users.show-user', ['id' => $id]);
		} else {
			return Redirect::to('/');
		}
	}
}