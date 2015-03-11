<?php

class LigasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /ligas
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /ligas/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$rules = array(
			'nombre'  => 'required|min:2|max:300|unique:deportes,nombre',
			'deporte' => 'required|min:1|max:300',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			Session::flash('modalName','#n-liga');
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

			$user = new Liga;
			$user->nombre 		= e(Input::get('nombre'));
			$user->deporte_id 	= e(Input::get('deporte'));

			$user->save();

			Session::flash('successMsj', 'Liga "'.e(Input::get('nombre')).'" creado con exito!');
			return Redirect::back();

		}

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /ligas
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /ligas/{id}
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
	 * GET /ligas/{id}/edit
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
	 * PUT /ligas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$rules = array(
			'nombre'  => 'required|min:2|max:300|unique:ligas,nombre,'.Input::get('id').'',
			'deporte' => 'required|min:1|max:300',
			'id' 	  => 'required',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			Session::flash('modalName','#m-liga'.Input::get('id'));
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

			$user = Liga::find(Input::get('id'));
			$user->nombre 		= e(Input::get('nombre'));
			$user->deporte_id 	= e(Input::get('deporte'));

			$user->save();

			Session::flash('successMsj', 'Liga "'.e(Input::get('nombre')).'" Modificada con exito!');
			return Redirect::back();

		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /ligas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		foreach (Liga::where('id',$id)->get() as $liga) {
			DB::table('equipos')->where('liga_id',$liga->id)->delete();
		}

		DB::table('ligas')->where('id',$id)->delete();

		Session::flash('successMsj', 'Liga eliminada con exito!');
		return Redirect::back();
	}

}