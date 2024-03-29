@extends('admin.layout.main')

{{-- @section('heade')
    <script src={{ asset('ckeditor.js') }}></script>
@endsection --}}

@section('content')
    <form method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Tên Danh Mục</label>
                <input type="text" class="form-control" id="menu" name="name" placeholder="Nhập tên danh mục"
                    value="{{ $menu->name }}">
                @error('name')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Danh Mục </label>
                <select class="form-control" name="parent_id" id="">
                    <option value="0">Danh mục cha</option>

                    @foreach ($menus as $menuParent)
                        <option value="{{ $menuParent->id }}" {{ $menu->parent_id == $menuParent->id ? 'selected' : '' }}>
                            {{ $menuParent->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="des" id="" cols="10" rows="4" class="form-control">{{ $menu->des }}</textarea>
            </div>

            <div class="form-group">
                <label>Mô tả chi tiết</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ $menu->content }}</textarea>
            </div>

            <div class="form-group">
                <label for="">Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="active" name="active" value="1"
                        {{ $menu->active == 1 ? 'checked=""' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                        {{ $menu->active == 0 ? 'checked=""' : '' }}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhập danh mục</button>
        </div>

        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
