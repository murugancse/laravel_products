@extends('layouts.admin')
@section('headSection')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css"/>
@endsection

@section('main-content')
<div class="container-fluid main-container">
    
    <div class="col-md-10 content">
        <div class="panel panel-default">
            <div class="panel-heading">
                Products
                <a href="{{ route('product.create') }}" class="btn
									btn-info btn-sm pull-right">
                                    Add Product
                                </a>
                                <br>
                @include('includes.messages')
            </div>
            <div class="panel-body">
                  <table id="example" class="table table-bordered table-striped text-center">
                    <thead>
                    <tr>
                        
                        <th>Name</th>
                        <th>Category</th>
                        <th>Short Description</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    
                    <tbody>
                    @foreach($products as $key => $product)
                        <tr>
                            
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->short_description }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->status==1 ? 'Active' : 'Inactive' }}</td>
                            <td id="tdref_{{ $product->id }}">
                                <a href="{{ route('product.edit', $product->id) }}" class="btn
									btn-info">
                                    Edit
                                </a>
                                 <form id="delete-form-{{ $product->id }}" action="{{ route('product.destroy', $product->id) }}" method="post"
                                                      style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                <button class="btn btn-danger" type="button" onclick="deleteItem({{ $product->id }})">
                                    Delete
                                </button>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    
</div>
@endsection
    
@section('footerSection')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
<script>
	function deleteItem(id) {
		if (confirm('Are you sure you want to delete?')) {
            event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
           return true;
            
            
        }else{
        	 event.preventDefault();
        	 return false;
        }
	}
    $(document).ready(function() {
        $('#example').DataTable();
    } );
  $("#dashboard_sidebar_a_id").addClass('active');
</script>
@endsection

