@extends('admin.template.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Categories
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('categories.create') }}" class="btn btn-tool">
                            <i class="fa fa-plus"></i> Add Category
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
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    @if ($item->status == $item::STATUS_ACTIVE)
                                     <td><span class="badge badge-success">{{ $item->status }}</span></td>
                                    @else
                                     <td><span class="badge badge-danger">{{ $item->status }}</span></td>
                                    @endif
                                    <td>
                                        <form action="{{ route('categories.destroy', $item->id) }}" method="post">
                                            <input type="hidden" name="_method" value="DELETE">
                                            @csrf
                                            <div class="btn-group" role="group" aria-label="Button group">
                                                <a href="{{ route('categories.show', $item->id) }}" class="btn btn-info btn-sm" style="color: #fff"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('categories.edit', $item->id) }}" class="btn btn-warning btn-sm" style="color: #fff"><i class="fa fa-edit"></i></a>
                                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm" style="color: #fff"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
