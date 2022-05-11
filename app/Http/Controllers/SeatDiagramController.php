<?php

namespace App\Http\Controllers;

use App\Models\Seat_diagram;
use App\Http\Requests\StoreSeat_diagramRequest;
use App\Http\Requests\UpdateSeat_diagramRequest;

class SeatDiagramController extends Controller
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
     * @param  \App\Http\Requests\StoreSeat_diagramRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeat_diagramRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seat_diagram  $seat_diagram
     * @return \Illuminate\Http\Response
     */
    public function show(Seat_diagram $seat_diagram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seat_diagram  $seat_diagram
     * @return \Illuminate\Http\Response
     */
    public function edit(Seat_diagram $seat_diagram)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSeat_diagramRequest  $request
     * @param  \App\Models\Seat_diagram  $seat_diagram
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeat_diagramRequest $request, Seat_diagram $seat_diagram)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seat_diagram  $seat_diagram
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seat_diagram $seat_diagram)
    {
        //
    }
}
