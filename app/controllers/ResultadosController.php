<?php

class ResultadosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /resultados
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('resultados.index');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /resultados/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /resultados
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /resultados/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$rules = array(
			'fecha'  => 'required|date_format:"m/d/Y"',
			'liga'   => 'required|min:1|max:4',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			Session::flash('alertOn','Ocurrio un error al buscar resultados.');
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {
			$fecha = Input::get('fecha');
			$fecha = explode('/', $fecha);
			$fecha = $fecha[2].'-'.$fecha[0].'-'.$fecha[1];

			$resultados = Resultado::where('fecha', $fecha);

			if($resultados->count() <= 0) {
				Session::flash('alertOn','No hay resultados para la fecha y liga ingresada, porfavor selecciona una fecha / liga diferente.');
				return Redirect::back()->withInput();;
			} else {
				return View::make('resultados.show', ['data' => $resultados->get()]);
			}
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /resultados/{id}/edit
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
	 * PUT /resultados/{id}
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
	 * DELETE /resultados/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$resultado = Resultado::find($id);
		$resultado->delete();

		Session::flash('alertOn','Resultado restaurado exitosamente!.');
		return Redirect::back();
	}


	public function find()
	{
		$rules = array(
			'fecha'  => 'required|date_format:"m/d/Y"',
			'liga'   => 'required|min:1|max:4',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			Session::flash('alertOn','Ocurrio un error al buscar resultados.');
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {
			$fecha = Input::get('fecha');
			$fecha = explode('/', $fecha);
			$fecha = $fecha[2].'-'.$fecha[0].'-'.$fecha[1];

			$logros = Logro::where('fecha_partido', $fecha)
			->where('liga_id', e(Input::get('liga')));

			if ($logros->count() == 0) {
				Session::flash('alertOn','No existen juegos para la fecha seleccionada!');
				return Redirect::back()
					->withErrors($validator)
					->withInput();
			} else {
				return Redirect::to('/resultados/post/'.$fecha.'/'.e(Input::get('liga')).'');
			}
		}
	}

	public function post($fecha, $liga)
	{

		$logros = Logro::where('fecha_partido', $fecha)
				->where('liga_id', $liga);

			$alllogros = $logros->get();


		if ($logros->count() == 0) {
			Session::flash('alertOn','No existen juegos para la fecha seleccionada!');
			return Redirect::to('/');
		} else {
			return View::make('resultados.post', ['logro' => $alllogros, 'liga' => $liga]);
		}
	}



	public function postForm($deporte,$liga,$logro)
	{
		if ($deporte=='baseball') {
		$rules = array(
			'ma'   => 'min:1|max:6',
			'mb'   => 'min:1|max:6',
			'ca'   => 'min:1|max:6',
			'cb'   => 'min:1|max:6',
			'c'    => 'min:1|max:2',
			'd'    => 'min:1|max:2',
			'e'    => 'min:1|max:6'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			Session::flash('alertOn','Ocurrio un error al procesar su pedido.');
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {

			$resultado = Resultado::where('logro_id', $logro)
						->where('liga_id', $liga);

			if ($resultado->count() == 1) {
				$g = Resultado::where('logro_id', $logro)
						->where('liga_id', $liga)->get();

				$r = Resultado::find($g[0]->id);

				$r->logro_id = $logro;
				$r->liga_id  = $liga;
				$r->mitad_a                    = e(Input::get('ma'));
				$r->mitad_b                    = e(Input::get('mb'));
				$r->completo_a                 = e(Input::get('ca'));
				$r->completo_b                 = e(Input::get('cb'));
				$r->exoticas_quienanotaprimero = e(Input::get('d'));
				$r->exoticas_totalche          = e(Input::get('e'));
				$r->carreras_primer_inn        = e(Input::get('c'));

				$r->save();

				Session::flash('alertOn','Resultado publicados');
				return Redirect::back();
			} else {
				$r = new Resultado;

				$r->logro_id = $logro;
				$r->liga_id  = $liga;
				$r->mitad_a                    = e(Input::get('ma'));
				$r->mitad_b                    = e(Input::get('mb'));
				$r->completo_a                 = e(Input::get('ca'));
				$r->completo_b                 = e(Input::get('cb'));
				$r->exoticas_quienanotaprimero = e(Input::get('d'));
				$r->exoticas_totalche          = e(Input::get('e'));
				$r->carreras_primer_inn        = e(Input::get('c'));

				$r->save();
				Session::flash('alertOn','Resultado publicados');
				return Redirect::back();
			}

		}

		}
	}

}