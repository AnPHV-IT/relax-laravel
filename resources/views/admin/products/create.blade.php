@extends('layouts.admin')

@section('content')
    <div style="
        min-height: calc(100vh - 112px);
    " class="p-4">
        <div style="
            border-radius: 25px
        "
            class="d-flex justify-content-center my-2 p-2 bg-dark text-white">
            <h4>Thêm sản phẩm</h4>
        </div>

        <div>
            <form action="/admin/products/create" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="fw-bold my-2" for="name">Tên sản phẩm</label>
                    <input value="{{ old('name') }}" name="name" type="text" class="form-control" id="name"
                        placeholder="Tên sản phẩm">
                    @error('validate.name')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="fw-bold my-2" for="description">Mô tả</label>
                    <textarea name="description" class="form-control" id="description" rows="20">{{ old('description') }}</textarea>
                    @error('validate.description')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="fw-bold my-2" for="category">Mục sản phẩm</label>
                    <select id="category" name="category" class="form-select" aria-label="Default select example">
                        @foreach($categories as $category)
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endforeach
                        
                    </select>
                    @error('category')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="fw-bold my-2" for="price">Giá</label>
                    <input value="{{ old('price') }}" name="price" type="text" class="form-control" id="price"
                        placeholder="Giá sản phẩm">
                    @error('validate.price')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="fw-bold my-2" for="quantity">Số lượng</label>
                    <input value="{{ old('quantity') }}" name="quantity" type="text" class="form-control" id="quantity"
                        placeholder="Số lượng sản phẩm">
                    @error('validate.quantity')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="fw-bold my-2" for="image">Ảnh sản phẩm</label>
                    <input name="image" type="file" class="form-control" id="image" placeholder="Giá sản phẩm">
                    @error('validate.image')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div id="categories" class="mt-4">
                    <h4>Phân Loại sản phẩm</h4>
                    @foreach (old('categories', ['']) as $index => $value)
                        <div class="form-group category-input">
                            <label class="my-2" for="category_{{ $index }}">Loại
                                {{ $index + 1 }}</label>
                            <input placeholder="Tên Phân Loại" type="text" class="form-control"
                                name="categories[{{ $index }}]" id="category_{{ $index }}"
                                value="{{ old('categories.' . $index, $value) }}" class="form-control">

                            @error('validate.categories.' . $index)
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                            <button style="display: none;" type="button"
                                class="my-2 remove-category btn btn-danger">Xóa</button>

                        </div>
                    @endforeach
                </div>

                <div id="colors" class="mt-4">
                    <h4>Màu Sắc Sản Phẩm</h4>
                    @foreach (old('colors', [['name' => '', 'image' => '']]) as $index => $color)
                        <div class="form-group color-input">
                            <label class="my-2" for="color_{{ $index }}">Màu {{ $index + 1 }}</label>
                            <input placeholder="Tên Màu" type="text" class="form-control"
                                name="colors[{{ $index }}][name]" id="color_{{ $index }}"
                                value="{{ old('colors.' . $index . '.name', $color['name']) }}">

                            @error('validate.colors.' . $index . '.name')
                                <div class="text-danger">The colors name field is required.</div>
                            @enderror

                            <input type="file" class="form-control my-2" name="colors[{{ $index }}][image]"
                                id="color_image_{{ $index }}">

                            @error('validate.colors.' . $index . '.image')
                                <div class="text-danger">The colors image field is required.</div>
                            @enderror

                            <button style="display: none;" type="button"
                                class="my-2 remove-color btn btn-danger">Xóa</button>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-between my-4">
                    <div>
                        <button id="add-category" type="button" class="btn btn-primary">
                            Thêm phân loại
                        </button>
                        <button type="button" id="add-color" class="mx-4 btn btn-primary">Thêm Màu Sắc</button>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">
                            Thêm sản phẩm
                        </button>
                    </div>
                </div>
            </form>
        </div>


        <script src="{{ asset('js/CreateProduct.js') }}"></script>
    </div>
@endsection
