<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\Helper;
use App\Models\UserAddress;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\UserDocuments;
use App\Models\UserEducation;
use App\Models\UserExperience;
use App\Models\UserBankAccount;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Employees';
    public function index()
    {
        $this->authorize('viewAny',User::class);
        $title = $this->title;
        return view('users.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',User::class);
        $title = $this->title;
        $user = new User;
        return view('users.edit',compact('title','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create',User::class);

        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required',
            'email' => 'required|string|max:255|email|unique:users,email',
            'employee_code' => 'required|string|max:255|unique:users,employee_code',
            'department_id' => 'required',
            'designation_id'=> 'required',
            'user_type_id' => 'required',
            'gender' => 'required|string',
            'blood_group' => 'required|string',
            'nid' => 'required|string',
            'contact_number' => 'required|string',
            'date_of_birth' => 'required|string',
            'date_of_joining' => 'required|string',
            'date_of_leaving' => 'nullable|string',
            'username' => 'required|string',
        ]);

        $user = new User;
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->employee_code = $validatedData['employee_code'];
        $user->department_id = $validatedData['department_id'];
        $user->designation_id = $validatedData['designation_id'];
        $user->user_type_id = $validatedData['user_type_id'];
        $user->gender = $validatedData['gender'];
        $user->blood_group = $validatedData['blood_group'];
        $user->nid = $validatedData['nid'];
        $user->contact_number = $validatedData['contact_number'];
        $user->date_of_birth = $validatedData['date_of_birth'];
        $user->date_of_joining = $validatedData['date_of_joining'];
        $user->date_of_leaving = $validatedData['date_of_leaving'];
        $user->email = $validatedData['email'];
        $user->username = $validatedData['username'];
        $user->save();

        $user->forceFill([
            'password' => Hash::make($validatedData['password']),
            'remember_token' => Str::random(60),
        ])->save();

        return redirect()->route('employees.index')->with('success','Employee created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show($userId)
    {
        $this->authorize('viewAny',User::class);
        $title = $this->title;
        $user = User::with(['address','bank'])->findOrFail($userId);

        return view('users.show',compact('title','user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $userId)
    {
        $this->authorize('update',User::class);
        $title = $this->title;
        $user = User::findOrFail($userId);
        return view('users.edit',compact('title','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $userId)
    {
        $this->authorize('update',User::class);
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required',
            'employee_code' => 'required|string|unique:users,employee_code,' . $userId,
            'department_id' => 'required',
            'designation_id'=> 'required',
            'user_type_id' => 'required',
            'gender' => 'required|string',
            'blood_group' => 'required|string',
            'nid' => 'required|string',
            'contact_number' => 'required|string',
            'date_of_birth' => 'required|string',
            'date_of_joining' => 'required|string',
            'date_of_leaving' => 'nullable|string',
            'username' => 'required|string',
            'email' => 'required|string|unique:users,email,' . $userId,
        ]);

        $user = User::findOrFail($userId);
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->employee_code = $validatedData['employee_code'];
        $user->department_id = $validatedData['department_id'];
        $user->designation_id = $validatedData['designation_id'];
        $user->user_type_id = $validatedData['user_type_id'];
        $user->gender = $validatedData['gender'];
        $user->blood_group = $validatedData['blood_group'];
        $user->nid = $validatedData['nid'];
        $user->contact_number = $validatedData['contact_number'];
        $user->date_of_birth = $validatedData['date_of_birth'];
        $user->date_of_joining = $validatedData['date_of_joining'];
        $user->date_of_leaving = $validatedData['date_of_leaving'];
        $user->email = $validatedData['email'];
        $user->username = $validatedData['username'];

        if($request->has('image'))
        {
            $user->image = Helper::imageUpload($request->image);
        }

        $user->save();

        if(!empty($request->password))
        {
            $user->forceFill([
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(60),
            ])->save();
        }

        return redirect()->back()->with('success','Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($userId)
    {
        $this->authorize('delete',User::class);
        $record = User::destroy($userId);
        return response()->json(['success' => $record]);

    }

    public function getUserData()
    {
        $this->authorize('viewAny',User::class);
        $query = User::with(['usertype']);

        return DataTables::of($query)
            ->addColumn('usertype',function($user){
                return $user->usertype->name;
            })
            ->addColumn('username',function($user){
                return $user->username;
            })
            ->editColumn('gender',function($user){
                return ucfirst($user->gender);
            })
            ->editColumn('date_of_birth',function($user){
                return date('F j, Y',strtotime($user->date_of_birth));
            })
            ->addColumn('action', function ($user) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item" href="'.route('employees.show', $user->id).'">Show</a>
                                    <a class="dropdown-item" href="'.route('employees.edit', $user->id).'">Edit</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('employees.destroy', $user->id).'" data-id="'.$user->id.'">'.trans('general.delete').'</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action','usertype','gender','date_of_birth'])
            ->make(true);
    }
    public function changeStatus(Request $request, $userId)
    {
        $this->authorize('update',User::class);
        $user = User::findOrFail($userId);

        if($user->status == 'active')
        {
            $user->status = 'inactive';
        }
        else
        {
            $user->status = 'active';
        }
        $user->save();

        return response()->json(['success' => 1]);
    }
    public function updateUserAddress(Request $request, $userId)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'permanent_address' => 'nullable|string',
            'permanent_city' => 'nullable|string',
            'permanent_country' => 'nullable|string',
            'present_address' => 'nullable|string',
            'present_city' => 'nullable|string',
            'present_country' => 'nullable|string',
        ]);

        try
        {
            UserAddress::createOrUpdate($userId, $validatedData);
            return redirect()->route('employees.show', $userId)->with('success', 'Employee address added/updated successfully');
        }
        catch (\Exception $e)
        {
            return response()->back()->with('error' ,'Failed to add/update employee address');
        }
    }

    public function updateEducation(Request $request, $userId)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'education_id' => 'integer',
            'degree_title' => 'required|string',
            'institute_name' => 'required|string',
            'result' => 'required|string',
            'passing_year' => 'required|string',
        ]);

        try
        {
            UserEducation::createOrUpdate($request->education_id, $validatedData);
            return redirect()->route('employees.show', $userId)->with('success', 'Education added/updated successfully');
        }
        catch (\Exception $e)
        {
            return response()->back()->with('error' ,'Failed to add/update education address');
        }
    }


    public function fetchEducation($userId)
    {
        $this->authorize('viewAny',User::class);
        $query = UserEducation::where('user_id', $userId);

        return DataTables::of($query)
            ->addColumn('action', function ($education) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item education-edit" href="#" data-id="'.$education->id.'" data-degree_title="'.$education->degree_title.'" data-institute_name="'.$education->institute_name.'" data-result="'.$education->result.'" data-passing_year="'.$education->passing_year.'">Edit</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('employees.education.destroy', $education->id).'" data-id="'.$education->id.'">Delete</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function educationDelete($educationId)
    {
        $this->authorize('update',User::class);
        $record = UserEducation::destroy($educationId);
        return response()->json(['success' => $record]);
    }

    public function updateExperience(Request $request, $userId)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'company_name' => 'required|string',
            'position' => 'required|string',
            'address' => 'required|string',
            'working_duration' => 'required|string',
        ]);

        try
        {
            UserExperience::createOrUpdate($request->experience_id, $validatedData);
            return redirect()->route('employees.show', $userId)->with('success', 'Experience added/updated successfully');
        }
        catch (\Exception $e)
        {
            return response()->back()->with('error' ,'Failed to add/update experience address');
        }
    }


    public function fetchExperience($userId)
    {
        $this->authorize('viewAny',User::class);
        $query = UserExperience::where('user_id', $userId);

        return DataTables::of($query)
            ->addColumn('action', function ($experience) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item experience-edit" href="#" data-id="'.$experience->id.'" data-company_name="'.$experience->company_name.'" data-position="'.$experience->position.'" data-address="'.$experience->address.'" data-working_duration="'.$experience->working_duration.'">Edit</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('employees.experience.destroy', $experience->id).'" data-id="'.$experience->id.'">Delete</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function experienceDelete($experienceId)
    {
        $this->authorize('update',User::class);
        $record = UserExperience::destroy($experienceId);
        return response()->json(['success' => $record]);
    }

    public function bankAccount(Request $request, $userId)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'bank_holder_name' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'branch_name' => 'nullable|string',
            'bank_account_number' => 'nullable|string',
            'bank_account_type' => 'nullable|string',
        ]);

        try
        {
            UserBankAccount::createOrUpdate($userId, $validatedData);
            return redirect()->route('employees.show', $userId)->with('success', 'Bank account added/updated successfully');
        }
        catch (\Exception $e)
        {
            return response()->back()->with('error' ,'Failed to add/update employee bank account');
        }
    }

    public function fetchDocuments($userId)
    {
        $this->authorize('viewAny',User::class);
        $query = UserDocuments::where('user_id', $userId);

        return DataTables::of($query)
            ->addColumn('action', function ($document) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('employees.document.destroy', $document->id).'" data-id="'.$document->id.'">Delete</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function documentDelete($documentId)
    {
        $this->authorize('update',User::class);
        $record = UserDocuments::destroy($documentId);
        return response()->json(['success' => $record]);
    }

    public function updateDocument(Request $request, $userId)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'file_title' => 'required|string',
            'file' => 'required',
        ]);

        try
        {
            UserDocuments::createOrUpdate($userId, $validatedData);
            return redirect()->route('employees.show', $userId)->with('success', 'Bank account added/updated successfully');
        }
        catch (\Exception $e)
        {
            return response()->back()->with('error' ,'Failed to add/update employee bank account');
        }
    }

    public function getData(Request $request)
    {
        $users = User::select('id', DB::raw('CONCAT(first_name, " ", last_name," - ", employee_code) AS name'));

        if ($request->filled('search'))
        {
            $searchTerm = $request->search;
            $users = $users->where(function ($query) use ($searchTerm) {
                $query->where(DB::raw('CONCAT(first_name, " ", last_name, " - ", employee_code)'), 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $users = $users->get();

        return response()->json(['data' => $users]);

    }
}
