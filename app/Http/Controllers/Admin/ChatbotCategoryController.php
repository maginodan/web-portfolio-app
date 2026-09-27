<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotCategory;
use Illuminate\Http\Request;

class ChatbotCategoryController extends Controller
{
    // INDEX
    public function index()
    {
        $categories = ChatbotCategory::latest()->paginate(10);

        return view('admin.chatbot.categories.index', compact('categories'));
    }

    // CREATE
    public function create()
    {
        return view('admin.chatbot.categories.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:chatbot_categories,name',
        ]);

        ChatbotCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.chatbot.categories.index')->with('flash_message', 'Category created successfully.');
    }

    // EDIT
    public function edit($id)
    {
        $category = ChatbotCategory::findOrFail($id);

        return view('admin.chatbot.categories.edit', compact('category'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:chatbot_categories,name,' . $id,
        ]);

        $category = ChatbotCategory::findOrFail($id);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.chatbot.categories.index')->with('flash_message', 'Category updated successfully.');
    }

    // DELETE
    public function destroy($id)
    {
        $category = ChatbotCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.chatbot.categories.index')->with('flash_message', 'Category deleted successfully.');
    }
}