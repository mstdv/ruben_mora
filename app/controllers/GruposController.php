<?php

class GruposController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /grupos
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /grupos/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return view::make('grupos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /grupos
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'nombre'  => 'required|min:1|max:120|unique:grupos,nombre',
			'admin' => 'required|min:1|max:3',
			'descripcion' => 'required|min:1|max:500',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			$errors = $validator->messages();

			Session::flash('modalName','.grupos-users-create');
			Session::flash('alertOn', $errors->first());

			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {
			$grupo = new Grupo;
			$grupo->nombre = e(Input::get('nombre'));
			$grupo->descripcion = e(Input::get('descripcion'));
			$grupo->user_id = e(Input::get('admin'));
			$grupo->save();

			Session::flash('alertOn', 'Grupo creado');
			return Redirect::back();
		}
	}

	/**
	 * Display the specified resource.
	 * GET /grupos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data = Grupo::where('id', $id)->get();
		return View::make('grupos.show', ['data' => $data[0]]);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /grupos/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = Grupo::where('id', $id)->get();
		return View::make('grupos.edit', ['data' => $data[0]]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /grupos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'nombre'  => 'required|min:1|max:120|unique:grupos,nombre',
			'admin' => 'required|min:1|max:3',
			'descripcion' => 'required|min:1|max:500',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			$errors = $validator->messages();

			Session::flash('alertOn', $errors->first());

			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {
			$grupo = Grupo::find($id);
			$grupo->nombre = e(Input::get('nombre'));
			$grupo->descripcion = e(Input::get('descripcion'));
			$grupo->user_id = e(Input::get('admin'));
			$grupo->save();

			Session::flash('alertOn', 'Grupo actualizado');
			return Redirect::back();
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /grupos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		foreach (User::where('grupo_id', $id)->get() as $usuario) {
			$u = User::find($usuario->id);
			$u->grupo_id = '0';
			$u->save();
		}

		$g = Grupo::find($id);
		$g->delete();

		Session::flash('alertOn', 'Grupo eliminado, todos los usuarios pertenecientes al grupo, pasaron a no tener grupo asignado.');
		Return Redirect::to('/admin-usuarios');
	}

	public function newuser($id)
	{
		$data = Grupo::where('id', $id)->get();
		return View::make('grupos.newuser', ['data' => $data[0]]);
	}

	public function newuserpost($id)
	{
		$rules = array(
			'user'  => 'required|min:1|max:3'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {
			$u = User::find(e(Input::get('user')));
			$u->grupo_id = $id;
			$u->save();

			Session::flash('alertOn', 'Usuario actualizado');
			return Redirect::to('/grupos/'.$id);
		}
	}

	public function moveuser($id)
	{
		$data = User::where('id', $id)->get();
		return View::make('grupos.moveuser', ['data' => $data[0]]);
	}

	public function moveuserpost($id)
	{
		$user = $id;

		$rules = array(
			'grupo'  => 'required|min:1|max:3'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {
			$u = User::find(e($user));
			$u->grupo_id = Input::get('grupo');
			$u->save();

			Session::flash('alertOn', 'Usuario actualizado');
			return Redirect::to('/admin-usuarios-info/'.$id);
		}
	}

}