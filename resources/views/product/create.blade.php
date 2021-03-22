@extends('layouts.admin')
@section('headSection')

@endsection

@section('main-content')
<div class="container-fluid main-container">
    
    <div class="col-md-10 content">
        <div class="panel panel-default">
            <div class="panel-heading">
               Add Product
               @include('includes.messages')
            </div>
            <div class="panel-body">
                <form role="form" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Product Name">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Category</label>
                                                <select name="category_id" class="form-control">
                                                    <option value="" disabled selected>Select a Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Short Description</label>
                                                <input type="text" class="form-control" name="short_description" id="short_description" value="{{ old('short_description') }}" placeholder="Enter short description">
                                            </div>
                                           
                                        </div>
                                        <div class="col-md-6">
                                           <div class="form-group">
                                                <label>Description</label>
                                                 <textarea class="form-control" style="height: 108px;" id="description" name="description" rows="5"></textarea>
                                            </div>
                                             <div class="form-group">
                                                <label>Images</label>
                                                <input type="file" required="" class="form-control" name="images[]" multiple >
                                            </div>
                                        </div>
                                    </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-md-right">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
@endsection
    
@section('footerSection')

<script>
  $("#dashboard_sidebar_a_id").addClass('active');
</script>
@endsection

