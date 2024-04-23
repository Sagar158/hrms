<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Leave Type';
    public function index()
    {
        $this->authorize('viewAny',LeaveType::class);
        $title = $this->title;
        return view('leavetype.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',LeaveType::class);
        $title = $this->title;
        $leaveType = new LeaveType;

        return view('leavetype.edit',compact('title','leaveType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create',LeaveType::class);
        $validatedData = $request->validate([
            'name' => 'required|string',
            'days' => 'required|string',
            'status' => 'required|string',
        ]);

        $leaveType = new LeaveType();
        $leaveType->name = $validatedData['name'];
        $leaveType->status = $validatedData['status'];
        $leaveType->days = $validatedData['days'];
        $leaveType->save();

        return redirect()->route('leavetype.index')->with('success', 'Leave Type added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaveType $leaveType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $leaveTypeId)
    {
        $this->authorize('update',LeaveType::class);
        $title = $this->title;
        $leaveType = LeaveType::findOrFail($leaveTypeId);

        return view('leavetype.edit',compact('title','leaveType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $leaveTypeId)
    {
        $this->authorize('update',LeaveType::class);
        $validatedData = $request->validate([
            'name' => 'required|string',
            'days' => 'required|string',
            'status' => 'required|string',
        ]);

        $holiday = LeaveType::findOrFail($leaveTypeId);
        $holiday->name = $validatedData['name'];
        $holiday->days = $validatedData['days'];
        $holiday->status = $validatedData['status'];
        $holiday->save();

        return redirect()->route('leavetype.index')->with('success', 'Leave Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $leaveTypeId)
    {
        $this->authorize('delete',LeaveType::class);
        $record = LeaveType::destroy($leaveTypeId);
        return response()->json(['success' => $record]);
    }


    public function getLeaveTypeData()
    {
        $this->authorize('viewAny',LeaveType::class);

        $query = LeaveType::query();

        return DataTables::of($query)
            ->editColumn('status', function($leaveType){
                return ucfirst($leaveType->status);
            })
            ->addColumn('action', function ($leaveType) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item" href="'.route('leavetype.edit', $leaveType->id).'">Edit</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('leavetype.destroy', $leaveType->id).'" data-id="'.$leaveType->id.'">Delete</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }

    public function getData(Request $request)
    {
        $leaveTypes = LeaveType::select('id','name');
        if($request->filled('search'))
        {
            $leaveTypes = $leaveTypes->where('name', 'LIKE','%'.$request->search.'%');
        }
        $leaveTypes = $leaveTypes->get();

        return response()->json(['data' => $leaveTypes]);
    }
}
