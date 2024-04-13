@php
    $links = [
        [
            'icon' => 'fa-solid fa-gauge',
            'name' => 'Dashboard',
            'route' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
        ],[
           'name' => 'Opciones',
           'icon' => 'fa-solid fa-cog',
           'route' => route('admin.option.index'),
           'active' => request()->routeIs('admin.option.*'),
        ],[
            //Familia de Productos
            'name' => 'Familias',
            'icon' => 'fa-solid fa-box-open',
            'route' => route('admin.families.index'),
            'active' => request()->routeIs('admin.families.*') ,
        ],[
           'name' => 'Categorias',
           'icon' => 'fa-solid fa-tags',
           'route' => route('admin.categories.index'),
           'active' => request()->routeIs('admin.categories.*'),
        ],[
           'name' => 'Subcategorias',
           'icon' => 'fa-solid fa-tag',
           'route' => route('admin.subcategories.index'),
           'active' => request()->routeIs('admin.subcategories.*'),
        ],[
           'name' => 'Productos',
           'icon' => 'fa-solid fa-box',
           'route' => route('admin.products.index'),
           'active' => request()->routeIs('admin.products.*'),
        ],[
           'name' => 'Portadas',
           'icon' => 'fa-solid fa-images',
           'route' => route('admin.covers.index'),
           'active' => request()->routeIs('admin.covers.*'),
        ]
    ];
@endphp

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-[100dvh] pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    :class="{
        'translate-x-0 ease-put': sidebarOpen,
        '-translate-x-full ease-in': !sidebarOpen
    }"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                <li>
                    <a href="{{$link['route']}}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <span class="inline-flex w-6 h-6 justify-center items-center">
                            <i class="{{$link['icon']}}"></i>
                        </span>
                        <span class="ml-2">{{$link['name']}}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>
