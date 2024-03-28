<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Family;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id','desc')
                    ->with('family')
                    ->paginate(10);
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $families = Family::all();
        return view('admin.categories.create',compact('families'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'family_id' => 'required|exists:families,id',
            'name' => 'required'
        ]);

        Category::create($request->all());
        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Ejecución exitosa',
            'text' => 'Categoría creada correctamente'
        ]);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $families = Family::all();
        return view('admin.categories.edit',compact('category', 'families'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'family_id' => 'required|exists:families,id',
            'name' => 'required'
        ]);
        $category->update($request->all());

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Ejecución exitosa',
            'text' => 'Categoría actualizada correctamente'
        ]);
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category->subcategories->count()>0){
            session()->flash('swal',[
                'icon' => 'error',
                'title' => 'Ups!',
                'text' => 'No se puede eliminar porque tiene subcategorias asociadas'
            ]);
            return redirect()->route('admin.categories.edit',$category);
        }
        $category->delete();

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'Categoria eliminada correctamente'
        ]);
        return redirect()->route('admin.categories.index');
    }
}
