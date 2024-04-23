<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdvanceSalary;
use Yajra\DataTables\DataTables;

class AdvanceSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Advance Salary';
    public function index()
    {
        $this->authorize('viewAny',AdvanceSalary::class);

        $title = $this->title;
        return view('advancesalary.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',AdvanceSalary::class);
        $title = $this->title;
        $advanceSalary = new AdvanceSalary;

        return view('advancesalary.edit',compact('title','advanceSalary'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create',AdvanceSalary::class);
        $validatedData = $request->validate([
            'user_id' => 'required|string',
            'branch_id' => 'required|string',
            'amount_requested' => 'required|string',
        ]);

        $advanceSalary = new AdvanceSalary();
        $advanceSalary->branch_id = $validatedData['branch_id'];
        $advanceSalary->user_id = $validatedData['user_id'];
        $advanceSalary->amount_requested = $validatedData['amount_requested'];
        $advanceSalary->save();

        return redirect()->route('advancesalary.index')->with('success', 'Advance Salary added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdvanceSalary $advanceSalary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $holidayId)
    {
        $this->authorize('update',AdvanceSalary::class);
        $title = $this->title;
        $advanceSalary = AdvanceSalary::with(['employee'])->findOrFail($holidayId);
        return view('advancesalary.edit',compact('title','advanceSalary'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $advanceSalaryId)
    {
        $this->authorize('update',AdvanceSalary::class);

        $validatedData = $request->validate([
            'user_id' => 'required|string',
            'branch_id' => 'required|string',
            'amount_requested' => 'required|string',
        ]);

        $advanceSalary = AdvanceSalary::findOrFail($advanceSalaryId);
        $advanceSalary->branch_id = $validatedData['branch_id'];
        $advanceSalary->user_id = $validatedData['user_id'];
        $advanceSalary->amount_requested = $validatedData['amount_requested'];
        $advanceSalary->save();

        return redirect()->route('advancesalary.index')->with('success', 'Advance Salary updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $advanceSalaryId)
    {
        $this->authorize('delete',AdvanceSalary::class);
        $record = AdvanceSalary::destroy($advanceSalaryId);
        return response()->json(['success' => $record]);
    }


    public function getAdvanceSalaryData()
    {
        $this->authorize('viewAny',AdvanceSalary::class);

        $query = AdvanceSalary::with(['employee']);

        return DataTables::of($query)
            ->addColumn('employee_name', function($advanceSalary){
                return $advanceSalary->employee->full_name;
            })
            ->addColumn('department', function($advanceSalary){
                return $advanceSalary->employee->department->name;
            })
            ->addColumn('designation', function($advanceSalary){
                return $advanceSalary->employee->designation->name;
            })
            ->addColumn('mobile_number', function($advanceSalary){
                return $advanceSalary->employee->contact_number;
            })
            ->addColumn('amount_requested', function($advanceSalary){
                return number_format($advanceSalary->amount_requested, 2);
            })
            ->editColumn('branch', function($advanceSalary){
                return $advanceSalary->branch->name;
            })
            ->editColumn('created_at', function($advanceSalary){
                return date('F j, Y', strtotime($advanceSalary->created_at));
            })
            ->addColumn('action', function ($advanceSalary) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item" href="'.route('advancesalary.edit', $advanceSalary->id).'">Edit</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('advancesalary.destroy', $advanceSalary->id).'" data-id="'.$advanceSalary->id.'">Delete</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action','created_at'])
            ->make(true);
    }
}
