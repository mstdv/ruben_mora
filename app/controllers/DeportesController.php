<?php

class DeportesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /deportes
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /deportes/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$rules = array(
			'nombre' => 'required|min:2|max:300|unique:deportes,nombre',
			'ref' 	 => 'required|min:1|max:5|unique:deportes,logro_referencia',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			Session::flash('modalName','#n-deporte');
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

			$user = new Deporte;
			$user->nombre = e(Input::get('nombre'));
			$user->logro_referencia = e(Input::get('ref'));

			$user->save();

			Session::flash('successMsj', 'Deporte "'.e(Input::get('nombre')).'" creado con exito!');
			return Redirect::back();

		}
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /deportes
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /deportes/{id}
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
	 * GET /deportes/{id}/edit
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
	 * PUT /deportes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$rules = array(
			'nombre' => 'required|min:2|max:300|unique:deportes,nombre,'.Input::get('id').'',
			'ref' 	 => 'required|min:1|max:5|unique:deportes,logro_referencia',
			'id' 	 => 'required',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			Session::flash('modalName','#m-deporte'.Input::get('id'));
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

			$user = Deporte::find(Input::get('id'));
			$user->nombre = e(Input::get('nombre'));
			$user->logro_referencia = e(Input::get('ref'));

			$user->save();

			Session::flash('successMsj', 'Deporte "'.e(Input::get('nombre')).'" Modificado con exito!');
			return Redirect::back();

		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /deportes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		foreach (Liga::where('deporte_id',$id)->get() as $liga) {
			DB::table('equipos')->where('liga_id',$liga->id)->delete();
			$id_l = $liga->id;
		}

		foreach (Liga::where('deporte_id',$id)->get() as $liga) {
			DB::table('ligas')->where('id',$liga->id)->delete();
		}

		DB::table('deportes')->where('id',$id)->delete();

		DB::table('logros')->where('deporte_id',$id)->delete();

		Session::flash('successMsj', 'Deporte eliminado con exito!');
		return Redirect::back();
	}

}