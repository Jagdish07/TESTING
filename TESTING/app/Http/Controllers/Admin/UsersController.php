<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\admin\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use File;
use DB;
class UsersController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request){
        $user = Users::all();
        return view('admin.users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(){
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request){
        $requestData = $request->all();
        if(!empty($request->file('profile_pic'))){
          $file = $request->file('profile_pic');
          $imagename = time().'.'.$file->getClientOriginalExtension();
          $destinationPath = public_path('/images/users');
          $file->move($destinationPath, $imagename);
        } else{
          $imagename = "";
        }
        $requestData['profile_pic'] = $imagename;
        $insert_data = Users::create($requestData);
        return redirect('users')->with('flash_message', 'User Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id){
        $user = Users::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id){
        $user = Users::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        if(!empty($request->file('profile_pic'))){

            $check_image_exists = Users::where('id',$id)->get();
            if(!empty($check_image_exists[0]['profile_pic'])){
                $image_path = "/images/users".$check_image_exists[0]['profile_pic'];
                if(File::exists(public_path($image_path))) {
                    File::delete(public_path($image_path));
                }
            }

            $image = $request->file('profile_pic');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $thumbnailpath = public_path('/images/users/thumbnailpath/');
            $actutal = public_path('/images/users/thumbnailpath/');

            $thumbnailpath = public_path($actutal.$filenametostore);
            $img = Image::make($thumbnailpath)->resize(64, 64, function($constraint) {
                $constraint->aspectRatio();


            $image->move($destinationPath, $input['imagename']);

            $update = DB::table('users')->where('id',$id)->update(['profile_pic' => $input['imagename']]);
        }
        return redirect('users')->with('flash_message', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id){
        Users::destroy($id);
        return redirect('users')->with('flash_message', 'User deleted!');
    }

    public function banauser(Request $request){
        $id = $request->input('id');
        $change_status = Users::where('id',$id)->update(['status' => 0]);
        echo $change_status;
    }

    public function addmanualpoints(Request $request){
//        dd($request->input('user_id'));
        $user_id = $request->input('user_id');
        $points_to_added = $request->input('points_number');
        $expry_date = Carbon::now()->addMonth(2);

        //get USER DATA
        $user_data = Users::find($user_id);

        //SEND Email
        $data_client = [
            'user_name'	=> $user_data->username,
            'point_type'	=> 'Bonus',
            'points_alloted' =>  $points_to_added,
            'points_expiry' => $expry_date
        ];

        Mail::to('joaosjc@hotmail.com')->queue(new PointsApproved($data_client));

        // Add points
        $addPoints = new PointsClaimed;
        $addPoints->user_id = $user_id;
        $addPoints->type = 'Bonus';
        $addPoints->points_claimed = $points_to_added;
        $addPoints->expires_on = $expry_date;
        $addPoints->status = 1;
        $addPoints->save();
        return redirect('users')->with('flash_message', 'Points Added!');
    }
}
