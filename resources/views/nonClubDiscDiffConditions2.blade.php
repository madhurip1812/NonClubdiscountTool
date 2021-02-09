@extends('layouts.app')
@section('header')
<style type="text/css">
    .table td, .table th {
        padding-left: 0.20rem !important;
        padding-right: 0.20rem !important;
    }
</style>
@endsection
@section('content')
<div class="col-md-12 justify-content-center">
    <div class="row " >
            <div class="card">
                <div class="card-header ">
                    <label><h4> Non Club Discount Difference Conditions</h4></label>
                    <div class="float-right"> 
                        <a class="btn btn-dark" type="button" href="{{url('editAllDiscountRules')}}"> 
                            Choose Rule to edit
                        </a> 
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger" role="alert" id="error-msg-block" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>                            
                        <span id="error-msg-span"></span>
                    </div>
                    <div class="alert alert-success" role="alert" id="success-msg-block" style="display: none;">
                        <span id="success-msg-span"></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>                            
                    </div>
                    <div class="table-responsive">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        {!! $nonClubDiscountDifferenceConditions->appends(Request::all())->links() !!}
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Subcategory Name</th>
                                    <th scope="col">Type Name</th>
                                    <th scope="col">Avg Value For Low</th>
                                    <th scope="col">Discount Difference For Low</th>
                                    <th scope="col">Discount Difference For Mid</th>
                                    <th scope="col">Avg Value For High</th>
                                    <th scope="col">Discount Difference For High</th>
                                    <th scope="col">Avg Sales</th>
                                    <th scope="col">Last Modified Date</th>
                                    <th scope="col">Last Modified By</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($nonClubDiscountDifferenceConditions as $key => $value)
                                <tr id="{{$value->id}}">
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->category->CategoryName ?? ''}}</td>
                                    <td>{{$value->category->CategoryName ?? ''}} | {{$value->subcategory->SubCategoryName ?? ''}}</td>
                                    <td>{{$value->typename}}</td>
                                    <td>
                                        <input type="text" name="avgvalueforlow" id="avgvalueforlow_{{$value->id}}" value="{{$value->avgvalueforlow}}" class="form-control cls_input_{{$value->id}} numbercommatxt"  style="display: none;">
                                        <span class="cls_span_{{$value->id}}" id="span_avgvalueforlow_{{$value->id}}">{{$value->avgvalueforlow}}</span>
                                    </td>
                                    <td>
                                        <input type="text" name="discountdifferentforlow" id="discountdifferentforlow_{{$value->id}}" value="{{$value->discountdifferentforlow}}" class="form-control cls_input_{{$value->id}} numbercommatxt"  style="display: none;">
                                        <span class="cls_span_{{$value->id}}" id="span_discountdifferentforlow_{{$value->id}}">
                                        {{$value->discountdifferentforlow}}</span>
                                    </td>
                                    <td>
                                        <input type="text" name="discountdifferenceformid" id="discountdifferenceformid_{{$value->id}}" value="{{$value->discountdifferenceformid}}" class="form-control cls_input_{{$value->id}} numbercommatxt"  style="display: none;">
                                        <span class="cls_span_{{$value->id}}" id="span_discountdifferenceformid_{{$value->id}}">
                                        {{$value->discountdifferenceformid}}</span>
                                    </td>
                                    <td>
                                        <input type="text" name="avgvalueforhigh" id="avgvalueforhigh_{{$value->id}}" value="{{$value->avgvalueforhigh}}" class="form-control cls_input_{{$value->id}}"  style="display: none;">
                                        <span class="cls_span_{{$value->id}} numbercommatxt" id="span_avgvalueforhigh_{{$value->id}}">
                                        {{$value->avgvalueforhigh}}</span>
                                    </td>
                                    <td>
                                        <input type="text" name="discountdifferenceforhigh" id="discountdifferenceforhigh_{{$value->id}}" value="{{$value->discountdifferenceforhigh}}" class="form-control cls_input_{{$value->id}}"  style="display: none;">
                                        <span class="cls_span_{{$value->id}} numbercommatxt" id="span_discountdifferenceforhigh_{{$value->id}}">
                                        {{$value->discountdifferenceforhigh}}</span>
                                    </td>
                                    <td>{{$value->avgsale}}</td>
                                    <td>{{date('d/m/Y',strtotime($value->lastmodifieddate))}}</td>
                                    <td>{{$value->lastmodifiedby}}</td>
                                    <td style="vertical-align: middle;">
                                        @if($value->avgvalueforhigh == null && $value->discountdifferenceformid == null)
                                            <button title="Add rule" type="button" class="btn btn-primary btn-sm mb-1" onclick="changeRule('{{$value->id}}','edit');" id="btn_edit_{{$value->id}}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        @else
                                            <button title="Edit rule" type="button" class="btn btn-primary btn-sm mb-1" onclick="changeRule('{{$value->id}}','edit');" id="btn_edit_{{$value->id}}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        @endif
                                        <button title="Save rule" type="button" class="btn btn-primary btn-sm mb-1" onclick="changeRule('{{$value->id}}','save');" id="btn_save_{{$value->id}}" style="display: none;">
                                            <i class="fa fa-save"></i>
                                        </button>
                                        @if($value->typename!=null && $value->avgvalueforhigh != null && $value->discountdifferenceformid != null)
                                            <button title="Delete rule" type="button" class="btn btn-sm btn-danger"  onclick="deleteCatRule('{{$value->id}}');" id="btn_delete_{{$value->id}}">
                                                <i class="fa fa-trash-o" aria-hidden="true" ></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                    
                </div>
            </div>
    </div>
</div>
@endsection
@section('footer')
    <script type="text/javascript">
        // $('.multiselect').amsifySelect({
        //     type :'bootstrap',
        //     searchable :true,
        //     labelLimit: 2,
        //     classes: {
        //             clear : 'btn btn-danger',
        //             close : 'btn btn-primary'
        //         }
        // });
    </script>
    <script src="{{ asset('js/NonClubMemberDisc.js') }}" ></script>
@endsection
