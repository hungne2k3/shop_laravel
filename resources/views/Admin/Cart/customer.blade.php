@extends('admin.layout.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px">ID</th>
                <th>Tên khách hàng</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Ngày đặt hàng</th>
                <th>&nbsp;</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($customers as $key => $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->created_at }}</td>
                    <td>
                        <a class="btn btn-warning" href="/admin/customer/view/{{ $customer->id }}"><i class="fas fa-eye"></i>
                            Xem</a>

                        <a class="btn btn-danger" href="#"
                            onclick="removeRow({{ $customer->id }}, '/admin/customer/delete')"><i class="fas fa-trash"
                                style="padding-right: 4px"></i>Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="card-footer clearfix">
        {!! $customers->links() !!}
    </div>
@endsection
