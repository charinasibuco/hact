<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hact\Log\ActivityLogRepository as ActivityLog;
use Auth;

class ActivityLogController extends Controller
{

    private $log;

    public function __construct(ActivityLog $log)
    {
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
        $this->log = $log;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = '';
        $paginate = 50;
        $order_by   = $this->order_by($request);
        $sort       = $this->sort($request);

        $query = $this->log->getLogs();

        if($request->has('search'))
        {
            $search = trim($request->input('search'));

            $logs = $query->where(function($query) use ($search) {
                            $query->where('page', 'LIKE', '%' . $search . '%')
                            ->orWhere('message', 'LIKE', '%' . $search . '%')
                            ->orWhere('users.name', 'LIKE', '%' . $search . '%');
                        })
                        ->orderBy($order_by, $sort)->paginate($paginate);
        }
        else
        {
            $logs = $query->orderBy($order_by, $sort)->paginate($paginate);
        }


        $page_sort      = $this->link_sort('page', $search, $sort, $request);
        $message_sort   = $this->link_sort('message', $search, $sort, $request);
        $user_sort      = $this->link_sort('user_id', $search, $sort, $request);
        $date_sort      = $this->link_sort('created_at', $search, $sort, $request);
        $pagination         = ['search' => $search, 'order_by' => $order_by, 'sort' => $sort];

        $data = compact('logs', 'search', 'page_sort','message_sort','user_sort','date_sort');
        return view('hact.activity_log.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function order_by($request)
    {
        if($request->has('order_by'))
        {
            $order_by = trim($request->order_by);

            if($order_by == 'page')
            {
                return 'page';
            }
            elseif($order_by == 'message')
            {
                return 'message';
            }
            elseif($order_by == 'user_id')
            {
                return 'user_id';
            }
            elseif($order_by == 'created_at')
            {
                return 'created_at';
            }
            else
            {
                return 'created_at';
            }
        }
        else
        {
            return 'created_at';
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
            return 'DESC';
        }
    }

    public function link_sort($order_by, $search, $sort, $request)
    {
        $sort  = ($sort == 'DESC')? 'ASC' : 'DESC';

        if($request->has('page'))
        {
            return route('activity_log', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort, 'page' => $request->input('page')]);
        }
        else
        {
            return route('activity_log', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort]);
        }
    }

   

    
}
