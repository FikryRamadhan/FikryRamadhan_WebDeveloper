<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\MyClass\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\MyClass\Validations;
use Exception;

class MenuController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            return Menu::dataTable();
        }
        return view('menu.index', [
            'title' => 'Menu Makanan',
            'breadcrumbs' => [
                [
                'title' => 'Menu Makanan',
                'link' => route('menu.index'),
                ]
            ]
        ]);
    }

    public function forCustomer(Request $request){
        if($request->ajax()){
            return Menu::dataTableForCustomer();
        }
        return view('menu.forcustomer', [
            'title' => 'Menu Makanan',
            'breadcrumbs' => [
                [
                'title' => 'Menu Makanan',
                'link' => route('food.index'),
                ]
            ]
        ]);
    }

    public function create(){
        return view('menu.create', [
            'title' => 'Menu Makanan',
            'breadcrumbs' => [
                [
                'title' => 'Tambah Menu Makanan',
                'link' => route('menu.create'),
                ]
            ]
        ]);
    }

    public function store(Request $request){
        Validations::validateMenu($request);
        DB::beginTransaction();

        try {
            $menu = Menu::createMenu($request->all());
            $menu->saveImage($request);
            DB::commit();

            return Response::success();
        } catch (Exception $e) {
            DB::rollback();

            return Response::error($e);
        }
    }

    public function edit(Menu $menu){
        return view('menu.edit', [
            'title' => 'Menu Makanan',
            'menu' => $menu,
            'breadcrumbs' => [
                [
                'title' => 'Tambah Menu Makanan',
                'link' => route('menu.create'),
                ]
            ]
        ]);
    }

    public function update(Request $request, Menu $menu){
        Validations::validateMenuUpdate($request);
        DB::beginTransaction();

        try{
            $menu->updateMenu($request->all());
            $menu->saveImage($request);

            DB::commit();

            return Response::success();
        } catch(Exception $e){
            DB::rollBack();

            return Response::error($e);
        }
    }

    public function destroy(Menu $menu){
        DB::beginTransaction();

        try {
            $menu->menuDestroy();
            DB::commit();

            return Response::success();
        } catch (Exception $e) {
            DB::rollBack();

            return Response::error($e);
        }
    }
}
