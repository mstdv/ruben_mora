<?php

class EquiposController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /equipos
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /equipos/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$rules = array(
			'nombre'  => 'required|min:2|max:300|unique:deportes,nombre',
			'liga' 	  => 'required|min:1|max:300',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			Session::flash('modalName','#n-equipo');
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

			$user = new Equipo;
			$user->nombre 		= e(Input::get('nombre'));
			$user->liga_id 		= e(Input::get('liga'));

			$user->save();

			Session::flash('successMsj', 'Equipo "'.e(Input::get('nombre')).'" creado con exito!');
			return Redirect::back();

		}
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /equipos
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /equipos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /equipos/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /equipos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'nombre'  => 'required|min:2|max:300|unique:equipos,nombre,'.Input::get('id').'',
			'liga'    => 'required|min:1|max:300',
			'id' 	  => 'required',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			Session::flash('modalName','#m-equipo'.Input::get('id'));
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

			$user = Liga::find(Input::get('id'));
			$user->nombre 		= e(Input::get('nombre'));
			$user->liga_id 	    = e(Input::get('liga'));

			$user->save();

			Session::flash('successMsj', 'Equipo "'.e(Input::get('nombre')).'" Modificado con exito!');
			return Redirect::back();

		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /equipos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = Equipo::find($id);
		$user->delete();

		Session::flash('successMsj', 'Equipo eliminado con exito!');
		return Redirect::back();
	}

}