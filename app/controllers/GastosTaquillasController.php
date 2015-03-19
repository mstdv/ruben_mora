<?php

class GastosTaquillasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /gastostaquillas
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::user()->rol == 2){

			$taquillas = User::where("id", "!=", Auth::user()->id)
				->where("grupo_id", Auth::user()->grupo_id)->get();

			$g = array();
			$totalHoy = 0;
			$total = 0;

			foreach($taquillas as $a){

				$totalHoy += GastosTaquilla::where("user_id", $a->id)
					->where("status", 1)->where("fecha", Date("Y-m-d"))->sum("monto");
				$total += GastosTaquilla::where("user_id", $a->id)->sum("monto");
			}
			return View::make("gastos_taquillas.index", [
				"totalHoy" => $totalHoy,
				"total" => $total,
				"taquillas" => $taquillas]);

		}else if(Auth::user()->rol == 3){

			$g = GastosTaquilla::where("user_id", Auth::user()->id)->where("fecha", Date("Y-m-d"))->get();
			$totalHoy = GastosTaquilla::where("user_id", Auth::user()->id)
				->where("status", 1)->where("fecha", Date("Y-m-d"))->sum("monto");
			$total = GastosTaquilla::where("user_id", Auth::user()->id)->sum("monto");

			return View::make("gastos_taquillas.index", [
				"gastos" 	=> $g,
				"totalHoy" 	=> $totalHoy,
				"total" 	=> $total]);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /gastostaquillas/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make("gastos_taquillas.create");
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /gastostaquillas
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules 	= [
			"tipo de gasto" => "required|min:3",
			"N Factura" 	=> "required|min:5",
			"Monto" 	=> "required|min:2"
		];
		$values = [
			"tipo de gasto" => Input::get("tipo_gasto"),
			"N Factura" 	=> Input::get("n_factura"),
			"Monto" 		=> Input::get("monto")
		];

		$v = Validator::make($values, $rules);

		if($v->fails()){

			Session::flash("msj", $v->messages()->all());
			return Redirect::back()->withErrors($v)->withInput();

		}else{

			$g = new GastosTaquilla();

			$g->user_id 	= Auth::user()->id;
			$g->tipo_gasto 	= Input::get("tipo_gasto");
			$g->fecha 		= Input::get("fecha");
			$g->n_factura 	= Input::get("n_factura");
			$g->monto 		= Input::get("monto");
			$g->status 		= Input::get("status");

			$g->save();

			return Redirect::to("gastos");
		}
	}

	/**
	 * Display the specified resource.
	 * GET /gastostaquillas/{id}
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
	 * GET /gastostaquillas/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$g = GastosTaquilla::find($id);
		return View::make("gastos_taquillas.edit", ["g" => $g]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /gastostaquillas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$g = GastosTaquilla::find($id);
		$rules 	= [
			"tipo de gasto" => "required|min:3",
			"N Factura" 	=> "required|min:5",
			"Monto" 	=> "required|min:2"
		];
		$values = [
			"tipo de gasto" => Input::get("tipo_gasto"),
			"N Factura" 	=> Input::get("n_factura"),
			"Monto" 		=> Input::get("monto")
		];

		$v = Validator::make($values, $rules);

		if($v->fails()){

			Session::flash("msj", $v->messages()->all());
			return Redirect::back()->withErrors($v)->withInput();

		}else{

			$g->tipo_gasto 	= e(Input::get("tipo_gasto"));
			$g->n_factura 	= e(Input::get("n_factura"));
			$g->monto 		= e(Input::get("monto"));
			$g->fecha 		= e(Input::get("fecha"));

			$g->save();

			return Redirect::to("gastos");
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /gastostaquillas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function change($id)
	{
		$g = GastosTaquilla::find($id);

		if($g->status == 1){

			$g->status = 0;
		}else{
			$g->status = 1;
		}

		$g->save();
		return Redirect::to("gastos");
	}

	public function buscarFecha()
	{
		$rules = [
			"fecha 1" => ["required", "regex:/^(\d){4}-(\d){2}-(\d){2}$/"],
			"fecha 2" => ["required", "regex:/^(\d){4}-(\d){2}-(\d){2}$/"],
		];

		$va = [
			"fecha 1" => Input::get("f1"),
			"fecha 2" => Input::get("f2")
		];

		$v = Validator::make($va, $rules);

		if($v->fails()){

			Session::flash("msj", $v->messages()->all());
			return Redirect::back()->withErrors($v)->withInput();
		}else{
			$g = [
				e(Input::get("f1")),
				e(Input::get("f2"))
			];
			$gastos = GastosTaquilla::where("user_id", Auth::user()->id)->whereBetween("fecha", $g)
				->orderBy("fecha", "desc")->get();

			$total = 0;

			foreach ($gastos as $a) {
				if($a->status != "0"){

					$total += $a->monto;
				}
			}

			$totalHoy = GastosTaquilla::where("user_id", Auth::user()->id)
				->where("status", 1)->where("fecha", Date("Y-m-d"))->sum("monto");

			return View::make("gastos_taquillas.index", [
				"gastos" 	=> $gastos,
				"totalHoy"	=> $totalHoy,
				"total" 	=> $total]);
		}
	}

}