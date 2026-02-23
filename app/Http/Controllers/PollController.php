<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollOption;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function index()
    {
        $polls = Poll::where('status', 'active')->get();
        return view('dashboard', compact('polls'));
    }

    public function create()
    {
        return view('polls.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $poll = Poll::create([
            'question' => $request->question,
            'status' => $request->status,
        ]);

        foreach ($request->options as $optionText) {
            PollOption::create([
                'poll_id' => $poll->id,
                'option_text' => $optionText,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Poll created successfully!');
    }

    public function show($id)
    {
        $poll = Poll::with('options')->find($id);

        if (!$poll) {
            return response()->json(['error' => 'Poll not found'], 404);
        }

        return response()->json([
            'id' => $poll->id,
            'question' => $poll->question,
            'status' => $poll->status,
            'options' => $poll->options,
        ]);
    }
}
