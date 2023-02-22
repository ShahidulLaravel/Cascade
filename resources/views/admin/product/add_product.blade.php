@extends('layouts.dashboard');


@section('content')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Product</li>
  </ol>
</nav>

<div>
  <form action="{{route('product.insert')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
      <div class="card-header">
        <h3>Add Product</h3>
           
           @if (session('success'))
              <strong class="text-success">{{session('success')}}</strong>
            @endif
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-3">
              <div class="mb-3">
                <label for="" class="form-label">Product Name</label>
                <input type="text" name="product_name" class="form-control">
              </div>
          </div>
          <div class="col-lg-3">
              <div class="mb-3">
                <label for="" class="form-label">Product Price</label>
                <input type="number" name="price" class="form-control">
              </div>
          </div>
          <div class="col-lg-3">
              <div class="mb-3">
                <label for="" class="form-label">Product Discount</label>
                <input type="number" name="discount" class="form-control">
              </div>
          </div>
           <div class="col-lg-3">
              <div class="mb-3">
                <label for="" class="form-label">Available Color</label>
                <select name="color_id"  id="color_id" class="form-control">
                  <option value="">-- Select Color --</option>
                  @foreach ($colors as $color)
                    <option value="{{$color->id}}">{{$color->color_name}}</option>
                  @endforeach
                </select>
              </div>
          </div>

          <div class="col-lg-4">
              <div class="mb-3">
                <label for="" class="form-label">Select Category</label>
                <select name="category_id"  id="category_id" class="form-control">
                  <option value="">-- Select Category --</option>
                  @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                  @endforeach
                </select>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="mb-3">
                <label for="" class="form-label">Select Subcategory</label>
                <select name="subcategory_id" id="subcategory" class="form-control">
                  <option value="">-- Select Subcategory --</option>
                  @foreach ($subcategories as $subcategory)
                    <option value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}</option>
                  @endforeach
                </select>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="mb-3">
                <label for="" class="form-label">Available Size</label>
                <select name="size_id"  id="size_id" class="form-control">
                  <option value="">-- Select Size --</option>
                  @foreach ($sizes as $size)
                    <option value="{{$size->id}}">{{$size->size_name}}</option>
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
                      <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                    @endforeach
                  </select>
              </div>
          </div>
          <div class="col-lg-8">
              <div class="mb-3">
                <label for="" class="form-label">Short Description</label>
                <input type="text" name="short_desp" class="form-control">
              </div>
          </div>
          <div class="col-lg-12">
              <div class="mb-3">
                <label for="" class="form-label">Long Description</label>
                 <textarea id="summernote" name="long_desp"></textarea>
              </div>
          </div>
          <div class="col-lg-12">
              <div class="mb-3">
                <label for="" class="form-label">Additional Information</label>
                 <textarea id="summernoteTwo" name="additional_info"></textarea>
              </div>
            </div> 
            <div class="col-lg-6">
              <div class="mb-3">
                <label for="" class="form-label">Product Preview</label>
                 <input type="file" class="form-control" name="preview">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label for="" class="form-label">Product Gallery</label>
                 <input type="file" multiple class="form-control" name="product_gallery[]">
              </div>
            </div>
            <div class="col-lg-8 m-auto">
              <div class="mt-3">
                <button class="btn btn-primary btn-block" type="submit">Add Product</button>
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
<script>
    $('#category_id').change(function(){
      var category_id = $(this).val();
    
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type:'POST',
        url: '/getSubcategory',
        data:{'category_id': category_id},
        success:function(data){
          $('#subcategory').html(data);
        }
      });

  });

</script>

@endsection