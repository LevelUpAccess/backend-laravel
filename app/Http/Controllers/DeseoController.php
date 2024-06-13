<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Deseo;
use Illuminate\Http\Request;
use App\Models\DeseoProducto;
use App\Http\Resources\DeseoCollection;
use Illuminate\Support\Facades\Auth;

class DeseoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Almacenar un pedido
        $deseo = new Deseo;
        $deseo->user_id = Auth::user()->id;
        $deseo->total = $request->total;
        $deseo->save();

        //Obtener el ID del pedido
        $id = $deseo->id;

        //Obtener los productos
        $productos = $request->productos;

        //Formatear un arreglo
        $deseo_producto = [];

        foreach($productos as $producto) {
            $deseo_producto[] = [
                'pedido_id' => $id,
                'producto_id' => $producto['id'],
                'cantidad' => $producto['cantidad'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        //Almacenar en la BD
        DeseoProducto::insert($deseo_producto);

        return [
            'message' => 'Agregado a favoritos correctamente'
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deseo  $deseo
     * @return \Illuminate\Http\Response
     */
    public function show(Deseo $deseo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deseo  $deseo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deseo $deseo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deseo  $deseo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deseo $deseo)
    {
        //
    }
}
