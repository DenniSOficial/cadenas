<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin;

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


Route::get('/', function() {
    return redirect()->route('login');
});

Route::get('login', [Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [Auth\LoginController::class, 'authenticate'])->name('login');



Route::middleware(['admin'])->group(function () {

    Route::post('logout', [Auth\LoginController::class, 'logout'])->name('logout');
    /* Route::prefix('admin')->group(function () {
        Route::get('/users', function () {
            // Matches The "/admin/users" URL
        });
    }); */

    //Route::get('/admin', [HomeController::class, 'index'])->name('admin');

    Route::prefix('admin')->group(function () {

        Route::get('/', [HomeController::class, 'index'])->name('admin');
        //Route::get('/clientes', [HomeController::class, 'index']);

        Route::prefix('ruido')->group(function() {

            Route::get('/', [Admin\RuidoController::class, 'index'])->name('ruido.index');
            Route::get('/create', [Admin\RuidoController::class, 'create'])->name('ruido.create');
            Route::post('/store', [Admin\RuidoController::class, 'store'])->name('ruido.store');
            Route::get('/edit/{id}', [Admin\RuidoController::class, 'edit'])->name('ruido.edit');
            Route::post('/update/{id}', [Admin\RuidoController::class, 'update'])->name('ruido.update');
            Route::delete('/delete/{id}', [Admin\RuidoController::class, 'delete'])->name('ruido.delete');
            Route::get('/show/{id}', [Admin\RuidoController::class, 'show'])->name('ruido.show');
            Route::get('/recepcion-muestra/{id}', [Admin\RuidoController::class, 'recepcionMuestra'])->name('ruido.recepcion-muestra');
            Route::post('/recepcion-muestra-update/{id}', [Admin\RuidoController::class, 'recepcionMuestraUpdate'])->name('ruido.recepcion-muestra-update');
            Route::get('/print/{id}', [Admin\RuidoController::class, 'print'])->name('ruido.print');
            Route::get('/habilitar-cadena/{id}', [Admin\RuidoController::class, 'habilitarDeshabilitarCadena'])->name('ruido.habilitar-deshabilitar');
            Route::get('/cambiar-estado-cadena/{id}/{idEstado}', [Admin\RuidoController::class, 'cambiarEstadoCadena'])->name('ruido.cambiar-estado-cadena');
            Route::post('/find-cotizacion-ajax', [Admin\RuidoController::class, 'findCotizacionAjax'])->name('ruido.search.cotizacion.ajax');
            Route::get('/informe/{id}', [Admin\RuidoController::class, 'informe'])->name('ruido.informe');
            Route::post('/informe/{id}', [Admin\RuidoController::class, 'informeUpdate'])->name('ruido.informe.update');
            Route::get('/unir/{id}', [Admin\RuidoController::class, 'unir'])->name('ruido.unir');
            Route::post('/unir/{id}', [Admin\RuidoController::class, 'unirUpdate'])->name('ruido.unir.update');
            Route::get('/duplicar/{id}', [Admin\RuidoController::class, 'duplicar'])->name('ruido.duplicar');
            //Detalle
            Route::prefix('detalle')->group(function() {
                Route::get('{id}/create', [Admin\RuidoController::class, 'createDetail'])->name('ruido.detalle.create');
                Route::post('{id}/store', [Admin\RuidoController::class, 'storeDetail'])->name('ruido.detalle.store');
                Route::get('edit/{id}', [Admin\RuidoController::class, 'editDetail'])->name('ruido.detalle.edit');
                Route::post('/update/{id}', [Admin\RuidoController::class, 'updateDetail'])->name('ruido.detalle.update');
                Route::delete('/delete/{id}', [Admin\RuidoController::class, 'deleteDetail'])->name('ruido.detalle.delete');
                Route::get('print/informe-valor/{id}', [Admin\RuidoController::class, 'printInformeValorOficial'])->name('ruido.detalle.print.informe-valor');

                Route::get('{id}/datos-medicion/{medicion}/{periodo}', [Admin\RuidoController::class, 'datosMedicion'])->name('ruido.detalle.medicion');
                Route::post('datos-medicion/update/{id}', [Admin\RuidoController::class, 'datosMedicionUpdate'])->name('ruido.detalle.medicion.store');

                Route::get('{id}/datos-muestreo/{muestreo}', [Admin\RuidoController::class, 'datosMuestreo'])->name('ruido.detalle.muestreo');
                Route::post('datos-muestreo/update/{id}', [Admin\RuidoController::class, 'datosMuestreoUpdate'])->name('ruido.detalle.muestreo.store');

                Route::get('{id}/datos-metereologico/{metereologico}/{periodo}', [Admin\RuidoController::class, 'datosMetereologico'])->name('ruido.detalle.metereologico');
                Route::post('datos-metereologico/update/{id}', [Admin\RuidoController::class, 'datosMetereologicoUpdate'])->name('ruido.detalle.metereologico.store');

                Route::get('{id}/datos-verificacion/{verificacion}/{periodo}', [Admin\RuidoController::class, 'datosVerificacion'])->name('ruido.detalle.verificacion');
                Route::post('datos-verificacion/update/{id}', [Admin\RuidoController::class, 'datosVerificacionUpdate'])->name('ruido.detalle.verificacion.store');

                Route::get('{id}/informacion-medicion/{periodo}', [Admin\RuidoController::class, 'datosInformacionMedicion'])->name('ruido.detalle.informacion-medicion');
                Route::post('informacion-medicion/update/{id}', [Admin\RuidoController::class, 'datosInformacionMedicionUpdate'])->name('ruido.detalle.informacion-medicion.store');
                Route::post('informacion-medicion/import/{id}', [Admin\RuidoController::class, 'fileImport'])->name('file-import');
                Route::get('informacion-medicion/download', [Admin\RuidoController::class, 'fileDownload'])->name('file-download');

                Route::get('{medicion}/informacion-medicion-form/{id}/{periodo}', [Admin\RuidoController::class, 'datosInformacionMedicionForm'])->name('ruido.detalle.informacion-form');
                Route::post('informacion-medicion-form/update/{id}', [Admin\RuidoController::class, 'datosInformacionMedicionFormUpdate'])->name('ruido.detalle.informacion-form.store');
                Route::get('informacion-medicion-print/{id}/{periodo}', [Admin\RuidoController::class, 'printdatosInformacionMedicion'])->name('ruido.detalle.informacion-print');

                Route::get('informacion-medicion-incertidumbre-print/{id}/{periodo}', [Admin\RuidoController::class, 'printdatosInformacionCalculoIncertidumbreMedicion'])->name('ruido.detalle.informacion.incertidumbre-print');
            });

        });

        Route::prefix('agua')->group(function() {

            Route::get('/', [Admin\AguaController::class, 'index'])->name('agua.index');
            Route::get('/create', [Admin\AguaController::class, 'create'])->name('agua.create');
            Route::post('/store', [Admin\AguaController::class, 'store'])->name('agua.store');
            Route::get('/edit/{id}', [Admin\AguaController::class, 'edit'])->name('agua.edit');
            Route::post('/update/{id}', [Admin\AguaController::class, 'update'])->name('agua.update');
            Route::get('/verificacion-operacional/{id}', [Admin\AguaController::class, 'verificacionOperacional'])->name('agua.verificacion-operacional');
            Route::post('/verificacion-operacional/{id}', [Admin\AguaController::class, 'verificacionOperacionalUpdate'])->name('agua.verificacion-operacional.update');
            Route::get('/verificacion-operacional/{id}/{tipo}', [Admin\AguaController::class, 'verificacionOperacionalForm'])->name('agua.verificacion-operacional.form');
            Route::get('/print/verificacion-operacional/{id}', [Admin\AguaController::class, 'verificacionOperacionalPrint'])->name('agua.verificacion-operacional.print');
            Route::get('/plan-muestreo/{id}', [Admin\AguaController::class, 'planMuestreo'])->name('agua.plan-muestreo');
            Route::delete('/delete/{id}', [Admin\AguaController::class, 'delete'])->name('agua.delete');
            Route::get('/show/{id}', [Admin\AguaController::class, 'show'])->name('agua.show');
            Route::get('/recepcion-muestra/{id}', [Admin\AguaController::class, 'recepcionMuestra'])->name('agua.recepcion-muestra');
            
            Route::get('/print/{id}', [Admin\AguaController::class, 'print'])->name('agua.print'); 
            //Route::resource('agua', Admin\AguaController::class);

            Route::prefix('detalle')->group(function() {
                Route::get('{id}/create', [Admin\AguaController::class, 'createDetail'])->name('agua.detalle.create');
                Route::post('{id}/store', [Admin\AguaController::class, 'storeDetail'])->name('agua.detalle.store');
                Route::get('{cadena}/edit/{id}', [Admin\AguaController::class, 'editDetail'])->name('agua.detalle.edit');
                Route::post('{cadena}/update/{id}', [Admin\AguaController::class, 'updateDetail'])->name('agua.detalle.update');
                Route::delete('/delete/{id}', [Admin\AguaController::class, 'deleteDetail'])->name('agua.detalle.delete');
                Route::get('{id}/print-registro-campo', [Admin\AguaController::class, 'printRegistroCampo'])->name('agua.detalle.print-registro-campo');
            });

            Route::prefix('muestreo')->group(function() {
                Route::get('{id}/create', [Admin\AguaController::class, 'createMuestreo'])->name('agua.muestreo.create');
                Route::post('{id}/store', [Admin\AguaController::class, 'storeMuestreo'])->name('agua.muestreo.store');
                Route::get('{cadena}/edit/{id}', [Admin\AguaController::class, 'editMuestreo'])->name('agua.muestreo.edit');
                Route::post('{cadena}/update/{id}', [Admin\AguaController::class, 'updateMuestreo'])->name('agua.muestreo.update');
                Route::get('{cadena}/print/{id}', [Admin\AguaController::class, 'printMuestreo'])->name('agua.muestreo.print');
                Route::delete('/delete/{id}', [Admin\AguaController::class, 'deleteMuestreo'])->name('agua.muestreo.delete');
            });
        });

        Route::prefix('radiacion')->group(function() {

            Route::get('/', [Admin\RadiacionController::class, 'index'])->name('radiacion.index');
            Route::get('/create', [Admin\RadiacionController::class, 'create'])->name('radiacion.create');
            Route::post('/store', [Admin\RadiacionController::class, 'store'])->name('radiacion.store');
            Route::get('/edit/{id}', [Admin\RadiacionController::class, 'edit'])->name('radiacion.edit');
            Route::post('/update/{id}', [Admin\RadiacionController::class, 'update'])->name('radiacion.update');
            Route::delete('/delete/{id}', [Admin\RadiacionController::class, 'delete'])->name('radiacion.delete');
            Route::get('/show/{id}', [Admin\RadiacionController::class, 'show'])->name('radiacion.show');

        });

        Route::prefix('iluminacion')->group(function() {

            Route::get('/', [Admin\IluminacionController::class, 'index'])->name('iluminacion.index');
            Route::get('/create', [Admin\IluminacionController::class, 'create'])->name('iluminacion.create');
            Route::post('/store', [Admin\IluminacionController::class, 'store'])->name('iluminacion.store');
            Route::get('/edit/{id}', [Admin\IluminacionController::class, 'edit'])->name('iluminacion.edit');
            Route::post('/update/{id}', [Admin\IluminacionController::class, 'update'])->name('iluminacion.update');
            Route::delete('/delete/{id}', [Admin\IluminacionController::class, 'delete'])->name('iluminacion.delete');
            Route::get('/show/{id}', [Admin\IluminacionController::class, 'show'])->name('iluminacion.show');
            Route::get('/print/{id}', [Admin\IluminacionController::class, 'print'])->name('iluminacion.print');
            Route::get('/informe/{id}', [Admin\IluminacionController::class, 'informe'])->name('iluminacion.informe');
            Route::post('/informe/{id}', [Admin\IluminacionController::class, 'informeUpdate'])->name('iluminacion.informe.update');
            Route::get('/cambiar-estado-cadena/{id}/{idEstado}', [Admin\IluminacionController::class, 'cambiarEstadoCadena'])->name('iluminacion.cambiar-estado-cadena');
            Route::get('/unir/{id}', [Admin\IluminacionController::class, 'unir'])->name('iluminacion.unir');
            Route::get('/duplicar/{id}', [Admin\IluminacionController::class, 'duplicar'])->name('iluminacion.duplicar');
            Route::get('/recepcion-muestra/{id}', [Admin\IluminacionController::class, 'recepcionMuestra'])->name('iluminacion.recepcion-muestra');
            Route::post('/recepcion-muestra-update/{id}', [Admin\IluminacionController::class, 'recepcionMuestraUpdate'])->name('iluminacion.recepcion-muestra-update');

            //Detalle
            Route::prefix('detalle')->group(function() {
                Route::get('{id}/create', [Admin\IluminacionController::class, 'createDetail'])->name('iluminacion.detalle.create');
                Route::post('{id}/store', [Admin\IluminacionController::class, 'storeDetail'])->name('iluminacion.detalle.store');
                Route::get('edit/{id}', [Admin\IluminacionController::class, 'editDetail'])->name('iluminacion.detalle.edit');
                Route::post('/update/{id}', [Admin\IluminacionController::class, 'updateDetail'])->name('iluminacion.detalle.update');
                Route::delete('/delete/{id}', [Admin\IluminacionController::class, 'deleteDetail'])->name('iluminacion.detalle.delete');
                Route::get('print/informe-valor/{id}', [Admin\IluminacionController::class, 'printInformeValorOficial'])->name('iluminacion.detalle.print.informe-valor');

                Route::get('{id}/datos-medicion/{medicion}/{periodo}', [Admin\IluminacionController::class, 'datosMedicion'])->name('iluminacion.detalle.medicion');
                Route::post('datos-medicion/update/{id}', [Admin\IluminacionController::class, 'datosMedicionUpdate'])->name('iluminacion.detalle.medicion.store');

                Route::get('{id}/datos-muestreo/{muestreo}', [Admin\IluminacionController::class, 'datosMuestreo'])->name('iluminacion.detalle.muestreo');
                Route::post('datos-muestreo/update/{id}', [Admin\IluminacionController::class, 'datosMuestreoUpdate'])->name('iluminacion.detalle.muestreo.store');

                Route::get('{id}/datos-metereologico/{metereologico}/{periodo}', [Admin\IluminacionController::class, 'datosMetereologico'])->name('iluminacion.detalle.metereologico');
                Route::post('datos-metereologico/update/{id}', [Admin\IluminacionController::class, 'datosMetereologicoUpdate'])->name('iluminacion.detalle.metereologico.store');

                Route::get('{id}/datos-verificacion/{verificacion}/{periodo}', [Admin\IluminacionController::class, 'datosVerificacion'])->name('iluminacion.detalle.verificacion');
                Route::post('datos-verificacion/update/{id}', [Admin\IluminacionController::class, 'datosVerificacionUpdate'])->name('iluminacion.detalle.verificacion.store');

                Route::get('{id}/informacion-medicion', [Admin\IluminacionController::class, 'datosInformacionMedicion'])->name('iluminacion.detalle.informacion-medicion');
                Route::post('informacion-medicion/update/{id}', [Admin\IluminacionController::class, 'datosInformacionMedicionUpdate'])->name('iluminacion.detalle.informacion-medicion.store');
                // Route::post('informacion-medicion/import/{id}', [Admin\IluminacionController::class, 'fileImport'])->name('file-import');
                // Route::get('informacion-medicion/download', [Admin\IluminacionController::class, 'fileDownload'])->name('file-download');

                Route::get('{id}/informacion-medicion-form/{info}', [Admin\IluminacionController::class, 'datosInformacionMedicionForm'])->name('iluminacion.detalle.informacion-form');
                Route::post('informacion-medicion-form/update', [Admin\IluminacionController::class, 'datosInformacionMedicionFormUpdate'])->name('iluminacion.detalle.informacion-form.store');
                //Route::get('informacion-medicion-print/{id}/{periodo}', [Admin\IluminacionController::class, 'printdatosInformacionMedicion'])->name('iluminacion.detalle.informacion-print');

                Route::get('registro-medicion-print/{id}', [Admin\IluminacionController::class, 'printRegistroMedicion'])->name('iluminacion.detalle.registro-medicion-print');
            });

        });

        Route::prefix('mantenimiento')->group(function() {

            Route::prefix('buffer')->group(function() {
                Route::get('/', [Admin\Mantenimiento\BufferController::class, 'index'])->name('mantenimiento.buffer.index');
                Route::get('/create', [Admin\Mantenimiento\BufferController::class, 'create'])->name('mantenimiento.buffer.create');
                Route::post('/store', [Admin\Mantenimiento\BufferController::class, 'store'])->name('mantenimiento.buffer.store');
                Route::get('/edit/{id}', [Admin\Mantenimiento\BufferController::class, 'edit'])->name('mantenimiento.buffer.edit');
                Route::post('/update/{id}', [Admin\Mantenimiento\BufferController::class, 'update'])->name('mantenimiento.buffer.update');
            });

            Route::prefix('metodologia-ensayo')->group(function() {
                Route::get('/', [Admin\Mantenimiento\MetodologiaEnsayoController::class, 'index'])->name('mantenimiento.metodologia-ensayo.index');
                Route::get('/create', [Admin\Mantenimiento\MetodologiaEnsayoController::class, 'create'])->name('mantenimiento.metodologia-ensayo.create');

                Route::post('/store', [Admin\Mantenimiento\MetodologiaEnsayoController::class, 'store'])->name('mantenimiento.metodologia-ensayo.store');
                Route::get('/edit/{id}', [Admin\Mantenimiento\MetodologiaEnsayoController::class, 'edit'])->name('mantenimiento.metodologia-ensayo.edit');
                Route::post('/update/{id}', [Admin\Mantenimiento\MetodologiaEnsayoController::class, 'update'])->name('mantenimiento.metodologia-ensayo.update');
                Route::delete('/delete/{id}', [Admin\Mantenimiento\MetodologiaEnsayoController::class, 'delete'])->name('mantenimiento.metodologia-ensayo.delete');
            });

            Route::prefix('analista')->group(function() {
                Route::get('/', [Admin\Mantenimiento\AnalistaController::class, 'index'])->name('mantenimiento.analista.index');
                Route::get('/create', [Admin\Mantenimiento\AnalistaController::class, 'create'])->name('mantenimiento.analista.create');
                Route::post('/store', [Admin\Mantenimiento\AnalistaController::class, 'store'])->name('mantenimiento.analista.store');
                Route::get('/edit/{id}', [Admin\Mantenimiento\AnalistaController::class, 'edit'])->name('mantenimiento.analista.edit');
                Route::post('/update/{id}', [Admin\Mantenimiento\AnalistaController::class, 'update'])->name('mantenimiento.analista.update');
                Route::delete('/delete/{id}', [Admin\Mantenimiento\AnalistaController::class, 'delete'])->name('mantenimiento.analista.delete');
            });

        });

        Route::prefix('administracion')->group(function() {
            
            // Route::get('/', [Admin\ClienteController::class, 'index']);
            // Route::post('/', [Admin\ClienteController::class, 'index']);

            Route::prefix('usuario')->group(function() {
                Route::get('/', [Admin\Administracion\UsuarioController::class, 'index'])->name('administracion.usuario.index');
                Route::get('/create', [Admin\Administracion\UsuarioController::class, 'create'])->name('administracion.usuario.create');
                Route::post('/store', [Admin\Administracion\UsuarioController::class, 'store'])->name('administracion.usuario.store');

                Route::get('/edit/{id}', [Admin\Administracion\UsuarioController::class, 'edit'])->name('administracion.usuario.edit');
                Route::post('/update/{id}', [Admin\Administracion\UsuarioController::class, 'update'])->name('administracion.usuario.update');
                Route::get('/delete/{id}', [Admin\Administracion\UsuarioController::class, 'delete'])->name('administracion.usuario.delete');
            });

        });
        
    });

});



