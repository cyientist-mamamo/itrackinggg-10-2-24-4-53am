<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::where('archived', false)->get();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'category' => 'required',
            'unit' => 'required',
            'quantity' => 'required|integer',
            'added' => 'required|date',
            'expiry_date' => 'required|date',
            'consume_type' => 'required|in:Consumable,Non-Consumable',
        ]);
        
        Item::create($request->all());
        return redirect()->route('items.index')->with('success', 'Item added successfully.');
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'description' => 'required',
            'category' => 'required',
            'unit' => 'required',
            'quantity' => 'required|integer',
            'added' => 'required|date',
            'expiry_date' => 'required|date',
            'consume_type' => 'required|in:Consumable,Non-Consumable',
        ]);

        $item->update($request->all());
        
        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function archive(Item $item)
    {
        $item->archived = true;
        $item->save();
        
        return redirect()->route('items.index')->with('success', 'Item archived successfully.');
    }

    public function archivedItems()
    {
        $archivedItems = Item::where('archived', true)->get();
        return view('items.archived', compact('archivedItems'));
    }

    public function restore(Item $item)
    {
        $item->archived = false;
        $item->save();
        
        return redirect()->route('items.archived')->with('success', 'Item restored successfully.');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        
        return redirect()->route('items.archived')->with('success', 'Item deleted successfully.');
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }
}
