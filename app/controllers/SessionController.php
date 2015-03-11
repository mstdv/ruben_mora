<?php

class SessionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /usuarios
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('login');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /usuarios/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$rules = array(
			'username'    	=> 'required|min:4|max:28',
			'password' 		=> 'required|alphaNum|min:6|max:28'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('login')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {

			if (Auth::attempt(['usuario' => e(Input::get('username')), 'password' => Input::get('password')])) {

				if (Auth::user()->estado != 1) {
					Auth::logout();
					Session::flash('alertOn', 'Su cuenta se encuentra temporalmente suspendida, porfavor contacte con un administrador.');
					return Redirect::back();
				} else {
					if (Auth::user()->rol == 3) {
						if (Limite::where('user_id', Auth::user()->id)->count() == 0 or
                            Restriccion::where('user_id', Auth::user()->id)->count() == 0  ) {
							Auth::logout();
							Session::flash('alertOn', 'Su cuenta no esta del todo configurada porfavor espere que el administrador configure los limites de su cuenta, verifique sus limites y restricciones.');
							return Redirect::back();
						} else {
							return Redirect::to('/');
						}
					} else {
						return Redirect::to('/');
					}
				}

			} else {
				return Redirect::to('login')
					->withInput(Input::except('password'))
					->with('error_login', true);
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
	public function destroy()
	{
		Session::clear();
		Auth::logout();
		return Redirect::to('/');
	}

}