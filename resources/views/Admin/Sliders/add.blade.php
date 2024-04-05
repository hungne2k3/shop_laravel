@extends('admin.layout.main')

@section('content')
    @include('admin.alert')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tiêu đề</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                            placeholder="Nhập tên sản phẩm">
                    </div>

                    @error('name')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Đường dẫn</label>
                        <input type="text" name="url" value="{{ old('url') }}" class="form-control"
                            placeholder="Nhập Đường dẫn">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="menu">Ảnh Sản Phẩm</label>
                <input type="file" class="form-control" id="upload" name="image">
                <div id="image_show">

                </div>
                <input type="hidden" name="file" id="file">

                @error('image')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="menu">Sắp xếp</label>
                <input type="number" name="sort_by" value="{{ old('sort_by') }}" class="form-control">
            </div>

            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        checked="">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active">
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm Slider</button>
        </div>

        @csrf
    </form>
@endsection
