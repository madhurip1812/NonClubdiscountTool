@extends('layouts.app')

@section('content')
<!-- <div class="main-content">
    <div class="container-fluid"> -->
    
<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">Exclude Items Log</h3>
    </div>
    <div class="panel-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
    
        <div class="row">
            <div class="col-md-12">
<ul class="nav nav-tabs">
    <li class="active"> <a class="nav-item nav-link" id="nav-brand-tab" data-toggle="tab" href="#nav-brand" role="tab" aria-controls="nav-brand" aria-selected="true"> Excluded Brand Log</a></li>
    <li><a class="nav-item nav-link" id="nav-category-tab" data-toggle="tab" href="#nav-category" role="tab" aria-controls="nav-category" aria-selected="false">Excluded Category Log</a></li>
    <li> <a class="nav-item nav-link" id="nav-subctegory-tab" data-toggle="tab" href="#nav-subctegory" role="tab" aria-controls="nav-subctegory" aria-selected="false">Excluded SubCategory Log</a></li>
    <li> <a class="nav-item nav-link" id="nav-product-tab" data-toggle="tab" href="#nav-product" role="tab" aria-controls="nav-product" aria-selected="false">Excluded Products Log</a></li>
  </ul>
               
           <!--  CONTENT -->
            <div class="tab-content" id="nav-tabContent">
                     <div class="tab-pane active" id="nav-brand" role="tabpanel" aria-labelledby="nav-brand-tab">

                                <div class="form-group row ">
                                <table class="table fixed">
                                <thead class="thead-dark">
                                <tr>
                                <th scope="col" width="10%">Id</th>
                                <th scope="col" width="45%">BrandIds</th>
                                <th scope="col" width="20%">ModifiedDate</th>
                                <th scope="col" width="25%">ModifiedBy</th>

                                </tr>
                                </thead>
                                <tbody id="cart_tbody">
                                @foreach($ExcludedBrandlog as $Brandlog)
                                <tr>
                                <td>{{$Brandlog->id}}</td>
                                <td>{{$Brandlog->Brandids}}</td>
                                <td>{{$Brandlog->Modifieddate}}</td>
                                <td>{{$Brandlog->ModifiedBy}}</td>

                                </tr>
                                @endforeach
                                </tbody>
                                </table>

                                </div>
                        </div>

                        <div class="tab-pane" id="nav-category" role="tabpanel" aria-labelledby="nav-category-tab" >
                             <div class="form-group row ">
                                <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                <th scope="col" width="10%">Id</th>
                                <th scope="col" width="45%">CategoryIds</th>
                                <th scope="col" width="20%">ModifiedDate</th>
                                <th scope="col" width="25%">ModifiedBy</th>

                                </tr>
                                </thead>
                                <tbody id="cart_tbody">
                                @foreach($ExcludedCatlog as $catlog)
                                <tr>
                                <td>{{$catlog->id}}</td>
                                <td>{{$catlog->CategoryIds}}</td>
                                <td>{{$catlog->Modifieddate}}</td>
                                <td>{{$catlog->ModifiedBy}}</td>

                                </tr>
                                @endforeach
                                </tbody>
                                </table>

                                </div>
                        </div>

                        <div class="tab-pane " id="nav-subctegory" role="tabpanel" aria-labelledby="nav-subctegory-tab">
                            <div class="form-group row ">
                                <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                <th scope="col" width="10%">Id</th>
                                <th scope="col" width="45%">SubCategoryIds</th>
                                <th scope="col" width="20%">ModifiedDate</th>
                                <th scope="col" width="25%">ModifiedBy</th>

                                </tr>
                                </thead>
                                <tbody id="cart_tbody">
                                @foreach($ExcludedSubCatlog as $subcatlog)
                                <tr>
                                <td>{{$subcatlog->id}}</td>
                                <td>{{$subcatlog->SubCategoryids}}</td>
                                <td>{{$subcatlog->Modifieddate}}</td>
                                <td>{{$subcatlog->ModifiedBy}}</td>

                                </tr>
                                @endforeach
                                </tbody>
                                </table>

                                </div>
                        </div>

                         <div class="tab-pane" id="nav-product" role="tabpanel" aria-labelledby="nav-product-tab">
                            <div class="form-group row ">
                                <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                <th scope="col" width="10%">Id</th>
                                <th scope="col" width="45%">ProductIds</th>
                                <th scope="col" width="20%">ModifiedDate</th>
                                <th scope="col" width="25%">ModifiedBy</th>

                                </tr>
                                </thead>
                                <tbody id="cart_tbody">
                                @foreach($ExcludedProductlog as $product)
                                <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->productids}}</td>
                                <td>{{$product->modifieddate}}</td>
                                <td>{{$product->modifiedby}}</td>

                                </tr>
                                @endforeach
                                </tbody>
                                </table>

                                </div>
                        </div>
                </div>
            </div>
        </div>
    
    
        
        
 </div>
</div>
<!--     </div>
</div> -->
@endsection