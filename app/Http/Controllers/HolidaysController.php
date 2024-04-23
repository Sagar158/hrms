<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Holidays;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class HolidaysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Holidays';
    public function index()
    {
        $this->authorize('viewAny',Holidays::class);
        $title = $this->title;
        return view('holiday.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',Holidays::class);
        $title = $this->title;
        $holiday = new Holidays;

        return view('holiday.edit',compact('title','holiday'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create',Holidays::class);
        $validatedData = $request->validate([
            'name' => 'required|string',
            'start_date' => 'required|string',
            'end_date' => 'required|string',
        ]);

        $holiday = new Holidays();
        $holiday->name = $validatedData['name'];
        $holiday->start_date = $validatedData['start_date'];
        $holiday->end_date = $validatedData['end_date'];
        $holiday->save();

        return redirect()->route('holiday.index')->with('success', 'Holiday added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Holidays $holiday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $holidayId)
    {
        $this->authorize('update',Holidays::class);
        $title = $this->title;
        $holiday = Holidays::findOrFail($holidayId);

        return view('holiday.edit',compact('title','holiday'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $holidayId)
    {
        $this->authorize('update',Holidays::class);
        $validatedData = $request->validate([
            'name' => 'required|string',
            'start_date' => 'required|string',
            'end_date' => 'required|string',
        ]);

        $holiday = Holidays::findOrFail($holidayId);
        $holiday->name = $validatedData['name'];
        $holiday->start_date = $validatedData['start_date'];
        $holiday->end_date = $validatedData['end_date'];
        $holiday->save();

        return redirect()->route('holiday.index')->with('success', 'Holiday updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $holidayId)
    {
        $this->authorize('delete',Holidays::class);
        $record = Holidays::destroy($holidayId);
        return response()->json(['success' => $record]);
    }


    public function getHolidaysData()
    {
        $this->authorize('viewAny',Holidays::class);

        $query = Holidays::query();

        return DataTables::of($query)
            ->editColumn('start_date', function($holiday){
                return date('F j, Y', strtotime($holiday->start_date));
            })
            ->editColumn('end_date', function($holiday){
                return date('F j, Y', strtotime($holiday->end_date));
            })
            ->addColumn('days', function($holiday){
                $start = Carbon::parse($holiday->start_date);
                $end = Carbon::parse($holiday->end_date);
                $diffInDays = $end->diffInDays($start) + 1;
                return $diffInDays .' Days';
            })
            ->addColumn('year', function($holiday){
                return date('Y', strtotime($holiday->start_date));
            })
            ->addColumn('action', function ($holiday) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item" href="'.route('holiday.edit', $holiday->id).'">Edit</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('holiday.destroy', $holiday->id).'" data-id="'.$holiday->id.'">Delete</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }

}
