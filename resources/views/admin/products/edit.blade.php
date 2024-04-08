<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Productos',
        'route' => route('admin.products.index'),
    ],
    [
        'name' => $product->name,
    ],
]">
<div class="mb-12">
    @livewire('admin.products.product-edit',compact('product'), key('product-edit-'.$product->id))
</div>


@livewire('admin.products.product-variants', compact('product'), key('variants-'.$product->id))

</x-admin-layout>