<?php

class HojasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /hojas
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('hojas.index');
	}

	public function printHoja()
	{

		$ligas = explode(',', e(Input::get('ligas_list')));
		$opciones = explode(',', e(Input::get('op_list')));
		$tipo = e(Input::get('tipo'));
		$fecha = Input::get('fecha');

		foreach ($ligas as $key => $value) {
			if($value==null){
				unset($ligas[$key]);
			}
		}

		foreach ($ligas as $key => $value) {
			$c = Liga::where('nombre', $value);
			if($c->count() == 1) {
				$d = $c->get();
				$ligas[$key]=$d[0]->id;
			}
		}

		foreach ($opciones as $key => $value) {
			if($value==null){
				unset($opciones[$key]);
			}
		}

		foreach ($opciones as $key => $value) {
			$opciones_list['op_'.$value] = true;
		}

		if (!isset($opciones_list)) {
			Session::flash('successMsj', 'Debe de seleccionar al menos un equipo y una opción.');
			Session::flash('alertOn', 'Debe de seleccionar al menos un equipo y una opción.');
			return Redirect::back();
		}

		if ($ligas == null) {
			Session::flash('successMsj', 'Debe de seleccionar al menos un equipo y una opción.');
			Session::flash('alertOn', 'Debe de seleccionar al menos un equipo y una opción.');
			return Redirect::back();
		}

		$html = View::make('hojas.show', [
			'ligas'    => $ligas,
			'opciones_list' => $opciones_list,
			'tipo'     => $tipo,
			'fecha'    => $fecha
		]);

		return $html;
		return PDF::load($html, 'A4', 'landscape')->show();

	}

	public function search()
	{
		$rules = array(
				'fecha_hoja' => 'required|date_format:"m/d/Y"',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			Session::flash('successMsj', 'Formato de fecha invalido.');
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {
			$fecha = Input::get('fecha_hoja');
			$fecha = explode('/', $fecha);
			$fecha = $fecha[2].'-'.$fecha[0].'-'.$fecha[1];

			$logros = Logro::where('fecha_partido', e($fecha));

			if ($logros->count() == 0) {
				Session::flash('successMsj', 'No exite logros para la fecha seleccionada.!');
				return Redirect::back()
				->withErrors($validator)
				->withInput();
			} else {
				return Redirect::to('/logros/show/date/'.e($fecha));
			}
		}
	}

	/**
	 * Display the specified resource.
	 * GET /hojas/{id}
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
	 * GET /hojas/{id}/edit
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
	 * PUT /hojas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /hojas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}