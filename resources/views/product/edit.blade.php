@extends('layouts.admin')
@section('headSection')

@endsection

@section('main-content')
<div class="container-fluid main-container">
    
    <div class="col-md-10 content">
        <div class="panel panel-default">
            <div class="panel-heading">
               Edit Product
               @include('includes.messages')
            </div>
            <div class="panel-body">
                <form role="form" action="{{ route('product.update', $product->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $product->name }}" placeholder="Enter Product Name">
                                </div>
                                <div class="form-group">
                                    <label>Product Category</label>
                                    <select name="category_id" class="form-control">
                                        <option value="" disabled selected>Select a Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category->id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <input type="text" class="form-control" name="short_description" id="short_description" value="{{ $product->short_description }}" placeholder="Enter short description">
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description</label>
                                     <textarea class="form-control" style="height: 108px;" id="description" name="description" rows="5">{{ $product->description }}</textarea>
                                </div>
                                <table id="filetable">
                                    <thead>
                                        <tr>
                                            <th width="42%">Particular</th>
                                            <th width="42%">File</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody id="attachmentarea">
                                        @foreach($product->productImages as $file)
                                        <tr id="del_{{ $file->id }}">
                                            <td>{{$file->image_name}}</td>
                                            <td style="pointer-events: visible;"><img height="100" width="100" src="{{ URL::to('/files/'.$file->image_name) }}" alt="Image"/>
 &nbsp;&nbsp; <a href="{{ URL::to('/files/'.$file->image_name) }}" class="btn btn-sm download-link" target="_blank">VIEW ATTACHMENT</a></td>
                                          
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    
                                 </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                  
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

