<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{

    public function index()
{
    try {
        $projectData = Project::with(['categoryinfo', 'clientinfo'])
            ->orderByDesc('id')
            ->get();

        // $tags = Tag::pluck('name', 'id');
// dd($tags,$projectData->first()->tag_names);
        return view('backend.projects.pdata.all', compact('projectData'));

    } catch (\Throwable $e) {

        Log::channel('project')->error('Project Index Error', [
            'message' => $e->getMessage(),
            'trace'   => $e->getTraceAsString(),
        ]);

        return back()->with('error', 'Unable to load projects. Please try again.');
    }
}

    public function completed()
    {
        $projectData = Project::orderBy('id', 'desc')->where('status', '1')->get();

        return view('backend.projects.pdata.completed', compact('projectData'));
    }

    public function incomplete()
    {
        $projectData = Project::orderBy('id', 'desc')->where('status', '2')->get();

        return view('backend.projects.pdata.incomplete', compact('projectData'));
    }

    public function ongoing()
    {
        $projectData = Project::orderBy('id', 'desc')->where('status', '3')->get();

        return view('backend.projects.pdata.ongoing', compact('projectData'));
    }

    public function pipeline()
    {
        $projectData = Project::orderBy('id', 'desc')->where('status', '4')->get();

        return view('backend.projects.pdata.pipeline', compact('projectData'));
    }

    public function rejected()
    {
        $projectData = Project::orderBy('id', 'desc')->where('status', '5')->get();

        return view('backend.projects.pdata.rejected', compact('projectData'));
    }

    public function projectPayents($id)
    {
        $projectData = Project::find($id);

        return view('backend.projects.payments', compact('projectData'));
    }

    public function projectquotation($id)
    {
        $projectData = Project::find($id);

        return view('backend.projects.quotation', compact('projectData'));
    }

    public function addProject()
    {
        $catData = Category::orderBy('id', 'asc')->get();
        $clientData = Client::orderBy('id', 'desc')->get();
        $tagData = Tag::orderBy('id', 'desc')->get();

        return view('backend.projects.add', compact('catData', 'clientData', 'tagData'));
    }

    public function projectStore(Request $request)
{
    $validated = $request->validate([
        'category_id'  => 'required|integer|exists:categories,id',
        'client_id'    => 'required|integer|exists:clients,id',
        'project_name' => 'required|string|min:3|max:255|unique:projects,project_name',
        'domain'       => 'nullable|url|max:255',
        'status'       => 'required|in:pipeline,ongoing,completed,maintenance,rejected',
        'start_date'   => 'required|date|before_or_equal:today',
        'description'  => 'nullable|string|max:5000',
        'tags'         => 'nullable|array',
        'tags.*'       => 'integer|exists:tags,id',
    ]);

    try {
        DB::transaction(function () use ($validated) {

            $slug = Str::slug($validated['project_name']);

            $latestSlug = Project::where('slug', 'like', $slug.'%')
                ->orderBy('id', 'desc')
                ->value('slug');

            if ($latestSlug && preg_match('/-(\d+)$/', $latestSlug, $matches)) {
                $finalSlug = $slug.'-'.($matches[1] + 1);
            } elseif ($latestSlug) {
                $finalSlug = $slug.'-1';
            } else {
                $finalSlug = $slug;
            }

            Project::create([
                'category_id'  => $validated['category_id'],
                'client_id'    => $validated['client_id'],
                'project_name' => $validated['project_name'],
                'slug'         => $finalSlug,
                'domain'       => $validated['domain'] ?? null,
                'description'  => $validated['description'] ?? null,
                'status'       => $validated['status'],
                'start_date'   => $validated['start_date'],
                'tag_id'       => !empty($validated['tags'])
                    ? implode(',', $validated['tags'])
                    : null,
            ]);
        });

        return redirect()
            ->route('admin.projects.all')
            ->with('success', 'Project has been added successfully');

    } catch (\Throwable $e) {

        Log::channel('project')->error('Project Store Error', [
            'message' => $e->getMessage(),
            'trace'   => $e->getTraceAsString(),
            'input'   => $request->all(),
        ]);

        return back()
            ->with('error', 'An error occurred while adding the project.')
            ->withInput();
    }
}


   public function projectDestroy($id)
{
    try {
        DB::transaction(function () use ($id) {

            $project = Project::findOrFail($id);

            // Optional: delete related resources here
            // e.g. files, logs, pivot records

            $project->delete(); // Soft delete
        });

        return redirect()
            ->back()
            ->with('success', 'Project deleted successfully');

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

        return redirect()
            ->back()
            ->with('error', 'Project not found');

    } catch (\Throwable $e) {

        Log::channel('project')->error('Project Delete Error', [
            'project_id' => $id,
            'message'    => $e->getMessage(),
        ]);

        return redirect()
            ->back()
            ->with('error', 'Failed to delete project. Please try again.');
    }
}
}
