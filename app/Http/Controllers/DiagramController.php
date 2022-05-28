<?php

namespace App\Http\Controllers;

use App\Models\Diagram;
use App\Http\Requests\StoreDiagramRequest;
use App\Http\Requests\UpdateDiagramRequest;

class DiagramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDiagramRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiagramRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diagram  $diagram
     * @return \Illuminate\Http\Response
     */
    public function show(Diagram $diagram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diagram  $diagram
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagram $diagram)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiagramRequest  $request
     * @param  \App\Models\Diagram  $diagram
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiagramRequest $request, Diagram $diagram)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diagram  $diagram
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagram $diagram)
    {
        //
    }
}
