<?php

class LimitesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /limites
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('limites.index');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /limites/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'acepta_derecho'   => 'required|min:1|max:2',
			'maximo_parlays'   => 'required|min:1|max:3',
			'minimo_parlays'   => 'required|min:1|max:3',
			'maximo_hembras'   => 'required|min:1|max:3',
			'max_monto_der'    => 'required|min:1|max:30',
			'max_monto_par'    => 'required|min:1|max:30',
			'max_der_perder'   => 'required|min:1|max:30',
			'max_premio'       => 'required|min:1|max:30',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			Session::flash('alertOn', 'Verfique que este llenando cada uno de los campos.');
			return Redirect::to('limites');
		} else {

			$limite = Limite::where('user_id', $id);
			if ($limite->count() == 1) {
				$yy = $limite->get();
				$gg= Limite::find($yy[0]->id);

				$gg->acepta_derecho = e(Input::get('acepta_derecho'));
				$gg->maximo_parlays = e(Input::get('maximo_parlays'));
				$gg->minimo_parlays = e(Input::get('minimo_parlays'));
				$gg->maximo_hembras = e(Input::get('maximo_hembras'));
				$gg->max_monto_der  = e(Input::get('max_monto_der'));
				$gg->max_monto_par  = e(Input::get('max_monto_par'));
				$gg->max_der_perder = e(Input::get('max_der_perder'));
				$gg->max_premio     = e(Input::get('max_premio'));

			} else {
				$gg= new Limite;
				$gg->user_id		= e($id);
				$gg->acepta_derecho = e(Input::get('acepta_derecho'));
				$gg->maximo_parlays = e(Input::get('maximo_parlays'));
				$gg->minimo_parlays = e(Input::get('minimo_parlays'));
				$gg->maximo_hembras = e(Input::get('maximo_hembras'));
				$gg->max_monto_der  = e(Input::get('max_monto_der'));
				$gg->max_monto_par  = e(Input::get('max_monto_par'));
				$gg->max_der_perder = e(Input::get('max_der_perder'));
				$gg->max_premio     = e(Input::get('max_premio'));

			}

			if ($gg->save()){
				Session::flash('alertOn', 'Limite actualizado!');
				return Redirect::to('/limites');
			} else {
				Session::flash('alertOn', 'Limite no modificado ?!');
				return Redirect::back()
				->withErrors($validator)
				->withInput();
			}

		}
	}

	public function showlimiteuser($id){
		return View::make('limites.show', ['id' => $id]);
	}

}