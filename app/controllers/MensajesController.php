<?php

class MensajesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /mensajes
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::user()->rol == 1){

			$msj = Mensaje::where("de_id_user", Auth::user()->rol)->orderBy("id", "DESC")->paginate(7);
		}else{

			$msj = Mensaje::orderBy("id", "DESC")->paginate(7);
		}
		return View::make("mensajes.index", ["msj" => $msj]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /mensajes/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$todos = User::where("id", "!=", Auth::user()->id)->get();
		$grupos = Grupo::all();

		return View::make("mensajes.create", [
			"todos" 	=> $todos,
			"grupos"	=> $grupos
			]);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /mensajes
	 *
	 * @return Response
	 */
	public function store()
	{
		switch (Input::get("para")) {
			case 1:
				# todos
				$v = "todos";
				$v = Array(
					"de_id_user" 	=> Auth::user()->id,
					"para_id"		=> "todos",
					"titulo"		=> Input::get("titulo"),
					"msj"			=> Input::get("msj")
					);
			break;

			case 2:
				#grupos
				$v = Array(
					"de_id_user" 	=> Auth::user()->id,
					"para_id"		=> "Grupo: ".Input::get("grupos"),
					"titulo"		=> Input::get("titulo"),
					"msj"			=> Input::get("msj")
					);
			break;

			case 3:
				# user
				$para = "";
				foreach (Input::get("todos") as $key => $value) {
					$para .= $value.",";
				}
				$v = Array(
					"de_id_user" 	=> Auth::user()->id,
					"para_id"		=> "User:".$para,
					"titulo"		=> Input::get("titulo"),
					"msj"			=> Input::get("msj")
					);
			break;
			
			default:
				return Redirect::to("/");
			break;
		}

		$m = new Mensaje();

		$m->de_id_user = $v["de_id_user"];
		$m->para_id = $v["para_id"];
		$m->titulo 	= $v["titulo"];
		$m->msj 	= $v["msj"];

		$m->save();

		return Redirect::to("mensajes");
	}

	/**
	 * Display the specified resource.
	 * GET /mensajes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$m = Mensaje::find($id);

		return View::make("mensajes.show", ["msj" => $m]);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /mensajes/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$todos 		= User::where("id", "!=", Auth::user()->id)->get();
		$grupos 	= Grupo::all();
		$msj 		= Mensaje::find($id);

		return View::make("mensajes.edit", [
			"todos" 	=> $todos,
			"grupos"	=> $grupos,
			"msj" 		=> $msj
			]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /mensajes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		switch (Input::get("para")) {
			case 1:
				# todos
				$v = "todos";
				$v = Array(
					"de_id_user" 	=> Auth::user()->id,
					"para_id"		=> "todos",
					"titulo" 		=> Input::get("titulo"),
					"msj"			=> Input::get("msj")
					);
			break;

			case 2:
				#grupos
				$v = Array(
					"de_id_user" 	=> Auth::user()->id,
					"para_id"		=> "Grupo: ".Input::get("grupos"),
					"titulo" 		=> Input::get("titulo"),
					"msj"			=> Input::get("msj")
					);
			break;

			case 3:
				# user
				$para = "";
				foreach (Input::get("todos") as $key => $value) {
					$para .= $value.",";
				}
				$v = Array(
					"de_id_user" 	=> Auth::user()->id,
					"para_id"		=> "User:".$para,
					"titulo" 		=> Input::get("titulo"),
					"msj"			=> Input::get("msj")
					);
			break;
			
			default:
				return Redirect::to("/");
			break;
		}

		$msj = Mensaje::find($id);

		$msj->para_id 	= e($v["para_id"]);
		$msj->msj 		= e($v["msj"]);

		$msj->save();

		return Redirect::to("mensajes");
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /mensajes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$msj = Mensaje::find($id);

		$msj->delete();

		return Redirect::to("mensajes");
	}

	public static function para($c, $idUser, $idGrupo){

		if(strstr($c, "Grupo:")){

			//Grupo
			$c = explode(":", $c);
			$id = $c[1];

			$id = (int) $id;

			if($idGrupo == $id){

				return true;
			}else{
				return false;
			}
		}else{
			//Usuarios
			$c = explode(":", $c);
			$c = explode(",", $c[1]);

			foreach ($c as $key => $value) {

				$value = (int) $value;
				if($idUser == $value){

					return true;
				}else{
					continue;
				}
			}
		}
	}

}