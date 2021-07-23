<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function show(Subject $subject) {
        return response()->json($subject,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $subject = Subject::where('subj_title','like',"%$request->key%")
            ->orWhere('instructor','like',"%$request->key%")->get();

        return response()->json($subject
        , 200);
    }

    public function store(Request $request) {
        $request->validate([
            'subj_title' => 'string|required',
            'instructor' => 'string|required',
        ]);

        try {
            $subject = Subject::create([
                'subj_title' => $request->subj_title,
                'instructor' => $request->instructor,
                'user_id' => auth()->user()->id,
            ]);
            
            return response()->json($subject, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Subject $subject) {
        try {
            $subject->update($request->all());
            return response()->json($subject, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Subject $subject) {
        $subject->delete();
        return response()->json(['message'=>'Subject deleted.'],202);
    }

    public function index() {
        $subject = Subject::where('user_id', auth()->user()->id)->orderBy('subj_title')->get();
        return response()->json($subject, 200);
    }
}
