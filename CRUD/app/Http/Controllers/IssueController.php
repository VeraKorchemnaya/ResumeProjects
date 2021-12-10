<?php

// Name: Vera Korchemnaya
// Description: Resourceful Controller
//      This class is for controlling all the 
//      actions taking place in the app.
//      We can create and store, edit and update,
//      list all records and show one record, and delete.

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Sorts records based on what column is selected by 
        // the user 
        if ($request['field'] && $request['sort']) {

            // Special sort for publication date 
            if ($request['field'] == 'date') {
                // Sort first by year and then by month
                $issues = \App\Models\Issue::orderBy('year', $request['sort'])->orderBy('month', $request['sort'])->paginate(25);
                return view('issues.index', ['comicIssues' => $issues]);
            }

            // For all other sorts
            $issues = \App\Models\Issue::orderBy($request['field'], $request['sort'])->paginate(25);
            return view('issues.index', ['comicIssues' => $issues]);
        }

        // If the records are not sorted we go here
        $issues = \App\Models\Issue::paginate(25);
        return view('issues.index', ['comicIssues' => $issues]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $issue = new \App\Models\Issue;
        return view('issues.create', ['comic' => $issue]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateData($request);
        \App\Models\Issue::create($validatedData);
        return redirect()->route('issues.index')->with('success', $validatedData['title'] . " was added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $issue = \App\Models\Issue::findOrFail($id);
        return view('issues.show', ['comic' => $issue]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $issue = \App\Models\Issue::findOrFail($id);
        return view('issues.edit', ['comic' => $issue]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateData($request);
        $toUpdate = \App\Models\Issue::findOrFail($id);
        $toUpdate->update($validatedData);
        return redirect()->route('issues.index')->with('success', "$toUpdate->title was updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deceased = \App\Models\Issue::findOrFail($id);
        $deceased->delete();

        return redirect()->route('issues.index')->with('success', "$deceased->title was deleted");
    }

    /**
     * Validate a record that was either created or updated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function validateData(Request $request)
    {
        return $request->validate(
            [
                'title' => 'required|max:30',
                'volume' => 'integer|required',
                'issue_number' => 'integer|required',
                'month' => 'integer|required',
                'year' => 'integer|required',
                'condition' => 'integer|required',
                'writer_last_name' => 'required|max:20',
                'writer_first_name' => 'required|max:20',
                'artist_last_name' => 'required|max:20',
                'artist_first_name' => 'required|max:20'
            ]
        );
    }
}
