<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Department';
    public function index()
    {
        $this->authorize('viewAny',Department::class);
        $title = $this->title;
        return view('department.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',Department::class);
        $title = $this->title;
        $department = new Department;

        return view('department.edit',compact('title','department'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create',Department::class);
        $validatedData = $request->validate([
            'name' => 'required|string|unique:departments,name',
        ]);

        $department = new Department();
        $department->name = $validatedData['name'];
        $department->save();

        return redirect()->route('department.index')->with('success', 'Department added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $departmentId)
    {
        $this->authorize('update',Department::class);
        $title = $this->title;
        $department = Department::findOrFail($departmentId);

        return view('department.edit',compact('title','department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $departmentId)
    {
        $this->authorize('update',Department::class);
        $validatedData = $request->validate([
            'name' => 'required|string|unique:departments,name,' . $departmentId,
        ]);

        $department = Department::findOrFail($departmentId);
        $department->name = $validatedData['name'];
        $department->save();

        return redirect()->route('department.index')->with('success', 'Department updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $departmentId)
    {
        $this->authorize('delete',Department::class);
        $record = Department::destroy($departmentId);
        return response()->json(['success' => $record]);

    }

    public function changeStatus(Request $request, $departmentId)
    {
        $this->authorize('update',Department::class);

        $department = Department::findOrFail($departmentId);

        if($department->status == 'active')
        {
            $department->status = 'inactive';
        }
        else
        {
            $department->status = 'active';
        }
        $department->save();

        return response()->json(['success' => 1]);
    }



    public function getDepartmentData()
    {
        $this->authorize('viewAny',Department::class);

        $query = Department::query();

        return DataTables::of($query)
            ->editColumn('status', function($department){
                return ucfirst($department->status);
            })
            ->addColumn('action', function ($department) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item" href="'.route('department.edit', $department->id).'">Edit</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('department.destroy', $department->id).'" data-id="'.$department->id.'">Delete</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }

    public function getData(Request $request)
    {
        $departments = Department::select('id','name');
        if($request->filled('search'))
        {
            $departments = $departments->where('name', 'LIKE','%'.$request->search.'%');
        }
        $departments = $departments->get();

        return response()->json(['data' => $departments]);
    }

}
