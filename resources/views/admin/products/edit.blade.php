@extends('layouts.admin')

@section('content')
    <div style="min-height: calc(100vh - 112px);" class="p-4">
        <div style="border-radius: 25px" class="d-flex justify-content-center my-2 p-2 bg-dark text-white">
            <h4>Chỉnh sửa sản phẩm</h4>
        </div>

        @foreach ($product->colors as $color)
            <form class="d-none" action="/admin/products/{{ $product->id }}/colors/{{ $color->id }}/delete" method="POST">
                @csrf
                @method('DELETE')
                <input id="remove-color-{{ $color->id }}" type="submit">
            </form>
        @endforeach

        <div>
            <form action="/admin/products/{{ $product->id }}/update" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="fw-bold my-2" for="name">Tên sản phẩm</label>
                    <input value="{{ old('name', $product->name) }}" name="name" type="text" class="form-control"
                        id="name" placeholder="Tên sản phẩm">
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="fw-bold my-2" for="description">Mô tả</label>
                    <textarea name="description" class="form-control" id="description" rows="20">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="fw-bold my-2" for="category">Mục sản phẩm</label>
                    <select id="category" name="category" class="form-select" aria-label="Default select example">
                        @foreach ($categories as $category)
                            <option value="{{ $category->name }}" >{{ $category->name }}</option>
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
                    <input value="{{ old('price', $product->price) }}" name="price" type="text" class="form-control"
                        id="price" placeholder="Giá sản phẩm">
                    @error('price')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="fw-bold my-2" for="quantity">Số lượng</label>
                    <input value="{{ old('quantity', $product->quantity) }}" name="quantity" type="text"
                        class="form-control" id="quantity" placeholder="Số lượng sản phẩm">
                    @error('quantity')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="fw-bold my-2" for="image">Ảnh sản phẩm</label>
                    <input name="image" type="file" class="form-control" id="image">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" width="100" class="my-2">
                    @error('image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>



                <div id="colors" class="mt-4">
                    <h4>Màu sắc sản phẩm</h4>
                    @foreach ($product->colors as $color)
                        <div class="form-group color-input">
                            <label class="fw-bold my-2">Màu {{ $color->name }}</label>
                            <input placeholder="Tên Màu" type="text" class="form-control"
                                name="colors[{{ $color->id }}][name]"
                                value="{{ old('colors.' . $color->id . '.name', $color->name) }}">

                            <input type="file" class="form-control my-2" name="colors[{{ $color->id }}][image]">
                            @if ($color->imageUrl)
                                <img src="{{ $color->imageUrl }}" alt="{{ $color->name }}" width="100"
                                    class="my-2">
                            @endif

                            <input type="hidden" name="colors[{{ $color->id }}][id]" value="{{ $color->id }}">
                            <label for="remove-color-{{ $color->id }}"
                                class="my-2 remove-color btn btn-danger">Xóa</label>

                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-between my-4">
                    <div>
                        <button type="button" id="add-color" class="mx-4 btn btn-primary">Thêm Màu Sắc</button>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                    </div>
                </div>
            </form>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const addColorButton = document.getElementById('add-color');
                const colorsContainer = document.getElementById('colors');

                let colorIndex = {{ count($product->colors) }};

                addColorButton.addEventListener('click', () => {
                    const colorDiv = document.createElement('div');
                    colorDiv.className = 'form-group color-input';
                    colorDiv.innerHTML = `
                    <label class="my-2">Màu</label>
                    <input placeholder="Tên Màu" type="text" class="form-control"
                        name="colors[${colorIndex}][name]">
                    <input type="file" class="form-control my-2" name="colors[${colorIndex}][image]">
                    <button type="button" class="my-2 remove-color btn btn-danger">Xóa</button>
                `;

                    colorsContainer.appendChild(colorDiv);
                    colorIndex++;


                    const removeColorButton = colorDiv.querySelector('.remove-color');
                    removeColorButton.addEventListener('click', () => {
                        colorsContainer.removeChild(colorDiv);
                    });
                });
            });

        </script>
    </div>
@endsection
