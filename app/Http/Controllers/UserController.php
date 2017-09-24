<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

use App\ActivityLog;
use Auth;
use Mail;
use Hact\User\UserRepository;


class UserController extends Controller
{
    private $user;
    private $log;

    function __construct(UserRepository $user,ActivityLog $log){

        $this->user = $user;
        $this->log = $log;
    }

    public function index(Request $request)
    {
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
        $nop        = 50;
        $search     = '';
        $order_by   = $this->order_by($request);
        $sort       = $this->sort($request);


        if($request->has('search'))
        {
            $search = trim($request->input('search'));

            $users = $this->user->searchUserByEmailOrName($search,$order_by,$sort,$nop);

           
        }
        else
        {
            $users = $this->user->orderByAndPaginate($order_by,$sort,$nop);
        }

        $name_sort      = $this->link_sort('name', $search, $sort, $request);
        $email_sort     = $this->link_sort('email', $search, $sort, $request);
        $access_sort    = $this->link_sort('access', $search, $sort, $request);
        $pagination     = ['search' => $search, 'order_by' => $order_by, 'sort' => $sort];

        $data = compact(
                'users', 'search',
                'name_sort', 'email_sort', 'access_sort', 'pagination'
            );

        return view('hact.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
        $action = route('user_store');
        $page   = 'New';
        $email  = old('email');
        $name   = old('name');
        $contact_number = old('contact_number');
        $access = old('access');
        $active = old('active');

        $data = compact( 'action', 'page', 'email', 'name', 'contact_number', 'access', 'active');

        return view('hact.user.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UserStoreRequest $request)
    {
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
        // user params
        $data = array(
                        'name'          => $request->name,
                        'email'         => $request->email,
                        'contact_number'=> $request->contact_number,
                        'access'        => $request->access,
                        'active'        => $request->active
                    );

        $this->user->store($data,$request);


        $this->log->create([

                'page' => 'User', 
                'message' => $request->name . ' has been created!', 
                'user_id' => Auth::user()->id

            ]);

        return redirect()->route('user_create')->with('status', 'User successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
        $action = route('user_update', $id);
        $page   = 'Edit';
        $user = $this->user->find($id);
        
        $email  = $user->email;
        $name   = $user->name;
        $contact_number = $user->contact_number;
        $access = $user->access;
        $active = $user->active;

        $data = compact( 'action', 'id', 'page', 'email', 'name', 'contact_number', 'access', 'active');

        return view('hact.user.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UserUpdateRequest $request, $id)
    {
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
        User::where('id', $id)->update([
            'email'     => $request->email,
            'name'      => $request->name,
            'contact_number' => $request->contact_number,
            'access'    => $request->access,
            'active'    => $request->active
        ]);

        ActivityLog::create([
                'page' => 'User', 
                'message' => $request->name . ' has been updated!', 
                'user_id' => Auth::user()->id
            ]);

        return redirect()->route('user_edit', $id)->with('status', 'User successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
        return $this->user->delete($id);
    }

    public function password_reset(Request $request, $id)
    {
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
        $data = [];
        $password   = str_random(15);
        $user = User::where('id', $id)->first();

        $data['password']   = $password;
        $input['password']  = bcrypt($password);
        $input['reset']     = 1;

        User::where('id', $id)->update( $input );

        $data = [
                    'name'  => $user->name,
                    'email' => $user->email,
                    'password'  => $password
                ];

        /*Mail::send('hact.emails.password_reset', $data, function ($mail) use ($user) {
            $mail->from( 'admin@hactbacolod.com', 'HACT Bacolod' );
            $mail->to( $user->email, $user->name );
            $mail->subject( 'HACT Bacolod - Password Reset!' );
        });*/

        return response()->json($data);
    }

    public function password_edit()
    {
        $action = route('user_password_update');
        $password = old('password');
        $confirm_password = old('confirm_password');

        $data = compact( 'action' );

        return view('hact.user.password_reset', $data);
    }

    public function password_update(Requests\UserPasswordResetRequest $request)
    {
        $input['password']  = bcrypt($request->password);
        $input['reset']     = 0;

        User::where('id', Auth::user()->id)->update( $input );

        return redirect()->route('logout')->with('status', 'Password successfully reset!');
    }

    /**
    **Called Functions
    **/
    public function order_by($request)
    {
        if($request->has('order_by'))
        {
            $order_by = trim($request->has('order_by'));

            if($order_by == 'name')
            {
                return 'name';
            }
            elseif($order_by == 'email')
            {
                return 'email';
            }
            elseif($order_by == 'access')
            {
                return 'access';
            }
            else
            {
                return 'name';
            }
        }
        else
        {
            return 'name';
        }
    }

    public function sort($request)
    {

        if($request->has('sort'))
        {
            $sort = $request->input('sort');

            if($sort == 'ASC')
            {
                return 'ASC';
            }
            elseif($sort == 'DESC')
            {
                return 'DESC';
            }
        }
        else
        {
            return 'ASC';
        }
    }

    public function link_sort($order_by, $search, $sort, $request)
    {
        $sort  = ($sort == 'DESC')? 'ASC' : 'DESC';

        if($request->has('page'))
        {
            return route('user', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort, 'page' => $request->input('page')]);
        }
        else
        {
            return route('user', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort]);
        }
    }
}
