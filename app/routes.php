<?php
define('WEB_EMPRESA_NOMBRE', 'MundoApuesta365');

Route::group(array('after' => 'auth'), function() {

	Route::get('login', ['uses' => 'SessionController@index']);
	Route::post('login', ['uses' => 'SessionController@create']);

});

Route::group(array('before' => 'auth'), function() {

	Route::get('/', [function() {
		return View::make('inicio');
	}]);

	Route::get('logout', ['uses' => 'SessionController@destroy']);

	// Para los usuarios que no son adminsitradores
	Route::get('/users/info/{id}',['uses'=>'UsersController@showinfuser']);
	Route::get('/users/limite/{id}',['uses'=>'LimitesController@showlimiteuser']);

	Route::resource('apuestas', 'ApuestasController');
	Route::get('apuestas/create/{param}', ['uses'=>'ApuestasController@preCreate']);
	Route::post('/apuestas/create/continuar', ['uses'=>'ApuestasController@continuar']);
	Route::post('/apuestas/create/referencia', ['uses'=>'ApuestasController@referencia']);
    Route::resource('ventas', 'VentasController');
    Route::post('/ventas/search', ['uses'=>'VentasController@search']);

    Route::resource('tikets', 'TiketsController');
    Route::post('/tikets/search', ['uses'=>'TiketsController@search']);

});

Route::group(array('before' => 'authAdmin'), function() {

	// Gestion de usuarios
	Route::get('/admin-usuarios', [function() {
		return View::make('users.index');
	}]);

	Route::get('/admin-usuarios-info/{id}', [function($id) {
		return View::make('users.show-user',['id'=>$id]);
	}]);

	Route::post('/admin-usuarios-crear', ['uses' => 'UsersController@create' ]);

	Route::get('/admin-usuarios-modificar/{id}', [function($id) {
		return View::make('users.update',['id'=>$id]);
	}]);

	Route::post('/admin-usuarios-modificar', ['uses' => 'UsersController@update' ]);

	Route::get('/admin-usuarios-eliminar/{id}', ['uses' => 'UsersController@destroy' ]);

	Route::get('/users/changeState/{id}', ['uses' => 'UsersController@changeState' ]);

	// Index equipos, deportes y ligas
	Route::get('/equipos-ligas', [function(){
		return View::make('equipos-ligas');
	}]);

	Route::resource('grupos', 'GruposController');
	Route::get('/grupos/newuser/{id}', ['uses'=>'GruposController@newuser']);
	Route::post('/grupos/newuser/{id}', ['uses'=>'GruposController@newuserpost']);

	Route::get('/grupos/move/{id}', ['uses'=>'GruposController@moveuser']);
	Route::post('/grupos/move/{id}', ['uses'=>'GruposController@moveuserpost']);

	// deportes
	Route::post('/deportes/create', ['uses' => 'DeportesController@create' ]);
	Route::post('/deportes/update', ['uses' => 'DeportesController@update' ]);
	Route::get('/deportes/destroy/{id}', ['uses' => 'DeportesController@destroy' ]);

	// ligas
	Route::post('/ligas/create', ['uses' => 'LigasController@create' ]);
	Route::post('/ligas/update', ['uses' => 'LigasController@update' ]);
	Route::get('/ligas/destroy/{id}', ['uses' => 'LigasController@destroy' ]);
	// equipos
	Route::post('/equipos/create', ['uses' => 'EquiposController@create' ]);
	Route::post('/equipos/update', ['uses' => 'EquiposController@update' ]);
	Route::get('/equipos/destroy/{id}', ['uses' => 'EquiposController@destroy' ]);

	// pitchers
	Route::post('/pitchers/create', ['uses' => 'PitchersController@create' ]);
	Route::post('/pitchers/update', ['uses' => 'PitchersController@update' ]);
	Route::get('/pitchers/destroy/{id}', ['uses' => 'PitchersController@destroy' ]);

	// logros
	Route::get('/logros', ['uses' => 'LogrosController@index' ]);

	Route::get('/logros/create/step/1', [function(){
		return View::make('logros.create', ['step'=>1]);
	}]);

	Route::get('/logros/create/step/2', [function(){
		return View::make('logros.create', [
					'step'=>2,
					'liga' => Input::get('liga_id'),
					'deporte' => Input::get('deporte_nombre'),
					'deporte_id' => Input::get('deporte_id'),
					'referencia' => Input::get('referencia') ]);
	}]);

	Route::post('/logros/create/step/1', ['uses' => 'LogrosController@create' ]);
	Route::post('/logros/search', ['uses' => 'LogrosController@search' ]);
	Route::get('/logros/show/{liga}/{f1}/{f2}', [function($liga,$f1,$f2){
		return View::make('logros.search', ['liga' => $liga, 'fecha1' => $f1, 'fecha2' => $f2 ]);
	}]);

	Route::post('/logros/update', ['uses' => 'LogrosController@update' ]);

	Route::get('/logros/edit', [function(){
		return View::make('logros.edit');
	}]);

	Route::post('/logros/edit', ['uses' => 'LogrosController@edit' ]);
	Route::get('/logros/destroy/{id}', ['uses' => 'LogrosController@destroy' ]);
	Route::get('/logros/changeState/{id}', ['uses' => 'LogrosController@changeState' ]);

	Route::post('/logros/hojas/search', ['uses' => 'HojasController@search' ]);
	Route::get('/logros/show/date/{fecha}', [function($fecha){
		return View::make('hojas.list', ['fecha' => $fecha]);
	}]);

	Route::post('/logros/hojas/print', ['uses' => 'HojasController@printHoja' ]);

	Route::resource('configs', 'ConfigsController');
	Route::resource('resultados', 'ResultadosController');
	Route::post('/resultados/find', ['uses' => 'ResultadosController@find' ]);

	Route::get('/resultados/post/{fecha}/{liga}', ['uses' => 'ResultadosController@post']);
	Route::post('/resultados/post/{deporte}/{liga}/{logro}', ['uses' => 'ResultadosController@postForm']);

	Route::resource('limites', 'LimitesController');
    Route::resource('restriccions', 'RestriccionsController');
    Route::get('/restriccion/delete/{id}', ['uses' => 'RestriccionsController@destroy']);
});
