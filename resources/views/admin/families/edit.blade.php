<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Familias',
        'route' => route('admin.families.index'),
    ],
    [
        'name' => $family->name
    ]
]">

<div class="card">
    <form action="{{route('admin.families.update',$family)}}" method="POST">
        @method('PUT')
        @csrf
        <div class="mb-4">
            <x-label class="mb-2">Nombre</x-label>
            <x-input name="name" class="w-full" value="{{old('name',$family->name)}}" placeholder="Ingresar nombre de Familia"/>
        </div>

        <div class="flex justify-end space-x-2">
            <x-danger-button onclick="confirmDelete()">
                Eliminar
            </x-danger-button>
            <x-button>Actualizar</x-button>
        </div>
    </form>
    </div>

    <form action="{{route('admin.families.destroy',$family)}}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
    </form>

    @push('js')
        <script>
            function confirmDelete(){
                document.getElementById('delete-form').submit();
            }
        </script>
    @endpush
</x-admin-layout>