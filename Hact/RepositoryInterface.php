<?php

namespace Hact;

interface RepositoryInterface
{

	public function find($id);

    public function create($id);

    public function store($input, $request);

    public function edit($id);

    public function update($request, $id, $input);

    public function destroy($id);

    public function search($string);

}