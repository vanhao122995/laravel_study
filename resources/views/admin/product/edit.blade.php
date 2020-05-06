@extends('admin.main')

@section('content')
<?php
    $prefix         = 'product';
    $name_item      = 'sản phẩm';
    $link_image     = url("uploads/admin/{$prefix}");
?>
<div class="products">
    <form action="{{ url("admin/{$prefix}/edit") }}" method="POST" enctype="multipart/form-data">
        <div class="panel-action">
            <div class="row">
                <div class="products-act">
                    <div class="col-md-4 col-md-offset-2">
                        <div class="left-action text-left clearfix">
                            <h2><i class="fa fa-refresh" style="font-size: 14px; cursor: pointer;"></i>{{ $title }}</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right-action text-right">
                            <div class="btn-groups">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Lưu</button>
                                <a href="{{ url("admin/{$prefix}") }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Trở về</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-space customer"></div>

        <div class="products-content" style="margin-bottom: 25px;">
            <div class="basic-info">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            {{-- @if(count($errors)>0)
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach()
                                </div>
                            @endif --}}
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" value="{{ $item->id }}" />
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Danh mục {{ $name_item }}</label>
                            <select name="category_id" class="form-control">                              
                                <?php $category = DB::table('category')->select('id', 'name')->get() ?>
                                @if(isset($category))
                                    @forEach($category as $row)
                                        <option value="{{$row->id }}">{{ $row->name }}</option>
                                    @endForeach
                                @endIf
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" name="name" value="{{ old('name', $item->name) }}" id="prd_name" value="" class="form-control" placeholder="Nhập tên {{ $name_item }}" />                          
                            @error('name')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" value="{{ old('title', $item->title) }}" id="title" value="" class="form-control" placeholder="Nhập title {{ $name_item }}" />                          
                            @error('title')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Giá {{ $name_item }}</label>
                            <input type="text" name="price" value="{{ old('price', $item->price) }}" id="price" value="" class="form-control" placeholder="Nhập giá {{ $name_item }} vd: 100000" />                          
                            @error('price')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Giá {{ $name_item }} sau khi giảm</label>
                            <input type="text" name="sale_price" value="{{ old('sale_price', $item->sale_price) }}" id="sale_price" value="" class="form-control" placeholder="Nhập giá {{ $name_item }} sau khi đã khuyến mãi  vd: 90000" />                          
                            @error('sale_price')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Chi tiết {{ $name_item }}</label>
                            <textarea type="text" name="description" id="description" value="" class="form-control" placeholder="Nhập chi tiết {{ $name_item }}">{{ old('description', $item->description) }}</textarea>                          
                            @error('description')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Chọn hình {{ $name_item }}</label>
                            <input type="file" name="image" />                      
                            @error('image')
                                <p class="error">{{ $message }}</p>
                            @enderror
                            @if($item->image)
                                <div>
                                    <img src="{{ $link_image . '/' . $item->image }}" style="width: 100px; height:100px;"/>
                                </div>
                            @endIf
                        </div>
                    </div>
                </div>
            </div>          
        </div>
    </form>
</div>
@endsection