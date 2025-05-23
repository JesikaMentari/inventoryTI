<?php

use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\BarangkeluarController;
use App\Http\Controllers\Admin\BarangmasukController;
use App\Http\Controllers\Admin\TransaksiBarangController;
// use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JenisBarangController;
use App\Http\Controllers\Admin\LapBarangMasukController;
use App\Http\Controllers\Admin\LapStokBarangController;
use App\Http\Controllers\Admin\RequestBeritaAcaraController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\LokasiController;
use App\Http\Controllers\Admin\SatuanController;
use App\Http\Controllers\Admin\VendorController;
// use App\Http\Controllers\Admin\BagianController;
use App\Http\Controllers\Master\AksesController;
use App\Http\Controllers\Master\AppreanceController;
use App\Http\Controllers\Master\MenuController;
use App\Http\Controllers\Master\RoleController;
use App\Http\Controllers\Master\UserController;
use Illuminate\Support\Facades\Route;

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

// login admin
Route::middleware(['preventBackHistory'])->group(function () {
    Route::get('/admin/login', [LoginController::class, 'index'])->middleware('useractive');
    Route::post('/admin/proseslogin', [LoginController::class, 'proseslogin'])->middleware('useractive');
    Route::get('/admin/logout', [LoginController::class, 'logout']);
});

