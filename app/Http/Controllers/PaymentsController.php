<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return view('payments.list', compact('payments'));
    }

    public function create()
    {
        return view('payments.create');
    }

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
