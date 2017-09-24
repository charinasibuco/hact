@extends('hact.layouts.layout_admin')

@section('content')
	<div class='row'>
		<div class='large-4 columns'>
			<input type='search' id='category_search' name='category_search'>
		</div>

		<div class='large-4 columns'>
		</div>

		<div class='large-4 columns'>
		</div>
		
	</div>
	<div class='row'>
		<div class='large-12 columns'>
		@include('hact.messages.success')
		@include('hact.messages.error_list')
			<table>
				<tr>
					<th>Category Name</th>
					<th>Action</th>
				</tr>
				@foreach($categories as $category)
					<tr>
						<td>{{ $category->category_name }}</td>
						<td><a href="{{ route('item_category_edit',$category->id) }}">edit</a></td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>
@endsection