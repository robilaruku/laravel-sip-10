@extends('admin.template.admin')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-edit"></i> Edit Category
                </h3>
            </div>
            <form action="{{ route('categories.update', $category->id) }}" method="post">
            <input type="hidden" name="_method" value="PUT">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="my-input">Name</label>
                    <input id="my-input" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" placeholder="Name..." value="{{ $category->name }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="my-input">Status</label>
                    <select name="status" id="" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <option value="">Pilih</option>
                        <option value="{{ \App\Category::STATUS_ACTIVE }}" {{ $category->status == \App\Category::STATUS_ACTIVE ? 'selected' : '' }}>{{ \App\Category::STATUS_ACTIVE }}</option>
                        <option value="{{ \App\Category::STATUS_INACTIVE }}" {{ $category->status == \App\Category::STATUS_INACTIVE ? 'selected' : '' }}>{{ \App\Category::STATUS_INACTIVE }}</option>
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-info float-right"><i class="fa fa-edit"></i> Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
