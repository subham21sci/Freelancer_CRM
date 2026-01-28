<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projectData = Project::with('categoryinfo','clientinfo')->orderBy('id','desc')->get();
        return view('backend.projects.pdata.all',compact('projectData'));
    }

    public function completed()
    {
        $projectData = Project::orderBy('id','desc')->where('status','1')->get();
        return view('backend.projects.pdata.completed',compact('projectData'));
    }

    public function incomplete()
    {
        $projectData = Project::orderBy('id','desc')->where('status','2')->get();
        return view('backend.projects.pdata.incomplete',compact('projectData'));
    }

    public function ongoing()
    {
        $projectData = Project::orderBy('id','desc')->where('status','3')->get();
        return view('backend.projects.pdata.ongoing',compact('projectData'));
    }

    public function pipeline()
    {
        $projectData = Project::orderBy('id','desc')->where('status','4')->get();
        return view('backend.projects.pdata.pipeline',compact('projectData'));
    }
    public function rejected()
    {
        $projectData = Project::orderBy('id','desc')->where('status','5')->get();
        return view('backend.projects.pdata.rejected',compact('projectData'));
    }
    public function projectPayents($id)
    {
        $projectData = Project::find($id);
        return view('backend.projects.payments',compact('projectData'));
    }
    public function projectquotation($id)
    {
        $projectData = Project::find($id);
        return view('backend.projects.quotation',compact('projectData'));
    }

    public function addProject()
    {
        $catData = Category::orderBy('id', 'asc')->get();
        $clientData = Client::orderBy('id','desc')->get();

        return view('backend.projects.add', compact('catData','clientData'));
    }
    public function projectStore(Request $request)
    {
    //    dd($request->all());

        $request->validate([
            'category_id' => 'required',
            'client_id' => 'required',
            'project_name' => 'required',
            'status' => 'required'
        ], [
            'category_id.required' => 'Kindly Select Category name',
            'client_id.required' => 'Kindly Select Clinet',
            'project_name.required' => 'Kindly Enter Project Name',
            'status.required' => 'Kindly Select status',
        ]);

        $proj = new Project();
        $proj->category_id = $request->category_id;
        $proj->client_id = $request->client_id;
        $proj->project_name = $request->project_name;
        $proj->slug = Str::slug($request->project_name);
        $proj->domain = $request->domain;
        $proj->description = $request->description;
        $proj->status = $request->status;

        $proj->save();

        return redirect()->route('admin.projects.all')->with('success', 'Project has been added successfully');
    }

    public function projectDestroy($id)
    {
        Project::find($id)->delete();

        return redirect()->back()->with('success', 'Project Delete Successful');
    }
}
