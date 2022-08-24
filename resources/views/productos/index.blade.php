<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <a type="button"  href="{{route('productos.create')}}" class="bg-indigo-500 px-12 py-2 rounded text-gray-200 font-semibold hover:bg-indigo-800 transition duration-200 each-in-out">Crear</a> <!--A este boton en el hrref lo que hago es pasarle la ruta de del ProductoController especificamente a la funcion que dice create() la cual se encarga de ejecutar una accion -->
                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="border px-4 py-2">ID</th>
                            <th class="border px-4 py-2">NOMBRE</th>
                            <th class="border px-4 py-2">DESCRIPCION</th>
                            <th class="border px-4 py-2">IMAGEN</th>
                            <th class="border px-4 py-2">ACCIONES</th>
                        </tr> 
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                            <tr>
                                <td>{{$producto->id}}</td>
                                <td>{{$producto->nombre}}</td>
                                <td>{{$producto->descripcion}}</td>
                                <td  class="border px-14 py-1">
                                    <img src="/imagen/{{$producto->imagen}}" width="60%">
                                </td>
                                <td class="border px-4 py-2">
                                    <div class="flex justify-center rounded-lg text-lg" role="group">
                                       <!-- botón editar -->
                                        <a href="{{ route('productos.edit', $producto->id) }}" class="rounded bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4">Editar</a>  <!--A este boton en el hrref lo que hago es pasarle la ruta de del ProductoController especificamente a la funcion que dice edit() la cual se encarga de ejecutar una accion -->
                                    
                                        <!-- botón borrar -->
                                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="formEliminar"> <!--A este boton en el href lo que hago es pasarle la ruta de del ProductoController especificamente a la funcion que dice destroy() la cual se encarga de ejecutar una accion -->
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded bg-pink-400 hover:bg-pink-500 text-white font-bold py-2 px-4">Borrar</button>
                                            </form>
                                    </div>
                                </td>                         
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                    <div>
                        {!! $productos->links() !!}
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    (function () {
  'use strict'
  //debemos crear la clase formEliminar dentro del form del boton borrar
  //recordar que cada registro a eliminar esta contenido en un form  
  var forms = document.querySelectorAll('.formEliminar')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {        
          event.preventDefault()
          event.stopPropagation()        
          Swal.fire({ // este es codido de switAlert de una modal tipo alerta como una venta que se activa cunado presionamos el boton eliminar que esta mas arriba de este codigo
                title: '¿Confirma la eliminación del registro?',        
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#20c997',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Confirmar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                    Swal.fire('¡Eliminado!', 'El registro ha sido eliminado exitosamente.','success');
                }
            })                      
      }, false)
    })
})()
</script>
