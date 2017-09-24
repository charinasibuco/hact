<?php

namespace Hact\Log;

use Hact\Repository;
use App\ActivityLog;

class ActivityLogRepository extends Repository {

	private $log;		

	public function __construct(ActivityLog $log)
	{
		$this->log = $log;	
	}

	/**
	 * Return all logs on the index page
	 * @param  array $tables  
	 * @param  array $columns 
	 * @return object          
	 */
	public function getLogs()
	{
		return $this->log
						->leftJoin('users','users.id','=','activity_log.user_id')
                        ->select('activity_log.*','users.name');
	}

	public function model()
	{
		# code...
	}

	public function create($id)
	{
		
	}

	public function store($data,$request)		
	{
		return $this->log->create($data);
	}

	public function update($request,$id,$data)
	{
		
	}
	public function edit($id)
	{
		
	}
	public function destroy($id)
	{
		
	}

	public function search($string)
	{
		# code...
	}

	public function find($id)
	{
		# code...
	}


}