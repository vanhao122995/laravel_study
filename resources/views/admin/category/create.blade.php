@extends('admin.main')

@section('content')
<?php
    $prefix = 'category';
    $name_item   = 'danh mục sản phẩm';
?>
<div class="products">
    <form action="{{ url("admin/{$prefix}/store") }}" method="POST" multipart/form-data>
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
                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" name="name" value="{{ old('name') }}" id="prd_name" value="" class="form-control" placeholder="Nhập tên {{ $name_item }}" />                          
                            @error('name')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>          
        </div>
    </form>
</div>
@endsection