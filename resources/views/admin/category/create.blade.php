@extends('admin.layouts.main')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Icons</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý danh mục</h1>
        </div>
    </div>
    <!--/.row-->


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-5">

                            @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $errors->first() }}</strong>
                            </div>
                            @endif

                            @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                <strong>{{ session()->get('success') }}</strong>
                            </div>
                            @endif

                            <form action="{{ route('admin.categories.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Danh mục cha:</label>
                                    <select class="form-control" name="parent_id">
                                        <option value="0">----ROOT----</option>
                                        @includeWhen(true, 'admin.partials.category_options', [
                                        'categories' => $categories,
                                        'nth' => 0,
                                        'process_id' => null
                                        ])
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Tên Danh mục</label>
                                    <input type="text" class="form-control" name="name" placeholder="Tên danh mục mới"
                                        value="{{ old('name') }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Thêm danh mục</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div>
        <!--/.col-->


    </div>
    <!--/.row-->
</div>
<!--/.main-->
@endsection