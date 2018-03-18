<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
    	// We're using an observer to add the company_id using the current tenant.
    	Project::create([
    		'name' => $request->name
    	]);

    	return back();
    }

    public function destroy()
    {
    	Project::find(1)->delete();
    }

    public function show(Project $project)
    {
    	return view('tenant.projects.show', compact('project'));
    }
}

