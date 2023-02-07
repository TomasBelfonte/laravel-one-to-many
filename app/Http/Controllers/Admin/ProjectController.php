<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectRequest;
use App\Models\Project;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $projects = Project::all();

        return view("admin.projects.index", [
            "projects" => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ("admin.projects.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {

        $data = $request->validated();



        $project = Project::create([
            ...$data,
            "user_id" => Auth::user()->id
        ]);

        return redirect()->route("admin.projects.show", $project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project) {
        return view("admin.projects.show", compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {

        return view("admin.projects.edit", compact("project"));
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
        $project = Project::FindOrFail($id);
        $data = $request->all();

        if (key_exists("cover_img", $data)) {
            // carico il nuovo file
            // salvo in una variabile temporanea il percorso del nuovo file
            $path = Storage::put("projects", $data["cover_img"]);

            // Dopo aver caricato la nuova immagine, PRIMA di aggiornare il db,
            // cancelliamo dallo storage il vecchio file.
            // $project->cover_img // vecchio file
            Storage::delete($project->cover_img);
        }

        $project->update([
            ...$data,
            // Se $path ha un valore, significa che abbiamo caricato un nuovo file.
            // Altrimenti, usiamo il percorso vecchio tramite $project->cover_img
            "cover_img" => $path ?? $project->cover_img
        ]);

        return redirect()->route("admin.project.show", compact("project"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        if ($project->cover_img) {
            Storage::delete($project->cover_img);
        }

        $project->delete();
    }
}
