<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Personnel;
use Illuminate\Http\Request;
use App\Models\BorrowLog;
use App\Models\CondemnedEquipment;
class EquipmentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::where('is_archived', false)->get();
        return view('equipments.index', compact('equipments'));
    }

    public function create()
    {
        $personnels = Personnel::all();
        return view('equipments.create', compact('personnels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'accounting_officer' => 'required|string|max:255',
            'operating_unit_project' => 'required|string|max:255',
            'pn_code' => 'required|string|max:255',
            'responsible_person_id' => 'required|exists:personnels,id',
            'quantity' => 'required|integer',
            'unit' => 'required|in:pc,unit',
            'description' => 'required|string',
            'date_acquired' => 'required|date',
            'fund' => 'required|string|max:255',
            'ppe_class' => 'nullable|string|max:255',
            'est_useful_life' => 'nullable|integer',
            'unit_price' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'status' => 'required|in:usable,borrowed,repair,missing,destroyed',
        ]);

        Equipment::create($request->all());
        return redirect()->route('equipments.index')->with('success', 'Equipment added successfully.');
    }

    public function edit(Equipment $equipment)
    {
        $personnels = Personnel::all();
        return view('equipments.edit', compact('equipment', 'personnels'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        // Validate incoming request data
        $request->validate([
            'accounting_officer' => 'required|string|max:255',
            'operating_unit_project' => 'required|string|max:255',
            'pn_code' => 'required|string|max:255',
            'responsible_person_id' => 'required|exists:personnels,id',
            'quantity' => 'required|integer|min:1', // Adding min value for quantity
            'unit' => 'required|in:pc,unit',
            'description' => 'required|string',
            'date_acquired' => 'required|date',
            'fund' => 'required|string|max:255',
            'ppe_class' => 'nullable|string|max:255',
            'est_useful_life' => 'nullable|integer|min:0', // Adding min value for est_useful_life
            'unit_price' => 'required|numeric|min:0', // Adding min value for unit_price
            'total_amount' => 'required|numeric|min:0', // Adding min value for total_amount
            'status' => 'required|in:usable,borrowed,repair,missing_not_reported,missing_reported_spmo,destroyed',
        ]);
    
        // Update the equipment with validated data
        $equipment->update($request->only([
            'accounting_officer',
            'operating_unit_project',
            'pn_code',
            'responsible_person_id',
            'quantity',
            'unit',
            'description',
            'date_acquired',
            'fund',
            'ppe_class',
            'est_useful_life',
            'unit_price',
            'total_amount',
            'status',
        ]));
    
        // Redirect back with success message
        return redirect()->route('equipments.index')->with('success', 'Equipment updated successfully.');
    }
    

    public function destroy(Equipment $equipment)
    {
        $equipment->update(['is_archived' => true]);
        return redirect()->route('equipments.index')->with('success', 'Equipment archived successfully.');
    }

    public function restore($id)
    {
        $equipment = Equipment::findOrFail($id);
        $equipment->update(['is_archived' => false]);

        return redirect()->route('equipments.index')->with('success', 'Equipment restored successfully.');
    }

    public function archived()
    {
        $archivedEquipments = Equipment::where('is_archived', true)->get();
        return view('equipments.archived', compact('archivedEquipments'));
    }
    public function changePersonnel(Equipment $equipment)
    {
        $personnels = Personnel::all();
        return view('equipments.change_personnel', compact('equipment', 'personnels'));
    }
    
    public function confirmChangePersonnel(Request $request, Equipment $equipment)
    {
        $oldPersonnel = $equipment->responsiblePerson; // Make sure this relationship exists
        $newPersonnel = Personnel::findOrFail($request->responsible_person_id);
        
        return view('equipments.confirm_change_personnel', compact('equipment', 'oldPersonnel', 'newPersonnel'));
    }
    
    public function updatePersonnel(Request $request, Equipment $equipment)
    {
        $request->validate([
            'responsible_person_id' => 'required|exists:personnels,id',
        ]);
    
        // Update the equipment's responsible person
        $equipment->responsible_person_id = $request->responsible_person_id;
        $equipment->save();
    
        return redirect()->route('equipments.index')->with('success', 'Responsible personnel updated successfully.');
    }
    
// Show the borrow form
public function showBorrowForm(Equipment $equipment)
{
    return view('equipments.borrow_equipment', compact('equipment'));
}

// Store borrow information and update equipment status
public function storeBorrow(Request $request)
{
    $request->validate([
        'equipment_id' => 'required|exists:equipments,id',
        'name' => 'required|string|max:255',
        'office' => 'required|string|max:255',
        'no' => 'required|string|max:255',
        'date_borrowed' => 'required|date',
        'date_returned' => 'required|date',
    ]);

    // Create a new Borrower's Log entry
    BorrowLog::create([
        'equipment_id' => $request->equipment_id,
        'name' => $request->name,
        'office' => $request->office,
        'no' => $request->no,
        'date_borrowed' => $request->date_borrowed,
        'date_returned' => $request->date_returned,
    ]);

    // Update equipment status to 'borrowed'
    $equipment = Equipment::findOrFail($request->equipment_id);
    $equipment->status = 'borrowed';
    $equipment->save();

    return redirect()->route('equipments.index')->with('success', 'Equipment borrowed successfully.');
}
public function condemn($id)
{
    // Find the equipment in the original table
    $equipment = Equipment::findOrFail($id);

    // Create a new instance of CondemnedEquipment with the existing equipment's attributes
    $condemnedEquipment = new CondemnedEquipment();
    $condemnedEquipment->fill([
        'accounting_officer' => $equipment->accounting_officer,
        'operating_unit_project' => $equipment->operating_unit_project,
        'pn_code' => $equipment->pn_code,
        'responsible_person_id' => $equipment->responsible_person_id,
        'quantity' => $equipment->quantity,
        'unit' => $equipment->unit,
        'description' => $equipment->description,
        'date_acquired' => $equipment->date_acquired,
        'fund' => $equipment->fund,
        'ppe_class' => $equipment->ppe_class,
        'est_useful_life' => $equipment->est_useful_life,
        'unit_price' => $equipment->unit_price,
        'total_amount' => $equipment->total_amount,
        'status' => 'condemned',
    ]);

    

    // Save the condemned equipment to the database
    $condemnedEquipment->save();

    // Remove the equipment from the original table
    $equipment->delete();

    // Redirect back with a success message
    return redirect()->route('equipments.index')->with('success', 'Equipment has been condemned successfully.');
}
public function viewCondemned()
{
    // Retrieve all condemned equipment from the condemned_equipments table
    $condemnedEquipments = CondemnedEquipment::all();

    // Return the view to display them
    return view('equipments.condemned', compact('condemnedEquipments'));
}



}
