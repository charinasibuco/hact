<?php

namespace Hact\User;

interface UserInterface {

	
	public function create($data);

	public function findUser($id);

	public function updateUser($id,$data);

	public function removeUser($id);

	public function searchUserByEmailOrName($keyword,$column_order,$column_sort,$num_pages);

	public function orderByAndPaginate($column_to_order,$column_to_sort,$num_pages);

}