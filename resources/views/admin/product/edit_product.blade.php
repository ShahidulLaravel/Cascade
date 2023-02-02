@extends('layouts.dashboard')


@section('content')

<div class="row">
    <form action="{{route('product.update')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
      <div class="card-header">
        <h3>Update Product</h3>
           
           @if (session('success'))
              <strong class="text-success">{{session('success')}}</strong>
            @endif
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4">
              <div class="mb-3">
                <input type="hidden" name="product_update_id" value="{{$all_products->id}}">
                <label for="" class="form-label">Product Name</label>
                <input value="{{$all_products->product_name}}" type="text" name="product_name" class="form-control">
              </div>
          </div>
          <div class="col-lg-4">
              <div class="mb-3">
                <label for="" class="form-label">Product Price</label>
                <input type="number" name="price" class="form-control" value="{{$all_products->price}}">
              </div>
          </div>
          <div class="col-lg-4">
              <div class="mb-3">
                <label for="" class="form-label">Product Discount</label>
                <input type="number" name="discount" class="form-control" value="{{$all_products->discount}}">
              </div>
          </div>
          <div class="col-lg-6">
              <div class="mb-3">
                <label for="" class="form-label">Select Category</label>
                
                <select name="category_id"  id="category_id" class="form-control">
                  <option value="">-- Select Category --</option>
                  @foreach ($categories as $category)
                    <option {{$category->id == $all_products->category_id? 'selected': ''}}  value="{{$category->id}}">{{$category->category_name}}</option>
                  @endforeach
                </select>
              </div>
          </div>
          <div class="col-lg-6">
              <div class="mb-3">
                <label for="" class="form-label">Select Subcategory</label>
                <select name="subcategory_id" id="subcategory" class="form-control">
                  <option value="">-- Select Subcategory --</option>
                  @foreach ($subcategories as $subcategory)
                    <option {{$subcategory->id == $all_products->subcategory_id ? 'selected' : ''}} value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}</option>
                  @endforeach
                </select>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="mb-3">
                <label for="" class="form-label">Product Brand</label>

                  <select name="brand" class="form-control">
                    <option value="">-- Select Brand --</option>
                    @foreach ($brands as $brand)
                      <option {{$brand->id == $all_products->brand ? 'selected' : ''}} value="{{$brand->id}}">{{$brand->brand_name}}</option>
                    @endforeach
                  </select>
              </div>
          </div>
          <div class="col-lg-8">
              <div class="mb-3">
                <label for="" class="form-label">Short Description</label>
                <input type="text" name="short_desp" class="form-control"value="{{$all_products->short_desp}}">
              </div>
          </div>
          <div class="col-lg-12">
              <div class="mb-3">
                <label for="" class="form-label">Long Description</label>
                 <textarea id="summernote" name="long_desp" >{{$all_products->long_desp}}</textarea>
              </div>
          </div>
          <div class="col-lg-12">
              <div class="mb-3">
                <label for="" class="form-label">Additional Information</label>
                 <textarea id="summernoteTwo" name="additional_info">
                    {{$all_products->additional_info ? $all_products->additional_info : 'No Addtional Info Found Here'}}
                 </textarea>
              </div>
            </div> 
            <div class="col-lg-6">
              <div class="mb-3">
                <label for="" class="form-label">Product Preview</label>
                 <input type="file" class="form-control" name="preview">
                 <div class="my-2">
                    <img width="110" src="{{asset('uploads/Products/preview')}}/{{$all_products->preview}}" alt="">
                 </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label for="" class="form-label">Product Gallery</label>
                 <input type="file" multiple class="form-control" name="product_gallery[]">
                 <div class="my-2">
                    @foreach ($product_gallery as $gallery)
                        <img width="110" src="{{asset('uploads/Products/gallery')}}/{{$gallery->product_gallery}}" alt="">
                    @endforeach
                 </div>
              </div>
            </div>
            <div class="col-lg-8 m-auto">
              <div class="mt-3">
                <button class="btn btn-primary btn-block" type="submit">Update Product</button>
              </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

@endsection

@section('javascript')
<script>
  $(document).ready(function() {
  $('#summernote').summernote();
});
 $(document).ready(function() {
  $('#summernoteTwo').summernote();
});
</script>
@endsection

