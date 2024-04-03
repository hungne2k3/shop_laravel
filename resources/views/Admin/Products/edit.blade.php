@extends('admin.layout.main')

{{-- @section('heade')
    <script src={{ asset('ckeditor.js') }}></script>
@endsection --}}

@section('content')
    @include('admin.alert')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tên Sản Phẩm</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control"
                            placeholder="Nhập tên sản phẩm">
                    </div>

                    @error('name')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Danh Mục</label>
                        <select class="form-control" name="menu_id">
                            {{-- Nếu chạy mà trùng với id của menu_id với $product->menu_id thì sẽ selected hoặc để trống --}}

                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}" {{ $product->menu_id == $menu->id ? 'selected' : '' }}>
                                    {{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Giá Gốc</label>
                        <input type="number" name="price" value="{{ old('price') }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Giá Giảm</label>
                        <input type="number" name="price_sale" value="{{ old('price_sale') }}" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Mô Tả </label>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label>Mô Tả Chi Tiết</label>
                <textarea name="content" id="content" class="form-control">{{ $product->content }}</textarea>
            </div>

            <div class="form-group">
                <label for="menu">Ảnh Sản Phẩm</label>
                <input type="file" class="form-control" id="upload" name="image">

                <div id="image_show">
                    <a href="{{ $product->file }}" target="_blank">
                        <img src="{{ $product->file }}" width="100px" alt="">
                    </a>
                </div>
                <input type="hidden" value="{{ $product->file }}" name="file" id="file">

                @error('image')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{ $product->active == 1 ? 'checked=""' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                        {{ $product->active == 0 ? 'checked=""' : '' }}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhập Sản Phẩm</button>
        </div>

        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
