@extends('admin.template.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Products
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('products.create') }}" class="btn btn-tool">
                            <i class="fa fa-plus"></i> Add Product
                        </a>
                    </div>
                </div>
                <div class="card-body">
                  @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                       <i class="fa fa-check"></i>&nbsp; {{ Session::get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                  @endif
                  {!! Form::open(['route' => 'products.index', 'method' => 'get']) !!}
                   <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('category', 'Category') !!}
                                {!! Form::select('category', $categories, $category, ['class' => 'form-control', 'placeholder' => 'Choose Category']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Name') !!}
                                {!! Form::text('name', $name, ['class' => 'form-control', 'placeholder' => 'Search Name']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="">&nbsp;</label>
                            <button type="submit" class="btn btn-outline-primary form-control">Filter</button>
                        </div>
                        <div class="col-md-2">
                            <label for="">&nbsp;</label>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary form-control">Reset</a>
                        </div>
                   </div>
                  {!! Form::close() !!}
                   <br><br>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>SKU</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $index => $item)
                                <tr>
                                    <td>{{ ($products->currentpage()-1) * $products->perpage() + $index + 1  }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->sku }}</td>
                                    <td>{{ number_format($item->price,2,',','.') }}</td>
                                    <td><img src="{{ $item->showImage() }}" alt="{{ $item->showImage() }}" width="100px" srcset=""></td>
                                    @if ($item->status == $item::STATUS_ACTIVE)
                                     <td><span class="badge badge-success">{{ $item->status }}</span></td>
                                    @else
                                     <td><span class="badge badge-danger">{{ $item->status }}</span></td>
                                    @endif
                                    <td>
                                        <form action="{{ route('products.destroy', $item->id) }}" method="post">
                                            <input type="hidden" name="_method" value="DELETE">
                                            @csrf
                                            <div class="btn-group" role="group" aria-label="Button group">
                                                <a href="{{ route('products.show', $item->id) }}" class="btn btn-info btn-sm" style="color: #fff"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('products.edit', $item->id) }}" class="btn btn-warning btn-sm" style="color: #fff"><i class="fa fa-edit"></i></a>
                                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm" style="color: #fff"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-right">
                                    {{ $products->appends(request()->input())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
