<?php

class RestriccionsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /restriccions
	 *
	 * @return Response
	 */
	public function index()
	{
        if(Auth::check())
            return View::make('restriccions.index');
        else
            return Redirect::to('/');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /restriccions/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /restriccions
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /restriccions/{id}
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
	 * GET /restriccions/{id}/edit
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
	 * PUT /restriccions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$aa = Restriccion::where('user_id', $id)
            ->where('deporte_id', e(Input::get('deporte')))
            ->where('restriccion', e(Input::get('restricciones')));
        if($aa->count() == 1) {
            Session::flash('alertOn','El usuario ya posee una restriccion igual.');
            return Redirect::back();
        } else {
            $restriccion = new Restriccion;
            $restriccion->user_id = e($id);
            $restriccion->deporte_id = e(Input::get('deporte'));
            $restriccion->restriccion = e(Input::get('restricciones'));
            if($restriccion->save()) {
                return Redirect::back();
            } else {
                Session::flash('alertOn','Ocurrio un error al guardar la restriccion, porfavor intenta nuevamente.');
                return Redirect::back();
            }
        }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /restriccions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		$restriccion = Restriccion::find($id);
        $restriccion->delete();
        Session::flash('alertOn', 'Restriccion eliminada con exito!.');
        return Redirect::to('/restriccions');
	}

}