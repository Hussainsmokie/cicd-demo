<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    // public function getDesignData(Request $request)
    // {
    //    // $st_details = Student::get();

    //     $saveStudent = new Student();
    //     // $saveStudent = Student::where('name','Saravana')->first();
    //     $saveStudent->name = (isset($request->name)) ? $request->name : '';
    //     $saveStudent->email = (isset($request->email)) ? $request->email : '';
    //     $saveStudent->mobile = (isset($request->mobile)) ? $request->mobile : '';
    //     $saveStudent->age = (isset($request->mobile)) ? $request->mobile : '';
    //     $saveStudent->save();

    //     $st_details = Student::get();

    //     return response()->json(['data' => $st_details]);
    // }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([  
                'name'=>'required',  
                'email'=>'required',  
                'mobile'=>'required',  
                'age'=>'required',  
            ]);  

            $new_user = new Student();  
            $new_user->name =  $validated['name'];  
            $new_user->email =  $validated['email']; 
            $new_user->mobile =  $validated['mobile']; 
            $new_user->age =  $validated['age']; 
            $new_user->save(); 

            return response()->json([
                'status' => true,
                'message' => 'New User added successfully',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 200);
        } catch (\Throwable $th) {
            // Handle other errors
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while adding the lead',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function get_users(Request $request)
    {
        try {
            $users = Student::get();
            return response()->json([
                                    'status' => true,
                                    'data' => $users
                                ],200);
        } catch (\Throwable $th) {
            // Handle other errors
            return response()->json([
                'status' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function edit_users($id)
    {
        try {
            $users = Student::where('id',$id)->first();
            return response()->json([
                                    'status' => true,
                                    'data' => $users
                                ],200);
        } catch (\Throwable $th) {
            // Handle other errors
            return response()->json([
                'status' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function update_user(Request $request, $id)
    {
        try {
            $name = $request->name;
            $email = $request->email;
            $mobile = $request->mobile;
            $age = $request->age;

            $new_user = Student::where('id',$id)->first();  
            $new_user['name'] =  $name;  
            $new_user['email'] =  $email; 
            $new_user['mobile']=  $mobile; 
            $new_user['age'] =  $age; 
            $new_user->save(); 

            return response()->json([
                'status' => true,
                'message' => 'User Updated added successfully',
            ],200);
        } catch (\Throwable $th) {
            // Handle other errors
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while adding the lead',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function delete_user($id)
    {
        try {
            $users = Student::where('id',$id)->delete();
            return response()->json([
                                    'status' => true,
                                    'message' => 'User Deleted successfully'
                                ],200);
        } catch (\Throwable $th) {
            // Handle other errors
            return response()->json([
                'status' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
