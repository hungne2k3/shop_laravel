@extends('admin.layout.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px">ID</th>
                <th>Tiêu đề</th>
                <th>Link</th>
                <th>Ảnh</th>
                {{-- <th>Sắp xếp</th> --}}
                <th>Trạng thái</th>
                <th>Cập nhập</th>
                <th>&nbsp;</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($sliders as $key => $slider)
                <tr>
                    <td>{{ $slider->id }}</td>
                    <td>{{ $slider->name }}</td>
                    <td>{{ $slider->url }}</td>
                    <td>
                        <a href="{{ $slider->file }}" target="_blank">
                            <img src="{{ $slider->file }}" alt="" height="40px">
                        </a>
                    </td>
                    <td>{!! \App\Helpers\Helper::active($slider->active) !!}</td>
                    <td>{{ $slider->updated_at }}</td>
                    <td>
                        <a class="btn btn-warning" href="/admin/sliders/edit/{{ $slider->id }}"><i class="fas fa-edit"></i>
                            Edit</a>

                        <a class="btn btn-danger" href="#"
                            onclick="removeRow({{ $slider->id }}, '/admin/sliders/delete')"><i class="fas fa-trash"
                                style="padding-right: 4px"></i>Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $sliders->links() }}
@endsection
