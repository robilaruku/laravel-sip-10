@extends('admin.template.admin')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-list"></i> Detail Category
                </h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="my-input">Name</label>
                    <input id="my-input" class="form-control" type="text" name="name" placeholder="Name..." value="{{ $category->name }}" disabled readonly>
                </div>
                <div class="form-group">
                    <label for="my-input">Status</label>
                    <select name="status" id="" class="form-control" disabled readonly>
                        <option value=""></option>
                        <option value="{{ \App\Category::STATUS_ACTIVE }}" {{ $category->status == \App\Category::STATUS_ACTIVE ? 'selected' : '' }}>{{ \App\Category::STATUS_ACTIVE }}</option>
                        <option value="{{ \App\Category::STATUS_INACTIVE }}" {{ $category->status == \App\Category::STATUS_INACTIVE ? 'selected' : '' }}>{{ \App\Category::STATUS_INACTIVE }}</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
