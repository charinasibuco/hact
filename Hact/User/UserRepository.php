<?php

namespace Hact\User;


use Hact\Repository;
use App\User;

class UserRepository extends Repository  {

	private $user;

	 function __construct(User $user){

		$this->user = $user;
	}

	public function model()
    {
        //return 'App\User';
    }

	public function create($id)
	{
		# code...
	}


	public function search($string)
	{
		# code...
	}

	/**
	 * Create a new user in the storage.
	 * @param  array $data 
	 * @param  mixed $request 
	 * @return Response       
	 */	
	public function store($data,$request)
	{
		return $this->user->create($data);
	}

	/**
	 * Find user by id.
	 * @param  int $id 
	 * @return mixed     
	 */
	public function find($id)
	{
       return $this->user->where('id', $id)->first();
	}

	public function edit($id)
	{
		// TODO: Implement edit() method.
	}

	/**
	 * Update user credentials.
	 * @param  int $id   
	 * @param  array $data 
	 * @return mixed       
	 */
	public function update($request,$id,$data)
	{
		return $this->user->where('id', $id)->update($data);

	}

	/**
	 * Remove user from the storage.
	 * @param  int $id 
	 * @return mixed     
	 */
	public function destroy($id)
	{
		$user = $this->user->find($id);
        return $user->delete();
	}

	/**
	 * Search user by email or name column.
	 * @param  string $keyword      
	 * @param  string $column_order 
	 * @param  string $column_sort  
	 * @param  int $num_pages    
	 * @return mixed               
	 */
	public function searchUserByEmailOrName($keyword,$column_order,$column_sort,$num_pages)
	{
		 return $this->user->where(
					 				'name', 'LIKE', '%' . $keyword . '%')
					 				->orWhere('email', 'LIKE', '%' . $keyword . '%')
				                    ->orderBy($column_order, $column_sort)
				                    ->paginate($num_pages);

	}

	/**
	 * Sort and paginate results.
	 * @param  string $column_to_order 
	 * @param  string $column_to_sort  
	 * @param  int $num_pages       
	 * @return mixed                  
	 */
	public function orderByAndPaginate($column_to_order,$column_to_sort,$num_pages)	
	{
		return $this->user->orderBy($column_to_order, $column_to_sort)->paginate($num_pages);
	}



}