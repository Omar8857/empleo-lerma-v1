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

// landing
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

Auth::routes();

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/getMpios','HomeController@getMpios')->name('getMpios');

// Rutas para Mi Cuenta
Route::get('/micuenta', 'HomeController@micuenta')->name('micuenta')->middleware('verified');

// Rutas PDF
Route::get('/cvpdf', 'HomeController@exportarpdf')->middleware('auth');
Route::get('/cvuserpdf/{nombre_completo}', 'VacantesController@cvuserpdf')->name('cvuserpdf')->middleware('auth');

//Ruta para guardar curriculum de usuario
Route::POST('/curriculum', 'HomeController@curriculum')->name('curriculum');
Route::POST('/guardarcurriculum', 'HomeController@guardarcurriculum')->name('guardarcurriculum');
Route::POST('/actualizarcurriculum', 'HomeController@actualizarcurriculum')->name('actualizarcurriculum');
Route::POST('/archivocv', 'HomeController@archivocv')->name('archivocv');
Route::POST('/archivocvact', 'HomeController@archivocvact')->name('archivocvact');

Route::POST('/guardardatosc', 'HomeController@guardardatosc')->name('guardardatosc');
Route::POST('/actualizardatosc', 'HomeController@actualizardatosc')->name('actualizardatosc');

//Vacantes
Route::get('vacante/{slug}', 'VacantesController@show')->name('vacante');

//Busqueda
Route::get('/search', 'VacantesController@index')->name('buscar'); 

//Guardar datos empresa
Route::POST('/guardardatosemp', 'HomeController@guardardatosemp')->name('guardardatosemp');

//Modificar datos empresa
Route::POST('/modificardatosemp', 'HomeController@modificardatosemp')->name('modificardatosemp');

//Ruta para postulacion
Route::POST('/postulacion', 'VacantesController@postulacion')->name('postulacion');

//Ruta para guardar vacante
Route::POST('/guardarvacante', 'VacantesController@create')->name('guardarvacante');

Route::get('/offline', function () {    
    return view('vendor/laravelpwa/offline');
});

//Email
Route::get('/email_contacto/{email}', 'VacantesController@contactar')->name('correo')->middleware('auth');

Route::POST('/contacto','MailController@store')->name('contacto');