<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Pagina principal
use App\DatosEmpresa;
use App\RequisitosVacante;
use App\InformacionContacto;
use App\vacante;
use App\Fecha;

/**
 * Landing
 */

Route::get('/', function () {
    if(Auth()->guest())
    {
        $empresas = DatosEmpresa::orderBy('id_empresa','DESC')->limit('12')->get();
        $municipios = vacante::select('lugar_vacante')->distinct()->get();
        $vacantes = \DB::SELECT("SELECT * FROM vacantes 
                                INNER JOIN datos_empresas ON vacantes.id_empresa = datos_empresas.id_empresa 
                                INNER JOIN fechas ON vacantes.id_vacante = fechas.id_vacante
                                ORDER BY vacantes.created_at DESC LIMIT 10");
        $requisitos = RequisitosVacante::All();
        $info = InformacionContacto::All();
        $fechas = Fecha::All();
        
        return view('welcome', compact('empresas', 'municipios', 'vacantes','requisitos','info','fechas'));
        //return view('welcome');
    }
    else
    {
        return redirect()->route('home');
    }
});

Route::get('/busco_empleo', function () {
    return view('buscoempleo');
});

Route::get('/ofrezco_empleo', function () {
    return view('ofrezcoempleo');
});

//Busqueda
Route::get('/search', 'VacantesController@index')->name('buscar'); 

/**
 * Auth
 */
Auth::routes();
Auth::routes(['verify' => true]);

//home
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/getMpios','HomeController@getMpios')->name('getMpios');
Route::get('/micuenta', 'HomeController@micuenta')->name('micuenta')->middleware('verified');

// Rutas PDF
Route::get('/cvpdf', 'HomeController@exportarpdf')->middleware('auth');
Route::get('/cvuserpdf/{nombre_completo}', 'VacantesController@cvuserpdf')->name('cvuserpdf')->middleware('auth');

// Curriculum
Route::POST('/curriculum', 'HomeController@curriculum')->name('curriculum')->middleware('auth');
Route::POST('/guardarcurriculum', 'HomeController@guardarcurriculum')->name('guardarcurriculum')->middleware('auth');
Route::POST('/actualizarcurriculum', 'HomeController@actualizarcurriculum')->name('actualizarcurriculum')->middleware('auth');
Route::POST('/archivocv', 'HomeController@archivocv')->name('archivocv')->middleware('auth');
Route::POST('/archivocvact', 'HomeController@archivocvact')->name('archivocvact')->middleware('auth');

// Ciudadano
Route::POST('/guardardatosc', 'HomeController@guardardatosc')->name('guardardatosc')->middleware('auth');
Route::POST('/actualizardatosc', 'HomeController@actualizardatosc')->name('actualizardatosc')->middleware('auth');

// Empresa
Route::POST('/guardardatosemp', 'HomeController@guardardatosemp')->name('guardardatosemp')->middleware('auth');
Route::POST('/modificardatosemp', 'HomeController@modificardatosemp')->name('modificardatosemp')->middleware('auth');
Route::get('modificarestadoemp', 'HomeController@modificarestadoemp')->name('modificarestadoemp')->middleware('auth');

// Vacantes
Route::get('vacante/{slug}', 'VacantesController@show')->name('vacante');
Route::POST('/guardarvacante', 'VacantesController@create')->name('guardarvacante')->middleware('auth');
Route::get('vacante/{id}/editar', 'VacantesController@edit')->name('editarvacante')->middleware('auth');
Route::POST('vacante/{id}/actualizar', 'VacantesController@update')->name('actualizarvacante')->middleware('auth');

// Postulacion
Route::POST('/postulacion', 'VacantesController@postulacion')->name('postulacion')->middleware('auth');

// Email
Route::get('/email_contacto/{email}', 'VacantesController@contactar')->name('correo')->middleware('auth');
Route::POST('/contacto','MailController@store')->name('contacto');

// Offline
Route::get('/offline', function () {    
    return view('vendor/laravelpwa/offline');
});

