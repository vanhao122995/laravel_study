@extends('admin.main')

@section('content')
<?php
    $prefix = 'order';
    $name_item = 'đơn hàng';
?>
<div class="products">
    <div class="panel-action">
        <div class="row">
            <div class="products-act">
                <div class="col-md-4 col-md-offset-2">
                    <div class="left-action text-left clearfix">
                        <h2>{{ $title }}</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-action text-right">
                        <div class="btn-groups">
                            <a href="{{ url("admin/{$prefix}/create") }}" class="btn btn-primary"><i class="fa fa-plus"></i>Thêm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-space orders-space"></div>

    <div class="products-content">
        <div class="row">
            <div class="product-sear panel-sear">          
                <form action="" class="" method="GET">
                    <div class="form-group col-md-5 padd-5">
                        <input type="text" name="name" value="{{ $name }}" class="form-control" placeholder="Nhập mã {{ $name_item }} hoặc tên {{ $name_item }}" id="search-pro-box">
                        <div id="pro-suggestion-box" style="border: 1px solid #444; display: none; overflow-y: auto;background-color: #fff; z-index: 2 !important; position: absolute; left: 0; width: 100%; padding: 5px 0px; max-height: 400px !important;"><div class="search-pro-inner"></div></div>
                    </div>
                    <div class="form-group col-md-7 ">
                        {{-- <div class="col-md-3 padd-0" style="margin-right: 10px;">
                            <select name="cid" class="form-control" id="search-option-1">
                                    <option value="0">Select category</option>
                                @if(isset($list_category))
                                    @foreach($list_category as $item)
                                        <option {{ $cid == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->vn_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div> --}}
                        <button type="submit" class="btn btn-primary btn-large btn-smanuf" name=""><i class="fa fa-search"></i> Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="product-main-body">
            <form action="{{ url("admin/{$prefix}/delete-all") }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    @if(session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center"><label class="checkbox" style="margin: 0;"><input type="checkbox"  class="checkbox chkAll"><span></span></label></th>
                            <th class="text-center">Mã</th>
                            <th class="text-center">Tên</th>             
                            <th class="text-center">Email</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center">Ngày đặt hàng</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr id="tr-item-">
                                <th class="text-center">
                                    <label class="checkbox" style="margin: 0;">
                                    <input type="checkbox" name="id[]" value="{{ $item->id }}" class="checkbox chkAll"><span></span>
                                    </label>
                                </th>
                                <td class="text-center">{{ $item->id }}</td>
                                <td class="text-left tr-detail-item" style="cursor: pointer; color: #1b6aaa;">
                                    <a href="{{ url("admin/{$prefix}/detail/{$item->id}") }}">{{ $item->customer->name }}</a>                              
                                </td>
                                <td class="text-center">{{ $item->customer->email }}</td>
                                <td class="text-center">
                                    {!! createStatus($item->status, $item->id) !!}
                                </td>
                                <td class="text-center">{{ $item->created_at }}</td>
                                <td class="text-center">
                                    <a href="{{ url("admin/{$prefix}/delete/{$item->id}") }}"><i class="fa fa-trash-o" title="Xóa" style="cursor:pointer;"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="alert alert-info summany-info clearfix" role="alert">
                    <div class="btn-groups">
                        {{-- <button tuye="submit" class="btn btn-warning">Active</button>
                        <button tuye="submit" class="btn btn-success">Inactive</button>
                        <button tuye="submit" class="btn btn-danger">Trash</button> --}}
                        <button tuye="submit" class="btn btn-primary">Clear all</button>
                    </div>
                    <div class="sm-info pull-left padd-0">SL hàng hóa/SL chủng loại: <span>0/0</span></div>
                    <div class="pull-right">
                        {{-- {{ $items->links() }} --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection