<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public function index()
    {
        $personnels = Personnel::where('is_archived', false)->get();
        $archivedPersonnels = Personnel::where('is_archived', true)->get();

        return view('personnels.index', compact('personnels', 'archivedPersonnels'));
    }

    public function create()
    {
        return view('personnels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'working_period' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
        ]);

        Personnel::create($request->all());
        return redirect()->route('personnels.index')->with('success', 'Personnel added successfully.');
    }

    public function edit($id)
    {
        // Fetch the personnel record by ID
        $personnel = Personnel::findOrFail($id);
    
        // Define the designations (you can replace this with your actual data source)
        $designations = ['Manager', 'Staff', 'Intern']; // Sample designations
    
        // Return the edit view with the personnel and designations data
        return view('personnels.edit', compact('personnel', 'designations'));
    }
    
    public function update(Request $request, Personnel $personnel)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'working_period' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
        ]);

        $personnel->update($request->all());
        return redirect()->route('personnels.index')->with('success', 'Personnel updated successfully.');
    }

    public function destroy(Personnel $personnel)
    {
        $personnel->update(['is_archived' => true]);
        return redirect()->route('personnels.index')->with('success', 'Personnel archived successfully.');
    }

    public function restore($id)
    {
        $personnel = Personnel::findOrFail($id);
        $personnel->update(['is_archived' => false]);

        return redirect()->route('personnels.index')->with('success', 'Personnel restored successfully.');
    }

    public function archived()
{
    $archivedPersonnels = Personnel::where('is_archived', true)->get();
    return view('personnels.archived', compact('archivedPersonnels'));
}

}
