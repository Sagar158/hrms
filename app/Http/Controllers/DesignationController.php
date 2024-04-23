<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DesignationController extends Controller
{
    public $title = 'Designation';
    public function index()
    {
        $this->authorize('viewAny',Designation::class);
        $title = $this->title;
        return view('designation.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',Designation::class);
        $title = $this->title;
        $designation = new Designation;

        return view('designation.edit',compact('title','designation'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create',Designation::class);
        $validatedData = $request->validate([
            'name' => 'required|string|unique:designations,name',
        ]);

        $designation = new Designation();
        $designation->name = $validatedData['name'];
        $designation->save();

        return redirect()->route('designation.index')->with('success', 'Designation added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $designationId)
    {
        $this->authorize('update',Designation::class);
        $title = $this->title;
        $designation = Designation::findOrFail($designationId);

        return view('designation.edit',compact('title','designation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $designationId)
    {
        $this->authorize('update',Designation::class);
        $validatedData = $request->validate([
            'name' => 'required|string|unique:designations,name,' . $designationId,
        ]);

        $designation = Designation::findOrFail($designationId);
        $designation->name = $validatedData['name'];
        $designation->save();

        return redirect()->route('designation.index')->with('success', 'Designation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $designationId)
    {
        $this->authorize('delete',Designation::class);
        $record = Designation::destroy($designationId);
        return response()->json(['success' => $record]);

    }

    public function changeStatus(Request $request, $designationId)
    {
        $this->authorize('update',Designation::class);

        $designation = Designation::findOrFail($designationId);

        if($designation->status == 'active')
        {
            $designation->status = 'inactive';
        }
        else
        {
            $designation->status = 'active';
        }
        $designation->save();

        return response()->json(['success' => 1]);
    }



    public function getDesignationData()
    {
        $this->authorize('viewAny',Designation::class);

        $query = Designation::query();

        return DataTables::of($query)
            ->editColumn('status', function($designation){
                return ucfirst($designation->status);
            })
            ->addColumn('action', function ($designation) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item" href="'.route('designation.edit', $designation->id).'">Edit</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('designation.destroy', $designation->id).'" data-id="'.$designation->id.'">Delete</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }

    public function getData(Request $request)
    {
        $designations = Designation::select('id','name');
        if($request->filled('search'))
        {
            $designations = $designations->where('name', 'LIKE','%'.$request->search.'%');
        }
        $designations = $designations->get();

        return response()->json(['data' => $designations]);
    }

}
