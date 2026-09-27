<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotKnowledge;
use App\Models\ChatbotCategory;
use Illuminate\Http\Request;

class ChatbotKnowledgeController extends Controller
{
    // ================= INDEX =================
    public function index()
    {   
        $knowledge = ChatbotKnowledge::with('category')
            ->latest()
            ->paginate(10);

        return view('admin.chatbot.knowledge.index', compact('knowledge'));
    }

    // ================= CREATE =================
    public function create()
    {
        $categories = ChatbotCategory::latest()->get();

        return view('admin.chatbot.knowledge.create', compact('categories'));
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category_id' => 'nullable|exists:chatbot_categories,id',
            'keywords'    => 'nullable|string',
            'status'      => 'required|in:active,inactive',
        ]);

        ChatbotKnowledge::create([
            'title'       => $request->title,
            'content'     => $request->content,
            'category_id' => $request->category_id,
            'keywords'    => $request->keywords,
            'status'      => $request->status,
        ]);

        return redirect()->route('admin.chatbot.knowledge.index')->with('flash_message', 'Knowledge created successfully.');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $knowledge = ChatbotKnowledge::findOrFail($id);
        $categories = ChatbotCategory::latest()->get();

        return view('admin.chatbot.knowledge.edit', compact('knowledge', 'categories'));
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category_id' => 'nullable|exists:chatbot_categories,id',
            'keywords'    => 'nullable|string',
            'status'      => 'required|in:active,inactive',
        ]);

        $knowledge = ChatbotKnowledge::findOrFail($id);

        $knowledge->update([
            'title'       => $request->title,
            'content'     => $request->content,
            'category_id' => $request->category_id,
            'keywords'    => $request->keywords,
            'status'      => $request->status,
        ]);

        return redirect()->route('admin.chatbot.knowledge.index')->with('flash_message', 'Knowledge updated successfully.');
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        $knowledge = ChatbotKnowledge::findOrFail($id);
        $knowledge->delete();

        return redirect()->route('admin.chatbot.knowledge.index')->with('flash_message', 'Knowledge deleted successfully.');
    }
}