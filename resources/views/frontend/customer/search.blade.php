@extends('frontend.master')

@section('content')

<section class="bg-cover" style="background:url({{asset('FrontEnd/img/banner-2.png')}}) no-repeat;">
    <div class="container">
         <div class="row align-items-center justify-content-center">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                   <div class="text-left py-5 mt-3 mb-3">
                        <h1 class="ft-medium mb-3">Shop</h1>
                   </div>
              </div>
         </div>
    </div>
</section>
<!-- ======================= Shop Style 1 ======================== -->


<!-- ======================= Filter Wrap Style 1 ======================== -->
<section class="py-3 br-bottom br-top">
    <div class="container">
         <div class="row align-items-center justify-content-between">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                   <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                             <li class="breadcrumb-item"><a href="#">Home</a></li>
                             <li class="breadcrumb-item"><a href="#">Shop</a></li>
                             <li class="breadcrumb-item active" aria-current="page">Women's</li>
                        </ol>
                   </nav>
              </div>
         </div>
    </div>
</section>
<!-- ============================= Filter Wrap ============================== -->


<!-- ======================= All Product List ======================== -->
<section class="middle">
    <div class="container">
         <div class="row">

              <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 p-xl-0">
                   <div class="search-sidebar sm-sidebar border">
                        <div class="search-sidebar-body">
                             <!-- Single Option -->
                             <div class="single_search_boxed">
                                  <div class="widget-boxed-header">
                                       <h4><a href="#pricing" data-toggle="collapse" aria-expanded="false" role="button">Pricing</a></h4>
                                  </div>
                                  <div class="widget-boxed-body collapse show" id="pricing" data-parent="#pricing">
                                       <div class="row">
                                            <div class="col-lg-6 pr-1">
                                                 <div class="form-group pl-3">
                                                      <input type="number" class="min form-control" placeholder="Min" value="{{@$_GET['min']}}">
                                                 </div>
                                            </div>
                                            <div class="col-lg-6 pl-1">
                                                 <div class="form-group pr-3">
                                                      <input type="number" class="max form-control" placeholder="Max" value="{{@$_GET['max']}}">
                                                 </div>
                                            </div>
                                            <div class="col-lg-12">
                                                 <div class="form-group px-3">
                                                      <button type="submit" class="range_btn btn form-control">Submit</button>
                                                 </div>
                                            </div>
                                       </div>
                                  </div>
                             </div>

                             <!-- Single Option -->
                             <div class="single_search_boxed">
                                  <div class="widget-boxed-header">
                                       <h4><a href="#Categories" data-toggle="collapse" aria-expanded="false" role="button">Categories</a></h4>
                                  </div>
                                  <div class="widget-boxed-body collapse show" id="Categories" data-parent="#Categories">
                                       <div class="side-list no-border">
                                            <!-- Single Filter Card -->
                                            <div class="single_filter_card">
                                                 <div class="card-body pt-0">
                                                      <div class="inner_widget_link">
                                                  <ul class="no-ul-list">
                                                       @foreach ($categories as $category)
                                                       <li>
                                                            <input id="category{{$category->id}}" class="category_id" name="category_id" type="radio" value="{{$category->id}}" {{$category->id == @$_GET['category_id']?'checked':''}}>
                                                            <label for="category{{$category->id}}" class="checkbox-custom-label">{{$category->category_name}}<span>{{App\Models\Product::where('category_id', $category->id)->count()}}</span></label>
                                                        </li>
                                                       @endforeach

                                                           </ul>
                                                      </div>
                                                 </div>
                                            </div>
                                       </div>
                                  </div>
                             </div>

                             <!-- Single Option -->
                             <div class="single_search_boxed">
                                  <div class="widget-boxed-header">
                                       <h4><a href="#brands" data-toggle="collapse" aria-expanded="false" role="button">Brands</a></h4>
                                  </div>
                                  <div class="widget-boxed-body collapse show" id="brands" data-parent="#brands">
                                       <div class="side-list no-border">
                                            <!-- Single Filter Card -->
                                            <div class="single_filter_card">
                                                 <div class="card-body pt-0">
                                                      <div class="inner_widget_link">
                         <ul class="no-ul-list">
                         @foreach ($brands as $brand)

                         <li>
                              <input id="brands{{$brand->id}}" class="brand" name="brand" type="radio" value="{{$brand->id}}" {{$brand->id == @$_GET['brand']?'checked':''}}>
                              <label for="brands{{$brand->id}}" class="checkbox-custom-label">{{$brand->brand_name}}<span>{{App\Models\Product::where('id', $brand->id)->count()}}</span></label>
                          </li>

                         @endforeach
                         </ul>
                                                      </div>
                                                 </div>
                                            </div>
                                       </div>
                                  </div>
                             </div>

                             <!-- Single Option -->
                             <div class="single_search_boxed">
                                  <div class="widget-boxed-header">
                                       <h4><a href="#colors" data-toggle="collapse" class="collapsed" aria-expanded="false" role="button">Colors</a></h4>
                                  </div>
     <div class="widget-boxed-body collapse" id="colors" data-parent="#colors">
          <div class="side-list no-border">
               <!-- Single Filter Card -->
               <div class="single_filter_card">
                    <div class="card-body pt-0">
                         <div class="text-left">
                              @foreach ($colors as $color)
                              <div class="form-check form-option form-check-inline mb-1">
                                   <input class="color_id" type="radio" name="color_id" id="color{{$color->id}}" value="{{$color->id}}" {{$color->id == @$_GET['color_id']?'checked':''}}>
                                   <label class="form-option-label rounded-circle" for="color{{$color->id}}"><span class="form-option-color rounded-circle" style="background-color: {{$color->color_code}}"></span></label>
                               </div>
                              @endforeach
                         </div>
                    </div>
               </div>
          </div>
     </div>
                             </div>

                             <!-- Single Option -->
                             <div class="single_search_boxed">
                                  <div class="widget-boxed-header">
                                       <h4><a href="#size" data-toggle="collapse" class="collapsed" aria-expanded="false" role="button">Size</a></h4>
                                  </div>
                                  <div class="widget-boxed-body collapse" id="size" data-parent="#size">
                                       <div class="side-list no-border">
                                            <!-- Single Filter Card -->
                                            <div class="single_filter_card">
                                                 <div class="card-body pt-0">
                    <div class="text-left pb-0 pt-2">

                         @foreach ($sizes as $size)
                         <div class="form-check form-option form-check-inline mb-2">
                              <input class="size_id" type="radio" name="size_id" id="size{{$size->id}}" value="{{$size->id}}" {{$size->id == @$_GET['size_id']?'checked':''}}>
                              <label class="form-option-label" for="size{{$size->id}}">{{$size->size_name}}</label>
                          </div>
                         @endforeach
                    </div>
                                                 </div>
                                            </div>
                                       </div>
                                  </div>
                             </div>

                        </div>
                   </div>
              </div>

              <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">

                   <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                             <div class="border mb-3 mfliud">
                                  <div class="row align-items-center py-2 m-0">
                                       <div class="col-xl-3 col-lg-4 col-md-5 col-sm-12">
                                            <h6 class="mb-0">Searched Products Found</h6>
                                       </div>

                                       <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12">
                                        <div class="filter_wraps d-flex align-items-center justify-content-end m-start">
                                            <div class="single_fitres mr-2 br-right">
                                                <select class="custom-select simple sorting" >
                                                  <option value="">Default Sorting</option>
                                                  <option value="1">Sort by price: A-Z</option>
                                                  <option value="2">Sort by price: Z-A</option>
                                                  <option value="3">Sort by price: Low price</option>
                                                  <option value="4">Sort by price: Hight price</option>
                                                </select>
                                             </div>
                                        </div>
                                    </div>
                                  </div>
                             </div>
                        </div>
                   </div>

                   <!-- row -->
                   <div class="row align-items-center rows-products">
                        <!-- Single -->
                        @foreach ($searched_products as $product)
                        <div class="col-xl-4 col-lg-4 col-md-6 col-6">
                             <div class="product_grid card b-0">
                                  <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">New</div>
                                  <div class="card-body p-0">
                                       <div class="shop_thumb position-relative">
                                            <a class="card-img-top d-block overflow-hidden" href="{{route('details', $product->slug)}}"><img style="width:170px;" class="card-img-top" src="{{asset('uploads/Products/preview')}}/{{$product->preview}}" alt="prduct image here"></a>
                                       </div>
                                  </div>
                                  <div class="card-footer b-0 p-0 pt-2 bg-white">

                                       <div class="text-left">
                                            <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a href="{{route('details', $product->slug)}}">{{$product->product_name}}</a></h5>
                                            <div class="elis_rty"><span class="ft-bold text-dark fs-sm">&#2547;{{$product->price}}</span></div>
                                       </div>
                                  </div>
                             </div>
                        </div>
                        @endforeach
                   </div>
                   <div class="row">
                    <div class="col-lg-12">
                         @if ($searched_products->count() == 0)
                         <div class="alert alert-danger">
                              <h4 class="text-center">No Product Found according to Your Search !! Try Again</h4>
                         </div>
                         @endif
                    </div>
                   </div>
                   <!-- row -->
              </div>
         </div>
    </div>
</section>

@endsection

@section('javascript')

@endsection
