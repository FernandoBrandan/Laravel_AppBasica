<?php

namespace App\Http\Controllers;

use App\Models\Resume; 
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Images;

class ResumeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
     { 
        $resumes = auth()->user()->resumes;               
        return view('resume.index', ['resumes' => $resumes]); 
        //return view('resume.index', compact($resumes));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('resumeController function create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $user = auth()->user();  
        $resume = $user->resumes()->where('title', $request->title)->first(); 
        if($resume){
            return back()
                ->withErrors(['title' => 'Titulo ya existe'])
                ->withInput(['title' => $request->title]);
        }

        /*$resume = $user->resumes()->create([
            'title' => $request['titulo'],
            'name' => $user->name,
            'email' => $user->email
        ]); 
        */
        return redirect()->route('resume.index')->with('alert', [
            'type' =>'primary',
            'message' => "CV $resume->title creado correctamente"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function show(Resume $resume)
    {        
        return view('resume.edit', compact('resume'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function edit(Resume $resume)
    {
        /*if($resume->user->id != auth()->user()->id){
            abort(403);
        }*/// -->>> cambia por controller Policy
        $this->authorize('update', $resume);
        return view('resume.edit', compact('resume'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resume $resume)
    {
        $data = $request->validate([
            'name' => ['required|string'],
            'email' => ['required|email'],
            'website' => ['nullable|url'],
            'picture' => ['nullable|image'],
            'about' => ['nullable|string'], 
            'title' => Rule::unique('resumes')
                ->where(function($query) use ($resume){
                return $query->where('user_id', $resume->user->id);
            })->ignore($resume->id)
            /*'title' => Rule::unique('resumes')
                ->where(fn($query) => $query->where('user_id', $resume->user->id))
                ->ignore($resume->id)*/
        ]);

        if(array_key_exists('picture', $data)){
            $picture = $data['picture']->store('pictures', 'public');
            Image::make(public_path("storage/$picture"))->fit(800,800)->save();
            $data['picture'] =  "storage/$picture";
        }

        $resume->update($data);
        
        return redirect()->route('resumes.index')->with('alert', [
            'type' =>'success',
            'message' => "CV $resume->title subido correctamente"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resume $resume)
    {
        $resume->delete();

        return redirect()->route('resumes.index')->with('alert', [
            'type' =>'danger',
            'message' => "CV $resume->title eliminado correctamente"
        ]);
    }
}
