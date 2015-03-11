<?php

class PitchersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /pitchers
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /pitchers/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$rules = array(
			'nombre'  => 'required|min:2|max:300',
			'equipo'  => 'required|min:1|max:300',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			Session::flash('modalName','#n-equipo');
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

			$user = new Pitcher;
			$user->nombre 		= e(Input::get('nombre'));
			$user->equipo_id 	= e(Input::get('equipo'));

			$user->save();

			Session::flash('successMsj', 'Pitcher "'.e(Input::get('nombre')).'" creado con exito!');
			return Redirect::back();

		}
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /pitchers
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /pitchers/{id}
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
	 * GET /pitchers/{id}/edit
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
	 * PUT /pitchers/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$rules = array(
			'nombre'  => 'required|min:2|max:300',
			'equipo'  => 'required|min:1|max:300',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			Session::flash('modalName','#n-equipo');
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

			$user = Pitcher::find(Input::get('id'));
			$user->nombre 		= e(Input::get('nombre'));
			$user->equipo_id 	= e(Input::get('equipo'));

			$user->save();

			Session::flash('successMsj', 'Pitcher "'.e(Input::get('nombre')).'" creado con exito!');
			return Redirect::back();

		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /pitchers/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = Pitcher::find($id);
		$user->delete();

		Session::flash('successMsj', 'Pitcher eliminado con exito!');
		return Redirect::back();
	}

}