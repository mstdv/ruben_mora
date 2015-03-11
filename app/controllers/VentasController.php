<?php

class VentasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /ventas
	 *
	 * @return Response
	 */
    public function index()
    {
        return View::make('ventas.index');
    }

    public function search()
    {
        $f1 = null;
        $f1 = e(Input::get('desde'));
        $f1 = explode('/', $f1);
        $f1 = $f1[2].'-'.$f1[0].'-'.$f1[1];

        $f2 = null;
        $f2 = e(Input::get('hasta'));
        $f2 = explode('/', $f2);
        $f2 = $f2[2].'-'.$f2[0].'-'.$f2[1];


        $ventas = Ventum::whereBetween('created_at', array($f1, $f2))->where('user_id', Auth::user()->id)->get();
        $apostado = 0;
        $ganadores = 0;

        foreach($ventas as $venta){
            $tiket = Tiket::where('id', $venta->tiket_id)->get();
            $apostado = $apostado + $tiket[0]->monto;

        }

        return View::make('ventas.index', ['ventas' => true,'apostados'=>$apostado, 'ganadores'=>$ganadores, 'saldo'=>$apostado-$ganadores]);

    }

	/**
	 * Show the form for creating a new resource.
	 * GET /ventas/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /ventas
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /ventas/{id}
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
	 * GET /ventas/{id}/edit
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
	 * PUT /ventas/{id}
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
	 * DELETE /ventas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}