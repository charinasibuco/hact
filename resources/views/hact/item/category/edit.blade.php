@extends('hact.layouts.layout_admin')

@section('content')
	<form method='post' action="{{ route('item_category_update', $category->id) }}">
		@include('hact.messages.success')
		@include('hact.messages.error_list')
		<div class='row'>
			<div class='large-12 columns'>
				<label>Category Name:
					<input type='text' id='category_name' name='category_name' placeholder='Category Name' value='{{ $category->category_name }}'><br />
				</label>
			</div>
		</div>

		<div class='row'>
			<div class='large-12 columns'>
				<input type='submit' value='submit'><br />
				{!! csrf_field() !!}
			</div>
		</div>

	</form>
@endsection