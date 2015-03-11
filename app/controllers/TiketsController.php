<?php

class TiketsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /tikets
	 *
	 * @return Response
	 */
    public function index()
    {
        return View::make('tikets.index');
    }

    /**
     *
     */
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

        $tikets = array();

        $ventas = Ventum::whereBetween('created_at', array($f1, $f2))->where('user_id', Auth::user()->id)->get();

        foreach($ventas as $venta) {

            if(Input::get('estado') == 'TODOS') {
                $estado = array('PENDIENTE', 'GANADOR', 'EMPATADO', 'PERDEDOR');
            } else {
                $estado = array(Input::get('estado'));
            }

            if(Input::get('pago') == 'TODOS') {
                $pago = array('PAGADO', 'NO-PAGADO', 'ANULADO', 'VENCIDO', 'REPORTADO');
            } else {
                $pago = array(Input::get('pago'));
            }


            $tiket = Tiket::where('id', $venta->tiket_id)
                ->whereIn('estado', $estado)
                ->whereIn('pago', $pago)
                ->whereBetween('monto', array(Input::get('r1'), Input::get('r2')))
                ->get();


            array_push($tikets, $tiket[0]);

        }

        return View::make('tikets.index', ['tikets' => $tikets]);
    }

	/**
	 * Show the form for creating a new resource.
	 * GET /tikets/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /tikets
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /tikets/{id}
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
	 * GET /tikets/{id}/edit
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
	 * PUT /tikets/{id}
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
	 * DELETE /tikets/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}