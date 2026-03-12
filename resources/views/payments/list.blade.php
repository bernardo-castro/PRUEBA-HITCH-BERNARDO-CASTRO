@extends('layout')
@section('content')
    <div class="row p-4">
        <div class="col-md-9">
            <h4 class="text-uppercase">Listado de Pagos</h4>
        </div>
        <div class="col-md-3 text-end">
            <a href="{{ route('payments-create') }}" class="btn btn-primary">Crear Pago</a>
        </div>
        <br>
        <br>
        <hr>
        @if (session()->has('alert-success'))
            <div class="alert alert-success" role="alert">
                {!! session()->get('alert-success') !!}
            </div>
        @endif
        @if (session('alert-error'))
            <div class="alert alert-danger" role="alert">
                {!! session('alert-error') !!}
            </div>
        @endif
        <div class="col-md-12">
            <table class="table table-bordered" id="table">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">DESCRIPCION</th>
                        <th class="text-center">PRECIO</th>
                        <th class="text-center">ACCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td class="text-center">{{ $payment->id }}</td>
                            <td class="text-center">{{ $payment->description }}</td>
                            <td class="text-center">{{ number_format($payment->price, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('payments-edit', $payment->id) }}"
                                        class="btn btn-sm btn-warning">Editar</a>
                                    <button type="button" class="btn btn-sm btn-danger" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal" 
                                        data-id="{{ $payment->id }}"
                                        data-url="{{ route('payments-destroy', $payment->id) }}">
                                        Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal de Confirmación de Eliminación -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este pago? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar Definitivamente</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#table').DataTable();

        // Manejo dinámico del modal de eliminación
        const deleteModal = document.getElementById('deleteModal');
        if (deleteModal) {
            deleteModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const url = button.getAttribute('data-url');
                const form = deleteModal.querySelector('#deleteForm');
                form.setAttribute('action', url);
            });
        }
    </script>
@endsection
