@extends('layout')
@section('content')
    <div class="row p-4">
        <div class="col-md-9">
            <h4 class="text-uppercase">Editar Pago</h4>
        </div>
        <div class="col-md-3 text-end">
            <a href="{{ route('payments') }}" class="btn btn-secondary">Volver a Pagos</a>
        </div>
        <br>
        <br>
        <hr>
        
        <script>
            @if (session('alert-success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ session('alert-success') }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif

            @if (session('alert-error'))
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: '{!! session('alert-error') !!}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Se encontraron errores:',
                    html: '{!! implode('<br>', $errors->all()) !!}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true
                });

                document.addEventListener('DOMContentLoaded', () => {
                    const firstErrorField = '{{ $errors->keys()[0] }}';
                    const element = document.getElementsByName(firstErrorField)[0];
                    if (element) element.focus();
                });
            @endif
        </script>
        
        <div class="col-md-12">
            <form action="{{ route('payments-update', $payment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <input type="text" name="description" id="description" class="form-control"
                                value="{{ old('description', $payment->description) }}" placeholder="descripcion...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">Precio</label>
                            <input type="number" name="price" id="price" class="form-control"
                                value="{{ old('price', $payment->price) }}" placeholder="precio...">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12 p-2 text-center">
                        <button class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
