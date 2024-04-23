<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use App\Models\LeaveApplication;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Events\LeaveApplicationEvent;

class LeaveApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Leave Application';
    public function index()
    {
        $this->authorize('viewAny',LeaveApplication::class);
        $title = $this->title;
        return view('leaveapplication.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',LeaveApplication::class);
        $title = $this->title;
        $leaveApplication = new LeaveApplication;

        return view('leaveapplication.edit',compact('title','leaveApplication'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', LeaveApplication::class);
        try
        {
            DB::beginTransaction();
            $userId = auth()->user()->id;
            $validatedData = $request->validate([
                'user_id' => 'required',
                'leave_type_id' => 'required',
                'from' => 'required',
                'to' => 'required',
                'reason' => 'required'
            ]);

            $start = Carbon::parse($validatedData['from']);
            $end = Carbon::parse($validatedData['to']);
            $diffInDays = $end->diffInDays($start) + 1;
            $status = LeaveApplication::APPROVAL_PENDING_BY_HR;

            $leaveApplication = new LeaveApplication();
            $leaveApplication->user_id = $validatedData['user_id'];
            $leaveApplication->leave_type_id = $validatedData['leave_type_id'];
            $leaveApplication->from = $validatedData['from'];
            $leaveApplication->to = $validatedData['to'];
            $leaveApplication->reason = $validatedData['reason'];
            $leaveApplication->status = $status;
            $leaveApplication->duration = $diffInDays;
            $leaveApplication->created_by = $userId;
            $leaveApplication->save();

            event(new LeaveApplicationEvent($leaveApplication, $status));

            DB::commit();

            return redirect()->route('leaveapplication.index')->with('success', 'Leave Application added successfully');
        }
        catch (Throwable $e)
        {
            DB::rollBack();

            return redirect()->back()->with('error', 'An error occurred while adding the Leave Application. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($leaveApplicationId)
    {
        $this->authorize('viewAny',LeaveApplication::class);
        $title = $this->title;
        $leaveApplication = LeaveApplication::findOrFail($leaveApplicationId);
        return view('leaveapplication.show',compact('title','leaveApplication'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $leaveApplicationId)
    {
        $this->authorize('update',LeaveApplication::class);
        $title = $this->title;
        $leaveApplication = LeaveApplication::findOrFail($leaveApplicationId);

        return view('leaveapplication.edit',compact('title','leaveApplication'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $leaveApplicationId)
    {
        $this->authorize('update',LeaveApplication::class);
        try
        {
            DB::beginTransaction();
            $userId = auth()->user()->id;
            $validatedData = $request->validate([
                'user_id' => 'required',
                'leave_type_id' => 'required',
                'from' => 'required',
                'to' => 'required',
                'reason' => 'required'
            ]);

            $start = Carbon::parse($validatedData['from']);
            $end = Carbon::parse($validatedData['to']);
            $diffInDays = $end->diffInDays($start) + 1;

            $leaveApplication = LeaveApplication::findOrFail($leaveApplicationId);
            $leaveApplication->user_id = $validatedData['user_id'];
            $leaveApplication->leave_type_id = $validatedData['leave_type_id'];
            $leaveApplication->from = $validatedData['from'];
            $leaveApplication->to = $validatedData['to'];
            $leaveApplication->reason = $validatedData['reason'];
            $leaveApplication->duration = $diffInDays;
            $leaveApplication->created_by = $userId;
            $leaveApplication->save();

            DB::commit();

            return redirect()->route('leaveapplication.index')->with('success', 'Leave Application updated successfully');
        }
        catch (Throwable $e)
        {
            DB::rollBack();

            return redirect()->back()->with('error', 'An error occurred while adding the Leave Application. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $leaveApplicationId)
    {
        $this->authorize('delete',LeaveApplication::class);
        $record = LeaveApplication::destroy($leaveApplicationId);
        return response()->json(['success' => $record]);
    }


    public function getLeaveData()
    {
        $this->authorize('viewAny',LeaveApplication::class);

        $query = LeaveApplication::with(['applicationBy','leaveType']);

        return DataTables::of($query)
            ->addColumn('employee_name', function($leaveApplication){
                return $leaveApplication->applicationBy->full_name;
            })
            ->addColumn('pin', function($leaveApplication){
                return $leaveApplication->applicationBy->employee_code;
            })
            ->addColumn('leave_type', function($leaveApplication){
                return $leaveApplication->leaveType->name;
            })
            ->addColumn('apply_date', function($leaveApplication){
                return date('F j, Y', strtotime($leaveApplication->created_at));
            })
            ->addColumn('start_date', function($leaveApplication){
                return date('F j, Y', strtotime($leaveApplication->from));
            })
            ->addColumn('end_date', function($leaveApplication){
                return date('F j, Y', strtotime($leaveApplication->to));
            })
            ->editColumn('duration', function($leaveApplication){
                return $leaveApplication->duration.' Days';
            })
            ->editColumn('status', function($leaveApplication){
                return LeaveApplication::STAGE_LABELS[$leaveApplication->status]['label'];
            })
            ->addColumn('action', function ($leaveApplication) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                <a class="dropdown-item" href="'.route('leaveapplication.show', $leaveApplication->id).'">Show</a>
                                <a class="dropdown-item" href="'.route('leaveapplication.edit', $leaveApplication->id).'">Edit</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('leaveapplication.destroy', $leaveApplication->id).'" data-id="'.$leaveApplication->id.'">Delete</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action','status','duration'])
            ->make(true);
    }

    public function fetchRemainingLeaves(Request $request)
    {
        $userId = $request->user_id;
        $leaveTypeId = $request->leave_type_id;

        $getLeaveDuration = LeaveType::findOrFail($leaveTypeId)->days;

        $leaves = LeaveApplication::where([
            ['user_id' ,'=', $userId],
            ['leave_type_id' ,'=', $leaveTypeId],
            ['status' ,'=', LeaveApplication::APPROVED_BY_HOD],
        ])->pluck('duration')->toArray();

        $totalLeavesTaken = array_sum($leaves);
        $remainingLeaves = $getLeaveDuration - $totalLeavesTaken;

        return response()->json([
            'remainingLeaves' => $remainingLeaves,
        ]);
    }

    public function decide(Request $request, $leaveApplicationId)
    {
        try
        {
            DB::beginTransaction();

            $leaveApplication = LeaveApplication::findOrFail($leaveApplicationId);
            $action = $request->action;

            $nextStage = LeaveApplication::NEXT_STAGE['employee'][$leaveApplication->status][$action];
            $userId = auth()->user()->id;
            $message = LeaveApplication::STAGE_LABELS[$nextStage]['message'];
            $alertType = LeaveApplication::STAGE_LABELS[$nextStage]['alert-type'];

            LeaveApplication::where('id', $leaveApplicationId)->update([
                'status' => $nextStage
            ]);

            event(new LeaveApplicationEvent($leaveApplication, $nextStage));

            DB::commit(); // Commit the transaction if everything is successful

            return redirect()->back()->with($alertType, $message);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack(); // Roll back the transaction in case of an exception
            return redirect()->back()->with('error', 'Leave Application not found.');
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction in case of an exception
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

}
