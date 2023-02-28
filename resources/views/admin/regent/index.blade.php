@extends('layouts.main')

@section('css')
@endsection

@section('title')
Danh sách nhân sự điều hành
@endsection


@section('buttons')

@endsection


@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<table id="table-list">
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
	new DATATABLE('table-list', {
		ajax: {
			url: '{!! route('regent.searchData') !!}',
			data: function (d, context) {
				DATATABLE.mergeSearch(d, context);
			}
		},
		columns: [
			{data: 'DT_RowIndex', orderable: false, title: "STT"},
            {data: 'image', title: 'Ảnh đại diện'},
            {data: 'full_name', title: "Họ tên"},
			{data: 'phone_number', title: "Số điện thoại"},
			{data: 'email', title: "Email"},
			{data: 'created_at', title: "Ngày tạo"},
			{data: 'action', orderable: false, title: "Hành động"}
		],
		search_columns: [
			{data: "name", search_type: "text", placeholder: "Họ tên"},
			{data: "email", search_type: "text", placeholder: "Email"},

		],
		create_link: "{{ route('regent.create') }}"
	});

</script>
@include('partial.confirm')
@endsection
