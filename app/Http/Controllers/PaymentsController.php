<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/pagos",
     *     summary="Listado de pagos",
     *     @OA\Response(response="200", description="Muestra el listado de todos los pagos"),
     * )
     */
    public function index()
    {
        $payments = Payment::all();
        return view('payments.list', compact('payments'));
    }

    public function create()
    {
        return view('payments.create');
    }

    /**
     * @OA\Post(
     *     path="/pagos/guardar",
     *     summary="Almacenar un nuevo pago",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="price", type="number")
     *         )
     *     ),
     *     @OA\Response(response="302", description="Redirección al listado con éxito o error"),
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
        ]);

        try {
            Payment::create($request->all());
            return redirect()->route('payments')->with('alert-success', 'Pago creado con éxito');
        } catch (\Exception $e) {
            return back()->with('alert-error', 'Error al crear el pago: ' . $e->getMessage());
        }
    }

    /**
     * @OA\Get(
     *     path="/pagos/editar/{id}",
     *     summary="Mostrar formulario de edición",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response="200", description="Muestra la vista de edición"),
     * )
     */
    public function edit($id)
    {
        try {
            $payment = Payment::find($id);
            if (!$payment) {
                return redirect()->route('payments')->with('alert-error', 'Error al acceder al pago: el registro no fue encontrado.');
            }
            return view('payments.edit', compact('payment'));
        } catch (\Exception $e) {
            return redirect()->route('payments')->with('alert-error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * @OA\Put(
     *     path="/pagos/actualizar/{id}",
     *     summary="Actualizar un pago existente",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="price", type="number")
     *         )
     *     ),
     *     @OA\Response(response="302", description="Redirección tras actualizar"),
     * )
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
        ]);

        try {
            $payment = Payment::find($id);
            if (!$payment) {
                return redirect()->route('payments')->with('alert-error', 'Error al actualizar el pago: el registro no fue encontrado.');
            }
            $payment->update($request->all());
            return redirect()->route('payments')->with('alert-success', 'Pago actualizado con éxito');
        } catch (\Exception $e) {
            return back()->with('alert-error', 'Error al actualizar el pago: ' . $e->getMessage());
        }
    }

    /**
     * @OA\Delete(
     *     path="/pagos/eliminar/{id}",
     *     summary="Eliminar un pago",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response="302", description="Redirección tras eliminar"),
     * )
     */
    public function destroy($id)
    {
        try {
            $payment = Payment::find($id);
            
            if (!$payment) {
                return redirect()->route('payments')->with('alert-error', 'Error al eliminar el pago: el registro no fue encontrado.');
            }

            $payment->delete();
            return redirect()->route('payments')->with('alert-success', 'Pago eliminado con éxito');
        } catch (\Exception $e) {
            return back()->with('alert-error', 'Error al eliminar el pago: ' . $e->getMessage());
        }
    }
}
