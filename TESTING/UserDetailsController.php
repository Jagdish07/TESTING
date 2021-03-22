<?php

namespace App\Http\Controllers\Front;

use Auth;
use Hash;
use App\Http\Requests;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CommonsController;
use App\Models\Favourite;

use App\Post;
use App\Models\Link;
use App\Models\Notification;
use Illuminate\Http\Request;
use DB; 
use Mail;
use Socialite;

class UserDetailsController extends CommonsController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
      if (!empty(Auth::user())) {
        $user = User::where(['id'=> Auth::user()->id])->first();
        //Role: 1=>User(Customer), 2=>Business
        if (Auth::user()->role == 2) {

          //Code for business_user
          return view('front.pages.user_details', compact('user'));
        }elseif (Auth::user()->role == 1) {

          //Code for customer
          return view('front.pages.user_details', compact('user'));
        }
      }

      return redirect('/');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit($id = '')
    {
      if (!empty(Auth::user())) {

          $joson_url =  url('/states_hash.json');
        $jsonData = json_decode(file_get_contents($joson_url));
       // echo '<pre>'; print_r($jsonData); die; 
        $data = User::where(['id' => Auth::user()->id])->first();
        return view('front.pages.update_user', compact('data','jsonData'));
      }
      
      return redirect('/');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function update(Request $request, $id)
    {
      $data = User::findOrFail(Auth::user()->id);

      $image_name = '';
      if($request->file('userImage')){

        $image_name = $this->uploadS3Data($request->file('userImage'), 'users');
      } else {
        $image_name = $data->profileImage;
      }

      $requestData['first_name'] = $request['first_name'];
      $requestData['last_name'] = $request['last_name'];
      $requestData['email'] = $request['email'];
      $requestData['phone'] = $request['phone'];
      $requestData['location'] = $request['address'];
      $requestData['zip'] = $request['zip'];
      $requestData['city'] = $request['city'];
      $requestData['state'] = $request['state'];
      $requestData['profileImage'] = @$image_name;

      $update = User::where(['id' => Auth::user()->id])->update($requestData);

      if ($update) {

        return redirect('/userDetails');
      }else{

        return redirect('/userDetails');
      }
    }

    public function show($value='')
    {
      dd($value);
    }

    public function changePassword(Request $request) {

      return view('front.pages.change_password');
    }

    public function checkPasswordMatch(Request $request)
    {
      $user = User::where(['id'=> Auth::user()->id])->first();
      $check_password = Hash::check(@$request->old_password, @$user->password);
      
      if (!empty($user->social_id) && empty($user->password)) {
        echo 'true';
        die;
      } elseif ($check_password == false) {
        echo 'false';
        die;
      }else{
        echo 'true';
        die;
      }
    }

    public function checkEmailExists(Request $request)
    {

      $user = User::where(['email' => $request->forgot_email])->first();
      if (!empty($user)) {
        echo 'true';
        die;
      }else{
        echo 'false';
        die;
      }
    }

    public function changeEmailNotification(Request $request)
    {
      $user = User::where(['id'=> Auth::user()->id])->first();

      $update = User::where(['id' => Auth::user()->id])->update(['email_notification' => @$request->status]);

      if ($update) {
        echo true;
        die;
      }else{
        echo true;
        die;
      }
    }

    /**
     * Get Notifiation Count
     *
     * @param  user_id
     * @return response
     * @param //Notification Type: 1->friends_activity, 2->reviews_activity, 3->friends_request, 4->photo_activity
     */
    public function userNotification(Request $request)
    {
      if (!empty(Auth::user())) {
        $data = User::where(['id' => Auth::user()->id])->first();

        $friends_activity = $this->getNotifyList(Auth::user()->id, 1);
        $reviews_activity = $this->getNotifyList(Auth::user()->id, 2);
        $friend_request = $this->getNotifyList(Auth::user()->id, 3);
//echo '<pre>'; print_r($friend_request); die; 
        return view('front.pages.user_notifications', compact('reviews_activity', 'friends_activity', 'friend_request'));
      }
      
      return redirect('/userDetails');
    }

    /**
     * Get Notify List
     *
     * @param  user_id
     * @return response
     * @param //Notification Type: 1->friends_activity, 2->reviews_activity, 3->friends_request, 4->photo_activity
     */
    public function getNotifyList($user_id = '', $type = '') {
      $result = [];
      $result = Notification::where(['receiver_id' => $user_id]);

      if ($type == 1) {

        $result->where(['receiver_id'=>$user_id, 'type'=>2])
        ->orWhere(function($query) use ($user_id) {
          $query->where(['receiver_id'=>$user_id, 'type'=>3]);
        });
      }elseif ($type == 2) {

        $result->where(['type'=> 4]);
      }elseif ($type == 3) {

        $result->where(['type'=> 1]);
       
      } else {

        $result->where(['type' => 0]);
      }
      $results = $result->get();


      $response = [];
      foreach ($results as $key => $value) {

        $response[] = [
          'sender_id'       => (string) @$value->sender_id,
          'sender_name'     =>  @$this->getUserName(@$value->sender_id),
          'sender_profile'  => @$this->getUserProfile(@$value->sender_id),
          'notification_title'  => (string) @$value->title,
          'notification_message'  => (string) @$value->message,
          'created_date'  => (string) @$value->created_at,

        ];
      }

      return @$response;
    }

    public function inbox(Request $request)
    {
      if (!empty(Auth::user())) {
        $data = User::where(['id' => Auth::user()->id])->first();
        
        return view('front.pages.inbox', compact('data'));
      }
      
      return redirect('/userDetails');
    }

    public function updatePassword(Request $request) {

      if (!empty(Auth::user())) {
        if (!empty($request->confirm_password)) {

          $new_password = password_hash(@$request->confirm_password, PASSWORD_DEFAULT);

          $update = User::where(['id' => Auth::user()->id])->update(['password' => $new_password]);

          //$sql = 'update users set password="'.$new_password.'" where id = '.Auth::user()->id;
          //$update = DB::update($sql); 
         // Auth::login($update);
          if ($update) {
            return back()->with('success','Item created successfully!');
            ///return redirect('/changePassword');
          }
        }
      }

      return redirect('/');
    }
    

    public function forgotPassword(Request $request)  {

      $userinfo =  User::where('email',strtolower($request->forgot_email))->first(); 

    // attempt to do the login
      if ($userinfo) {

        $pool = 'abcdefghijklmnopqrstuvwxyz0123456789';

        $verify_token = sha1(substr(str_shuffle(str_repeat($pool, 8)), 0, 8));

        $userinfo->remember_token = (string) $verify_token;
        if($userinfo->save()){

          $pass_url = url('/auth/resetPass?user='.$userinfo->id.'&usertoken='.$verify_token);

          $send = Mail::send('emails.forgot_password', ['username' => ($userinfo->first_name) ? $userinfo->first_name : 'User', 'pass_url'=>$pass_url], function ($m) use ($userinfo) {
            $m->from('no-reply@imarkinfotech.com', 'Thriftshopper');

            $m->to($userinfo->email, $userinfo->first_name)->subject('Thriftshopper : Reset Password');
          });

          return redirect('/');
        } else {

          return redirect('/');
        }

      }

    }


    public function userLogout()
    {
      Auth::guard('web')->logout();
      return redirect('/');
    }

    public function userProfile($id) { 
         $sql  =  'SELECT count(r.id) as reviewcount , count(ri.id) as reviewImagecount,u.first_name, u.last_name,u.profileImage, (select count(id) from user_relationships where (first_user_id = r.user_id || second_user_id = r.user_id ) && status = 2) as friendcounts from reviews as r LEFT JOIN review_images as ri on r.id = ri.review_id LEFT JOIN users as u on r.user_id=  u.id  WHERE r.user_id = '. $id; 
      	$result_data =  DB::select($sql);

      	$sql_query  = 'select r.user_id, r.store_id, r.comments,((r.selection+ r.pricing+ r.organisation + r.customer_service+ r.customer_service)/5) as rattingavg , ri.name , s.storeName , s.storeCity, s.storeStreet, s.storeZip from reviews as r LEFT JOIN review_images as ri on r.id = ri.review_id LEFT join stores as s  on r.store_id = s.id   where r.user_id = '. $id;

      	$comment_data =  DB::select($sql_query);

      	return view('front.pages.userprofile', compact('result_data', 'comment_data','id'));
    }

    static public function getBannerImage($request = '')
    {
      if ($request == 'contact') {

        return 'banner-img.jpg';
      }else{

        return 'banner-img.jpg';
      }
    }

    public function addfriendList() {
      $first_user_id =  Auth::user()->id;
      $seceond_friend_id =  $_REQUEST['seceond_friend_id']; 
      $status = $_REQUEST['status'];

      $data['first_user_id'] =  $first_user_id;
      $data['second_user_id'] =  $seceond_friend_id;
      if($status == 1) {
         $data['status'] =  '1';
           $insert =  DB::table('user_relationships')->insert($data);
             $login_user =  User::where(['id' => Auth::user()->id, 'role'=> 1])->first();
             $sender =  User::where(['id' => $seceond_friend_id , 'role'=> 1])->first();
              $sender_name = @$login_user->first_name .' '. @$login_user->last_name;
              $send_notification = $this->sendNotification($sender, ['title'=>'Freind  Request', 'body'=> $sender_name.' want to be your friend .', 'value'=>'', 'type'=>1], $login_user->id);
        if($insert) {
          return '1';
        } else  { return '2';}

      } else  {

        $sql = 'delete from user_relationships where first_user_id = '.  $first_user_id .' and second_user_id ='.$seceond_friend_id;
        DB::delete($sql); 
        return '1'; 
      }

    }


    public function favrstore() {
     $sql = 'SELECT  s.* from stores s inner join favourite_stores f on s.id =    f.store_id where f.user_id = ' . Auth::user()->id;
      $store_data =   DB::SELECT($sql);

      return view('front.pages.user_fav_store', compact('store_data'));
      
    }


  }