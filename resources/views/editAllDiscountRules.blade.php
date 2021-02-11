@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-12 alert alert-danger @if ($errors->any()) '' @else dont-display @endif" role="alert" id="error-msg-block-common">
            @foreach ($errors->all() as $message)
                <span class="col-md-11" id="error-msg-span-common">
                    {{ $message }}
                </span>
            @endforeach
            <a href="#" class=" col-md-1 close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
        </div>
    </div>
    <div class="container">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="cat-tab" href="#CatRuleDiv"  data-toggle="tab" role="tab" aria-controls="category" aria-selected="false">Category</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="prod-tab" href="#ProdRuleDiv" data-toggle="tab" role="tab" aria-controls="product" aria-selected="false">Product</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div role="tabpanel" aria-labelledby="prod-tab" id="ProdRuleDiv" class="tab-pane fade row justify-content-center">
                <div class="container-sm" >
                    <div class="card mt-3">
                        <div class="card-header">
                            <label class="mt-2 mb-0"><h4>Non Club Member Discount Page for Product</h4></label>
                            <div class="float-right"> 
                                <a class="btn btn-dark" type="button" href="{{url('/uploadNonClubDiscount')}}">
                                    Upload Non Club Discount
                                </a> 
                                <a class="btn btn-dark" type="button" href="{{url('/prodNonClubDiscDiff')}}">
                                    View All
                                </a> 
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger dont-display" role="alert" id="error-msg-block-prod">
                                <span id="error-msg-span-prod"></span>
                                <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>                            
                            </div>
                            <div class="alert alert-success dont-display" role="alert" id="success-msg-block-prod">
                                <span id="success-msg-span-prod"></span>
                                <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>                            
                            </div>
                            <div class="row form-group col-md-12">
                                <div class="col-md-10 row">
                                    <label class="col-md-3">Enter Product IDs :</label>
                                    <input type="text" class=" col-md-9 numbercommatxt" name="product_ids" id="product_ids" >
                                    <label id="product_ids-error" class="dont-display error text-danger" for="product_ids" style="margin-left: 208px;">Enter Product id(s)</label>
                                </div>
                                <div class="col-md-2"> 
                                    <button class="btn btn-primary btn-md btn_prod_rule_search" type="submit" id="prod_rule_search" value="save" > 
                                        Search  
                                    </button>  
                                    <button class="btn btn-danger btn-md " id="reset_prod_search" type="reset" id="reset"> 
                                        Reset  
                                    </button> 
                                </div>
                            </div>
                            <div class="row col-md-12 dont-display" id="prod_disc_rule_div" >
                                <div class="table-responsive">
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    <table class="table" id="editProdRuleTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Product ID</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Non CLub Discount Difference</th>
                                                <th scope="col">Non Club Discount Difference Type</th>
                                                <th scope="col">Last Modified Date</th>
                                                <th scope="col">Last Modified By</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="prod_disc_rule_tbody">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" aria-labelledby="cat-tab" id="CatRuleDiv" class="tab-pane fade show active row justify-content-center">
                <div class="container-sm" >
                    <div class="card mt-3">
                        <div class="card-header">
                            <label class="mt-2 mb-0"><h4>Non Club Member Discount Page</h4></label>
                            <div class="float-right"> 
                                <a class="btn btn-dark" type="button" href="{{url('/nonClubDiscDiffConditions')}}">
                                    View All
                                </a> 
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger dont-display" role="alert" id="error-msg-block">
                                <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>                            
                                <span id="error-msg-span"></span>
                            </div>
                            <div class="alert alert-success dont-display" role="alert" id="success-msg-block">
                                <span id="success-msg-span"></span>
                                <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>                            
                            </div>
                            <div class="cls_grid" id="id_grid1">
                                <form class="updateCatRuleForm" id="catRuleform1">
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    <div class="row form-group col-md-12">
                                        <div class="col-md-10 row">
                                            <div class="col-md-4">
                                                <select class="form-control multiselect cls_category all_input_1" name="category[]"  id="sel_category_1"  data-style="btn-default" style="width: 100%">
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $catKey => $catValue)
                                                        <option value="{{$catValue->productcatid}}">{{$catValue->categoryname}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control multiselect cls_sub_category all_input_1" name="sub_category[]" id="sel_sub_category_1" style="width: 100%" >
                                                <option value="">Select Sub Category</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control multiselect cls_type_level all_input_1" name="type_level[]" id="sel_type_level_1" style="width: 100%">
                                                    <option value="">Select Product Type</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2"> 
                                            <button class="btn btn-success btn-md btn_edit_save" type="submit" id="btn_edit_1" value="save"> 
                                                Save  
                                            </button>  
                                            <button class="btn btn-danger btn-md  btn_clr" type="button" id="btn_clr_1" > 
                                                Clear  
                                            </button> 
                                        </div>
                                    </div>
                                    <div class="row col-md-12">
                                        <input type="hidden" name="id" id="id_1">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">a. Buckets defined are:</th>
                                                    <th scope="col">% of Discount for Non Club Member</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="row col-md-12">
                                                            i. Low - Less than &nbsp;&nbsp; 
                                                            <input type="text" name="avgvalueforlow[]" id="avgvalueforlow_1" class="numbercommatxt form-control col-md-2 all_input_1">&nbsp;&nbsp; % of the AVG Sale
                                                        </div>
                                                        <label id="avgvalueforlow_1-error" class="error text-danger" for="avgvalueforlow_1" style="margin-left: 121px;display: none;"></label>
                                                    </td>
                                                    <td>
                                                        <div class="row col-md-12">
                                                            <input type="text" name="low_disc[]"  id="low_disc_1" class="numbercommatxt form-control col-md-2 low_disc all_input_1">&nbsp;&nbsp;<label for="low_disc1"> % of club discount</label>
                                                        </div>
                                                        <label id="low_disc_1-error" class="error text-danger dont-display" for="low_disc_1" ></label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>ii.Med - Average Sale</td>
                                                    <td>
                                                        <div class="row col-md-12">
                                                            <input type="text" name="med_disc[]" id="med_disc_1" class="form-control col-md-2 med_disc all_input_1 numbercommatxt">&nbsp;&nbsp;<label for="med_disc1">% of club discount</label>
                                                        </div>
                                                        <label id="med_disc_1-error" class="error text-danger dont-display" for="med_disc_1" ></label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="row col-md-12">
                                                            iii. High - More than &nbsp;&nbsp;
                                                            <input type="text" name="avgvalueforhigh[]" id="avgvalueforhigh_1" class="form-control col-md-2 all_input_1 numbercommatxt">&nbsp;&nbsp;<label for="low_disc1"> %of the AVG Sale </label>
                                                        </div>
                                                        <label id="avgvalueforhigh_1-error" class="error text-danger" for="avgvalueforhigh_1" style="margin-left: 121px;display: none;"></label>
                                                    </td>
                                                    <td>
                                                        <div class="row col-md-12">
                                                            <input type="text" name="high_disc[]" id="high_disc_1" class="form-control col-md-2 high_disc all_input_1 numbercommatxt">&nbsp;&nbsp;<label for="high_disc1"> % of club discount</label>
                                                        </div>
                                                        <label id="high_disc_1-error" class="error text-danger dont-display" for="high_disc_1" ></label>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{ asset('js/NonClubMemberDisc.js') }}" ></script>
@endsection
