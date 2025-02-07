<?php

use App\Livewire\Ajustes\AjustesPagina;
use App\Livewire\Ajustes\AjustesPersonal;
use App\Livewire\Auditoria\Auditoria;
use App\Livewire\Dashboard;
use App\Livewire\Facturacion\ComprasDonaciones;
use App\Livewire\Facturacion\PreciosPorTemporada;
use App\Livewire\Facturacion\Ventas;
use App\Livewire\Inventario\Productos;
use App\Livewire\Inventario\StockGeneral;
use App\Livewire\Metricas\ProductosMasVendidos;
use App\Livewire\Metricas\StockMinimo;
use App\Livewire\Metricas\VentasMensuales;
use App\Livewire\Reportes\HistorialPerdidas;
use App\Livewire\Reportes\RegistroPerdidas;
use App\Livewire\Usuarios\AsignarPermisos;
use App\Livewire\Usuarios\Bajas;
use App\Livewire\Usuarios\HistorialLaboral;
use App\Livewire\Usuarios\Trabajadores;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return redirect()->route('login');
});

Route::view('/history', 'history')
    ->name('history');

Route::view('/about', 'about')
    ->name('about');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Dashboard
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // Auditoria
    Route::get('/auditoria', Auditoria::class)->name('auditoria')->middleware('can:Administrador');

    // Usuarios
    Route::get('/users/asignar-permisos', AsignarPermisos::class)->name('asignarPermisos');
    Route::get('/users/bajas', Bajas::class)->name('bajas');
    Route::get('/users/historial-laboral', HistorialLaboral::class)->name('historialLaboral');
    Route::get('/users/trabajadores', Trabajadores::class)->name('trabajadores');

    // Productos
    Route::get('/inventario/productos', Productos::class)->name('productos');
    Route::get('/inventario/stock-general', StockGeneral::class)->name('stockGeneral');

    // Facturacion
    Route::get('/facturacion/compras-donaciones', ComprasDonaciones::class)->name('comprasDonaciones');
    Route::get('/facturacion/precio-por-temporada', PreciosPorTemporada::class)->name('precioPorTemporada');
    Route::get('/facturacion/ventas', Ventas::class)->name('ventas');

    // Reportes
    Route::get('/reportes/historial-perdidas', HistorialPerdidas::class)->name('historialPerdidas');
    Route::get('/reportes/registro-perdidas', RegistroPerdidas::class)->name('registroPerdidas');

    // Metricas
    Route::get('/metricas/productos-mas-vendidos', ProductosMasVendidos::class)->name('productosMasVendidos');
    Route::get('/metricas/sotck-minimo', StockMinimo::class)->name('stockMinimo');
    Route::get('/metricas/ventas-mensuales', VentasMensuales::class)->name('ventasMensuales');

    // Ajustes
    Route::get('/ajustes/ajustes-pagina', AjustesPagina::class)->name('ajustesPagina');
    Route::get('/ajustes/ajustes-personal', AjustesPersonal::class)->name('ajustesPersonal');
});
