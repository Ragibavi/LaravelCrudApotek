<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medicine.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        Medicine::create([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('medicine.table')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $medicines = Medicine::find($id);
        return view('medicine.edit', compact('medicines'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $medicines = Medicine::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        Medicine::where('id', $id)->update([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('medicine.table')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $medicines = Medicine::findOrFail($id);
        $medicines->Delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }

    public function home()
    {
        return view('medicine.home');
    }

    public function table()
    {
        $medicines = Medicine::all();

        return view('medicine.table', compact('medicines'));
    }

    public function adminStock()
    {
        $medicines = Medicine::orderBy('stock', 'ASC')->get();
        
        return view('medicine.adminStock')->with('medicines', $medicines);
    }

    public function editStock($id)
    {
        $medicines = Medicine::findOrFail($id);

        return view('medicine.editStock')->with('medicines', $medicines);
    }
}