// admin
Route::group(['middleware' => 'userlogin'], function () {

    // Profile
    Route::get('/admin/profile/{user}', [UserController::class, 'profile']);
    Route::post('/admin/updatePassword/{user}', [UserController::class, 'updatePassword']);
    Route::post('/admin/updateProfile/{user}', [UserController::class, 'updateProfile']);
    Route::get('/admin/appreance/', [AppreanceController::class, 'index']);
    Route::post('/admin/appreance/{setting}', [AppreanceController::class, 'update']);

    Route::middleware(['checkRoleUser:/dashboard,menu'])->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('/admin', [DashboardController::class, 'index']);
        Route::get('/admin/dashboard', [DashboardController::class, 'index']);
    });

    Route::middleware(['checkRoleUser:/jenisbarang,submenu'])->group(function () {
        // Jenis Barang
        Route::get('/admin/jenisbarang', [JenisBarangController::class, 'index']);
        Route::get('/admin/jenisbarang/show/', [JenisBarangController::class, 'show'])->name('jenisbarang.getjenisbarang');
        Route::post('/admin/jenisbarang/proses_tambah/', [JenisBarangController::class, 'proses_tambah'])->name('jenisbarang.store');
        Route::post('/admin/jenisbarang/proses_ubah/{jenisbarang}', [JenisBarangController::class, 'proses_ubah']);
        Route::post('/admin/jenisbarang/proses_hapus/{jenisbarang}', [JenisBarangController::class, 'proses_hapus']);
    });

    Route::middleware(['checkRoleUser:/satuan,submenu'])->group(function () {
        // Satuan
        Route::resource('/admin/satuan', \App\Http\Controllers\Admin\SatuanController::class);
        Route::get('/admin/satuan/show/', [SatuanController::class, 'show'])->name('satuan.getsatuan');
        Route::post('/admin/satuan/proses_tambah/', [SatuanController::class, 'proses_tambah'])->name('satuan.store');
        Route::post('/admin/satuan/proses_ubah/{satuan}', [SatuanController::class, 'proses_ubah']);
        Route::post('/admin/satuan/proses_hapus/{satuan}', [SatuanController::class, 'proses_hapus']);
    });

    Route::middleware(['checkRoleUser:/lokasi,submenu'])->group(function () {
        // Lokasi
        Route::resource('/admin/lokasi', \App\Http\Controllers\Admin\LokasiController::class);
        Route::get('/admin/lokasi/show/', [LokasiController::class, 'show'])->name('lokasi.getlokasi');
        Route::post('/admin/lokasi/proses_tambah/', [LokasiController::class, 'proses_tambah'])->name('lokasi.store');
        Route::post('/admin/lokasi/proses_ubah/{lokasi}', [LokasiController::class, 'proses_ubah']);
        Route::post('/admin/lokasi/proses_hapus/{lokasi}', [LokasiController::class, 'proses_hapus']);
    });

    Route::middleware(['checkRoleUser:/barang,submenu'])->group(function () {
        // Barang
        Route::resource('/admin/barang', \App\Http\Controllers\Admin\BarangController::class);
        Route::get('/admin/barang/show/', [BarangController::class, 'show'])->name('barang.getbarang');
        Route::post('/admin/barang/proses_tambah/', [BarangController::class, 'proses_tambah'])->name('barang.store');
        Route::post('/admin/barang/proses_ubah/{barang}', [BarangController::class, 'proses_ubah']);
        Route::post('/admin/barang/proses_hapus/{barang}', [BarangController::class, 'proses_hapus']);
    });

    // Route::middleware(['checkRoleUser:/bagian,submenu'])->group(function () {
    //     // Bagian
    //     Route::resource('/admin/bagian', \App\Http\Controllers\Admin\BagianController::class);
    //     Route::get('/admin/bagian/show/', [BagianController::class, 'show'])->name('bagian.getbagian');
    //     Route::post('/admin/bagian/proses_tambah/', [BagianController::class, 'proses_tambah'])->name('bagian.store');
    //     Route::post('/admin/bagian/proses_ubah/{bagian}', [BagianController::class, 'proses_ubah']);
    //     Route::post('/admin/bagian/proses_hapus/{bagian}', [BagianController::class, 'proses_hapus']);
    // });

    Route::middleware(['checkRoleUser:/vendor,submenu'])->group(function () {
        // Vendor
        Route::resource('/admin/vendor', \App\Http\Controllers\Admin\VendorController::class);
        Route::get('/admin/vendor/show/', [VendorController::class, 'show'])->name('vendor.getvendor');
        Route::post('/admin/vendor/proses_tambah/', [VendorController::class, 'proses_tambah'])->name('vendor.store');
        Route::post('/admin/vendor/proses_ubah/{vendor}', [VendorController::class, 'proses_ubah']);
        Route::post('/admin/vendor/proses_hapus/{vendor}', [VendorController::class, 'proses_hapus']);
    });

    // Route::middleware(['checkRoleUser:/unit,menu'])->group(function () {
    //     // Unit TI
    //     Route::resource('/admin/unit', \App\Http\Controllers\Admin\UnitController::class);
    //     Route::get('/admin/unit/show/', [UnitController::class, 'show'])->name('unit.getunit');
    //     Route::post('/admin/unit/proses_tambah/', [UnitController::class, 'proses_tambah'])->name('unit.store');
    //     Route::post('/admin/unit/proses_ubah/{unit}', [UnitController::class, 'proses_ubah']);
    //     Route::post('/admin/unit/proses_hapus/{unit}', [UnitController::class, 'proses_hapus']);
    // });

    Route::middleware(['checkRoleUser:/barang-masuk,submenu'])->group(function () {
        // Barang Masuk
        Route::resource('/admin/barang-masuk', \App\Http\Controllers\Admin\BarangmasukController::class);
        Route::get('/admin/barang-masuk/show/', [BarangmasukController::class, 'show'])->name('barang-masuk.getbarang-masuk');
        Route::post('/admin/barang-masuk/proses_tambah/', [BarangmasukController::class, 'proses_tambah'])->name('barang-masuk.store');
        Route::post('/admin/barang-masuk/proses_ubah/{barangmasuk}', [BarangmasukController::class, 'proses_ubah']);
        Route::post('/admin/barang-masuk/proses_hapus/{barangmasuk}', [BarangmasukController::class, 'proses_hapus']);
        Route::get('/admin/barang/getbarang/{id}', [BarangController::class, 'getbarang']);
        Route::get('/admin/barang/listbarang/{param}', [BarangController::class, 'listbarang']);
    });

    Route::middleware(['checkRoleUser:/barang-keluar,submenu'])->group(function () {
        // Barang Keluar
        Route::resource('/admin/barang-keluar', \App\Http\Controllers\Admin\BarangkeluarController::class);
        Route::get('/admin/barang-keluar/show/', [BarangkeluarController::class, 'show'])->name('barang-keluar.getbarang-keluar');
        Route::post('/admin/barang-keluar/proses_tambah/', [BarangkeluarController::class, 'proses_tambah'])->name('barang-keluar.store');
        Route::post('/admin/barang-keluar/proses_ubah/{barangkeluar}', [BarangkeluarController::class, 'proses_ubah']);
        Route::post('/admin/barang-keluar/proses_hapus/{barangkeluar}', [BarangkeluarController::class, 'proses_hapus']);
    });

    Route::middleware(['checkRoleUser:/transaksi-barang,menu'])->group(function () {
        Route::get('/transaksi-barang', [TransaksiBarangController::class, 'index']);
        Route::get('/transaksi-barang/data', [TransaksiBarangController::class, 'show'])->name('transaksi-barang.data');
        Route::post('/transaksi-barang/tambah', [TransaksiBarangController::class, 'proses_tambah'])->name('transaksi-barang.tambah');
        Route::post('/transaksi-barang/ubah/{transaksi}', [TransaksiBarangController::class, 'proses_ubah'])->name('transaksi-barang.ubah');
        Route::post('/transaksi-barang/hapus/{transaksi}', [TransaksiBarangController::class, 'proses_hapus'])->name('transaksi-barang.hapus');
    });
    

    Route::middleware(['checkRoleUser:/lap-barang-masuk,submenu'])->group(function () {
        // Laporan Barang Masuk
        Route::resource('/admin/lap-barang-masuk', \App\Http\Controllers\Admin\LapBarangMasukController::class);
        Route::get('/admin/lapbarangmasuk/print/', [LapBarangMasukController::class, 'print'])->name('lap-bm.print');
        Route::get('/admin/lapbarangmasuk/pdf/', [LapBarangMasukController::class, 'pdf'])->name('lap-bm.pdf');
        Route::get('/admin/lap-barang-masuk/show/', [LapBarangMasukController::class, 'show'])->name('lap-bm.getlap-bm');
    });

    Route::middleware(['checkRoleUser:/request-berita-acara,submenu'])->group(function () {
        // Request Berita Acara
        Route::resource('/admin/request-berita-acara', \App\Http\Controllers\Admin\RequestBeritaAcaraController::class)
            ->names([
                'index' => 'request.beritaacara.index',
                'create' => 'request.beritaacara.create',
                'store' => 'request.beritaacara.store',
                'show' => 'request.beritaacara.show',
                'edit' => 'request.beritaacara.edit',
                'update' => 'request.beritaacara.update',
                'destroy' => 'request.beritaacara.destroy',
            ]);

        // Tambahan Route Manual
        Route::post('/admin/request-berita-acara/print', [RequestBeritaAcaraController::class, 'print'])->name('req-ba.print');
        Route::post('/admin/request-berita-acara/pdf', [RequestBeritaAcaraController::class, 'pdf'])->name('req-ba.pdf');
        Route::post('/request-beritaacara/store-masuk', [RequestBeritaAcaraController::class, 'storeMasuk'])->name('request.beritaacara.storeMasuk');
        Route::post('/request-beritaacara/store-keluar', [RequestBeritaAcaraController::class, 'storeKeluar'])->name('request.beritaacara.storeKeluar');
    });
    

    Route::middleware(['checkRoleUser:/lap-stok-barang,submenu'])->group(function () {
        // Laporan Stok Barang
        Route::resource('/admin/lap-stok-barang', \App\Http\Controllers\Admin\LapStokBarangController::class);
        Route::get('/admin/lapstokbarang/print/', [LapStokBarangController::class, 'print'])->name('lap-sb.print');
        Route::get('/admin/lapstokbarang/pdf/', [LapStokBarangController::class, 'pdf'])->name('lap-sb.pdf');
        Route::get('/admin/lap-stok-barang/show/', [LapStokBarangController::class, 'show'])->name('lap-sb.getlap-sb');
    });

    Route::middleware(['checkRoleUser:1,othermenu'])->group(function () {

        Route::middleware(['checkRoleUser:2,othermenu'])->group(function () {
            // Menu
            Route::resource('/admin/menu', \App\Http\Controllers\Master\MenuController::class);
            Route::post('/admin/menu/hapus', [MenuController::class, 'hapus']);
            Route::get('/admin/menu/sortup/{sort}', [MenuController::class, 'sortup']);
            Route::get('/admin/menu/sortdown/{sort}', [MenuController::class, 'sortdown']);
        });

        Route::middleware(['checkRoleUser:3,othermenu'])->group(function () {
            // Role
            Route::resource('/admin/role', \App\Http\Controllers\Master\RoleController::class);
            Route::get('/admin/role/show/', [RoleController::class, 'show'])->name('role.getrole');
            Route::post('/admin/role/hapus', [RoleController::class, 'hapus']);
        });

        Route::middleware(['checkRoleUser:4,othermenu'])->group(function () {
            // List User
            Route::resource('/admin/user', \App\Http\Controllers\Master\UserController::class);
            Route::get('/admin/user/show/', [UserController::class, 'show'])->name('user.getuser');
            Route::post('/admin/user/hapus', [UserController::class, 'hapus']);
        });

        Route::middleware(['checkRoleUser:5,othermenu'])->group(function () {
            // Akses
            Route::get('/admin/akses/{role}', [AksesController::class, 'index']);
            Route::get('/admin/akses/addAkses/{idmenu}/{idrole}/{type}/{akses}', [AksesController::class, 'addAkses']);
            Route::get('/admin/akses/removeAkses/{idmenu}/{idrole}/{type}/{akses}', [AksesController::class, 'removeAkses']);
            Route::get('/admin/akses/setAll/{role}', [AksesController::class, 'setAllAkses']);
            Route::get('/admin/akses/unsetAll/{role}', [AksesController::class, 'unsetAllAkses']);
        });

        Route::middleware(['checkRoleUser:6,othermenu'])->group(function () {
            // Web
            Route::resource('/admin/web', \App\Http\Controllers\Master\WebController::class);
        });
    });
});
