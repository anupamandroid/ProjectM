<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use App\User;
use App\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::check()){
            $projects = Project::where('user_id', Auth::user()->id)->get();
        
            return view('projects.index', [ 'projects' => $projects ]);
        }
        
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id = null)
    {
        //
        $companies = null;
        
        if($company_id){
            $companies = Company::where('user_id', Auth::user()->id)->get();
        }
        dump($company_id);
        dd($companies);
        return view('projects.create', [ 'company_id' => $company_id, 'companies' => $companies ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(Auth::check()){
            $project = Project::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'company_id' => $request->input('company_id'),
                'user_id' => Auth::user()->id  //For Laravel 5.5, $request->user()->id is also applicable
            ]);
            
            if($project){
                return redirect()->route('projects.show', ['project' => $project->id])->with('success', 'Project created successfully');
            }
        }
        
        return back()->withInput()->with('errors', 'Error creating new project');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
        //$project = Project::where('id', $project->id)->first();
        $project = Project::find($project->id);
        $comments = $project->comments;
        
        return view('projects.show', [ 'project' => $project, 'comments' => $comments ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
        $project = Project::find($project->id);
        
        return view('projects.edit', [ 'project' => $project ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
        $projectUpdate = Project::where('id', $project->id)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);
        
        if($projectUpdate){
            return redirect()->route('projects.show', ['company' => $project->id])->with('success', 'Project updated successfully');
        }
        
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
        
        //dd - Dumb and Die
        //dd($project);
        
        $findProject = Project::find($project->id);
        
        if($findProject->delete()){
            return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
        }
        
        return back()->withInput()->with('errors', 'Project could not be deleted');
    }
    
    /*=========== Custom Functions =============*/
    
    /*------- Linking User to a Project ---------*/
    public function addUser(Request $request){
        //Take a project, add a user to it
        $project = Project::find($request->input('project_id'));
        
        if(Auth::user()->id == $project->user_id){
            $user = User::where('email', $request->input('email'))->first(); //For single record -> first(), for list -> get()
        
            //Check if user is already added to the project
            $projectUser = ProjectUser::where('user_id', $user->id)->where('project_id', $project->id)->first();
            
            if($projectUser){
                //If user already exists, skip
                return redirect()->route('projects.show', ['project' => $project->id])->with('success', $request->input('email').' is already a member of this project');
            }
            
            if($user && $project){
                $project->users()->attach($user->id);
                
                return redirect()->route('projects.show', ['project' => $project->id])->with('success', $request->input('email').' has been added to this project successfully');
            }
        }
        
        return redirect()->route('projects.show', ['project' => $project->id])->with('errors', 'Error adding user to this project');
    }
}
