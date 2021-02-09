@extends('layouts.app')
@section('header')
    <!--- datatable --->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!--- datatable --->
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
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                            
                    <span id="error-msg-span"></span>
                </div>
                <div class="alert alert-success" role="alert" id="success-msg-block" style="display: none;">
                    <span id="success-msg-span"></span>
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                            
                </div>
                <div class="table-responsive">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <table id="collapsible-table" class="table " style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Category Name</th>
                                <th scope="col">Subcategory Name</th>
                                <th scope="col">Type Name</th>
                                <th scope="col">Avg Value For Low</th>
                                <th scope="col">Discount Difference For Low</th>
                                <th scope="col">Discount Difference For Mid</th>
                                <th scope="col">Avg Value For High</th>
                                <th scope="col">Discount Difference For High</th>
                                <th scope="col">Avg Sales</th>
                                <th scope="col">Created Date</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Last Modified Date</th>
                                <th scope="col">Last Modified By</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $key => $value)
                                <tr class="header">
                                    <td class="header-link">{{$value['categoryname'] ?? ''}}</td>
                                    <td class="sub-header-link">{{$value['subcategory'][0]['subcategoryname'] ?? ''}}</td>
                                    @if(count($value['subcategory'][0]['subcatdiscount_rule']) >0 &&  $value['subcategory'][0]['subcatdiscount_rule'][0]['typeid']== -1)
                                    <td>{{$value['subcategory'][0]['subcatdiscount_rule'][0]['typename'] ?? ''}}</td>
                                    <td>
                                        <input type="text" name="avgvalueforlow" id="avgvalueforlow_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}" value="{{$value['subcategory'][0]['subcatdiscount_rule'][0]['avgvalueforlow'] ?? 0}}" class="form-control cls_input_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}} numbercommatxt dont-display" >
                                        <span class="cls_span_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}" id="span_avgvalueforlow_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}">{{$value['subcategory'][0]['subcatdiscount_rule'][0]['avgvalueforlow'] ?? 0}}</span>
                                    </td>
                                    <td>
                                        <input type="text" name="discountdifferentforlow" id="discountdifferentforlow_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}" value="{{$value['subcategory'][0]['subcatdiscount_rule'][0]['discountdifferentforlow'] ?? 0}}" class="form-control cls_input_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}} numbercommatxt dont-display">
                                        <span class="cls_span_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}" id="span_discountdifferentforlow_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}">
                                        {{$value['subcategory'][0]['subcatdiscount_rule'][0]['discountdifferentforlow'] ?? 0}}</span>
                                    </td>
                                    <td>
                                        <input type="text" name="discountdifferenceformid" id="discountdifferenceformid_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}" value="{{$value['subcategory'][0]['subcatdiscount_rule'][0]['discountdifferenceformid'] ?? 0}}" class="form-control cls_input_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}} numbercommatxt dont-display">
                                        <span class="cls_span_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}" id="span_discountdifferenceformid_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}">
                                        {{$value['subcategory'][0]['subcatdiscount_rule'][0]['discountdifferenceformid'] ?? 0}}</span>
                                    </td>
                                    <td>
                                        <input type="text" name="avgvalueforhigh" id="avgvalueforhigh_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}" value="{{$value['subcategory'][0]['subcatdiscount_rule'][0]['avgvalueforhigh'] ?? 0}}" class="form-control cls_input_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}} dont-display">
                                        <span class="cls_span_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}} numbercommatxt" id="span_avgvalueforhigh_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}">
                                        {{$value['subcategory'][0]['subcatdiscount_rule'][0]['avgvalueforhigh'] ?? 0}}</span>
                                    </td>
                                    <td>
                                        <input type="text" name="discountdifferenceforhigh" id="discountdifferenceforhigh_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}" value="{{$value['subcategory'][0]['subcatdiscount_rule'][0]['discountdifferenceforhigh'] ?? 0}}" class="form-control cls_input_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}} dont-display">
                                        <span class="cls_span_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}} numbercommatxt" id="span_discountdifferenceforhigh_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}">
                                        {{$value['subcategory'][0]['subcatdiscount_rule'][0]['discountdifferenceforhigh'] ?? 0}}</span>
                                    </td>
                                    <td>{{$value['subcategory'][0]['subcatdiscount_rule'][0]['avgsale'] ?? 0}}</td>
                                    <td>
                                        <span id="span_createddate_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}">
                                            {{date('d/m/Y',strtotime($value['subcategory'][0]['subcatdiscount_rule'][0]['createddate']))}}
                                        </span>
                                    </td>
                                    <td>
                                        <span id="span_createdby_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}">
                                            {{$value['subcategory'][0]['subcatdiscount_rule'][0]['createdby'] ?? 0}}
                                        </span>
                                    </td>
                                    <td>
                                        <span id="span_createddate_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}">
                                            {{date('d/m/Y',strtotime($value['subcategory'][0]['subcatdiscount_rule'][0]['createddate']))}}
                                        </span>
                                    </td>
                                    <td>
                                        <span id="span_lastmodifiedby_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}">
                                            {{$value['subcategory'][0]['subcatdiscount_rule'][0]['lastmodifiedby'] ?? 0}}
                                        </span>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        @if($value['subcategory'][0]['subcatdiscount_rule'][0]['avgvalueforhigh'] == null && $value['subcategory'][0]['subcatdiscount_rule'][0]['discountdifferenceformid'] == null)
                                        <button title="Add rule" type="button" class="btn btn-primary btn-sm mb-1" onclick="changeRule('{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}','edit');" id="btn_edit_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        @else
                                        <button title="Edit rule" type="button" class="btn btn-primary btn-sm mb-1" onclick="changeRule('{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}','edit');" id="btn_edit_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        @endif
                                        <button title="Save rule" type="button" class="btn btn-primary btn-sm mb-1 dont-display" onclick="changeRule('{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}','save');" id="btn_save_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}">
                                            <i class="fa fa-save"></i>
                                        </button>
                                    </td>
                                    @else
                                    <td colspan="10" ></td>
                                    @endif
                                </tr>
                                @foreach($value['subcategory'][0]['subcatdiscount_rule'] as $rulekey => $rulevalue)
                                @if($rulevalue['typeid'] != -1)
                                <tr class="dont-display">
                                    <td ></td>
                                    <td ></td>
                                    <td>{{$rulevalue['typename'] ?? ''}}</td>
                                    <td>
                                        <input type="text" name="avgvalueforlow" id="avgvalueforlow_{{$rulevalue['id']}}" value="{{$rulevalue['avgvalueforlow'] ?? 0}}" class="form-control cls_input_{{$rulevalue['id']}} numbercommatxt dont-display">
                                        <span class="cls_span_{{$rulevalue['id']}}" id="span_avgvalueforlow_{{$rulevalue['id']}}">{{$rulevalue['avgvalueforlow'] ?? 0}}</span>
                                    </td>
                                    <td>
                                        <input type="text" name="discountdifferentforlow" id="discountdifferentforlow_{{$rulevalue['id']}}" value="{{$rulevalue['discountdifferentforlow'] ?? 0}}" class="form-control cls_input_{{$rulevalue['id']}} numbercommatxt dont-display">
                                        <span class="cls_span_{{$rulevalue['id']}}" id="span_discountdifferentforlow_{{$rulevalue['id']}}">
                                        {{$rulevalue['discountdifferentforlow'] ?? 0}}</span>
                                    </td>
                                    <td>
                                        <input type="text" name="discountdifferenceformid" id="discountdifferenceformid_{{$rulevalue['id']}}" value="{{$rulevalue['discountdifferenceformid'] ?? 0}}" class="form-control cls_input_{{$rulevalue['id']}} numbercommatxt dont-display">
                                        <span class="cls_span_{{$rulevalue['id']}}" id="span_discountdifferenceformid_{{$rulevalue['id']}}">
                                        {{$rulevalue['discountdifferenceformid'] ?? 0}}</span>
                                    </td>
                                    <td>
                                        <input type="text" name="avgvalueforhigh" id="avgvalueforhigh_{{$rulevalue['id']}}" value="{{$rulevalue['avgvalueforhigh'] ?? 0}}" class="form-control cls_input_{{$rulevalue['id']}} dont-display" >
                                        <span class="cls_span_{{$rulevalue['id']}} numbercommatxt" id="span_avgvalueforhigh_{{$rulevalue['id']}}">
                                        {{$rulevalue['avgvalueforhigh'] ?? 0}}</span>
                                    </td>
                                    <td>
                                        <input type="text" name="discountdifferenceforhigh" id="discountdifferenceforhigh_{{$rulevalue['id']}}" value="{{$rulevalue['discountdifferenceforhigh'] ?? 0}}" class="form-control cls_input_{{$rulevalue['id']}} dont-display"  >
                                        <span class="cls_span_{{$rulevalue['id']}} numbercommatxt" id="span_discountdifferenceforhigh_{{$rulevalue['id']}}">
                                        {{$rulevalue['discountdifferenceforhigh'] ?? 0}}</span>
                                    </td>
                                    <td>{{$rulevalue['avgsale'] ?? 0}}</td>
                                    <td><span id="span_createddate_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}">{{date('d/m/Y',strtotime($rulevalue['createddate']))}}</span></td>
                                    <td><span id="span_createdby_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}">{{$rulevalue['createdby']}}</span></td>
                                    <td><span id="span_lastmodifieddate_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}">{{date('d/m/Y',strtotime($rulevalue['lastmodifieddate']))}}</span></td>
                                    <td><span id="span_lastmodifiedby_{{$value['subcategory'][0]['subcatdiscount_rule'][0]['id']}}">{{$rulevalue['lastmodifiedby']}}</span></td>
                                    <td style="vertical-align: middle;">
                                        @if($rulevalue['avgvalueforhigh'] == null && $rulevalue['discountdifferenceformid'] == null)
                                        <button title="Add rule" type="button" class="btn btn-primary btn-sm mb-1" onclick="changeRule('{{$rulevalue['id']}}','edit');" id="btn_edit_{{$rulevalue['id']}}">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        @else
                                        <button title="Edit rule" type="button" class="btn btn-primary btn-sm mb-1" onclick="changeRule('{{$rulevalue['id']}}','edit');" id="btn_edit_{{$rulevalue['id']}}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        @endif
                                        <button title="Save rule" type="button" class="btn btn-primary btn-sm mb-1 dont-display" onclick="changeRule('{{$rulevalue['id']}}','save');" id="btn_save_{{$rulevalue['id']}}" >
                                            <i class="fa fa-save"></i>
                                        </button>
                                        @if($rulevalue['typename']!=null && $rulevalue['avgvalueforhigh'] != null && $rulevalue['discountdifferenceformid'] != null)
                                        <button title="Delete rule" type="button" class="btn btn-sm btn-danger"  onclick="deleteCatRule('{{$rulevalue['id']}}');" id="btn_delete_{{$rulevalue['id']}}">
                                            <i class="fa fa-trash-o" aria-hidden="true" ></i>
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                                @foreach($value['subcategory'] as $subkey => $subvalue)
                                @if($subkey>0)
                                    <tr class="sub-header dont-display" >
                                        <td ></td>
                                        <td class="sub-header-link">{{$subvalue['subcategoryname'] ?? ''}}</td>
                                        @if(count($subvalue['subcatdiscount_rule']) >0 &&  $subvalue['subcatdiscount_rule'][0]['typeid']== -1)
                                            <td>{{$subvalue['subcatdiscount_rule'][0]['typename'] ?? ''}}</td>
                                            <td>
                                                <input type="text" name="avgvalueforlow" id="avgvalueforlow_{{$subvalue['subcatdiscount_rule'][0]['id']}}" value="{{$subvalue['subcatdiscount_rule'][0]['avgvalueforlow'] ?? 0}}" class="form-control cls_input_{{$subvalue['subcatdiscount_rule'][0]['id']}} numbercommatxt dont-display" >
                                                <span class="cls_span_{{$subvalue['subcatdiscount_rule'][0]['id']}}" id="span_avgvalueforlow_{{$subvalue['subcatdiscount_rule'][0]['id']}}">{{$subvalue['subcatdiscount_rule'][0]['avgvalueforlow'] ?? 0}}</span>
                                            </td>
                                            <td>
                                                <input type="text" name="discountdifferentforlow" id="discountdifferentforlow_{{$subvalue['subcatdiscount_rule'][0]['id']}}" value="{{$subvalue['subcatdiscount_rule'][0]['discountdifferentforlow'] ?? 0}}" class="form-control cls_input_{{$subvalue['subcatdiscount_rule'][0]['id']}} numbercommatxt dont-display">
                                                <span class="cls_span_{{$subvalue['subcatdiscount_rule'][0]['id']}}" id="span_discountdifferentforlow_{{$subvalue['subcatdiscount_rule'][0]['id']}}">
                                                {{$subvalue['subcatdiscount_rule'][0]['discountdifferentforlow'] ?? 0}}</span>
                                            </td>
                                            <td>
                                                <input type="text" name="discountdifferenceformid" id="discountdifferenceformid_{{$subvalue['subcatdiscount_rule'][0]['id']}}" value="{{$subvalue['subcatdiscount_rule'][0]['discountdifferenceformid'] ?? 0}}" class="form-control cls_input_{{$subvalue['subcatdiscount_rule'][0]['id']}} numbercommatxt dont-display">
                                                <span class="cls_span_{{$subvalue['subcatdiscount_rule'][0]['id']}}" id="span_discountdifferenceformid_{{$subvalue['subcatdiscount_rule'][0]['id']}}">
                                                {{$subvalue['subcatdiscount_rule'][0]['discountdifferenceformid'] ?? 0}}</span>
                                            </td>
                                            <td>
                                                <input type="text" name="avgvalueforhigh" id="avgvalueforhigh_{{$subvalue['subcatdiscount_rule'][0]['id']}}" value="{{$subvalue['subcatdiscount_rule'][0]['avgvalueforhigh'] ?? 0}}" class="form-control cls_input_{{$subvalue['subcatdiscount_rule'][0]['id']}} dont-display">
                                                <span class="cls_span_{{$subvalue['subcatdiscount_rule'][0]['id']}} numbercommatxt" id="span_avgvalueforhigh_{{$subvalue['subcatdiscount_rule'][0]['id']}}">
                                                {{$subvalue['subcatdiscount_rule'][0]['avgvalueforhigh'] ?? 0}}</span>
                                            </td>
                                            <td>
                                                <input type="text" name="discountdifferenceforhigh" id="discountdifferenceforhigh_{{$subvalue['subcatdiscount_rule'][0]['id']}}" value="{{$subvalue['subcatdiscount_rule'][0]['discountdifferenceforhigh'] ?? 0}}" class="form-control cls_input_{{$subvalue['subcatdiscount_rule'][0]['id']}} dont-display">
                                                <span class="cls_span_{{$subvalue['subcatdiscount_rule'][0]['id']}} numbercommatxt" id="span_discountdifferenceforhigh_{{$subvalue['subcatdiscount_rule'][0]['id']}}">
                                                {{$subvalue['subcatdiscount_rule'][0]['discountdifferenceforhigh'] ?? 0}}</span>
                                            </td>
                                            <td>{{$subvalue['subcatdiscount_rule'][0]['avgsale'] ?? 0}}</td>
                                            <td>
                                                <span id="span_createddate_{{$subvalue['subcatdiscount_rule'][0]['id']}}">
                                                    {{date('d/m/Y',strtotime($subvalue['subcatdiscount_rule'][0]['createddate']))}}
                                                </span>
                                            </td>
                                            <td>
                                                <span id="span_createdby_{{$subvalue['subcatdiscount_rule'][0]['id']}}">
                                                    {{$subvalue['subcatdiscount_rule'][0]['createdby'] ?? 0}}
                                                </span>
                                            </td>
                                            <td>
                                                <span id="span_lastmodifieddate_{{$subvalue['subcatdiscount_rule'][0]['id']}}">
                                                    {{date('d/m/Y',strtotime($subvalue['subcatdiscount_rule'][0]['lastmodifieddate']))}}
                                                </span>
                                            </td>
                                            <td>
                                                <span id="span_lastmodifiedby_{{$subvalue['subcatdiscount_rule'][0]['id']}}">
                                                    {{$subvalue['subcatdiscount_rule'][0]['lastmodifiedby'] ?? 0}}
                                                </span>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                @if($subvalue['subcatdiscount_rule'][0]['avgvalueforhigh'] == null && $subvalue['subcatdiscount_rule'][0]['discountdifferenceformid'] == null)
                                                    <button title="Add rule" type="button" class="btn btn-primary btn-sm mb-1" onclick="changeRule('{{$subvalue['subcatdiscount_rule'][0]['id']}}','edit');" id="btn_edit_{{$subvalue['subcatdiscount_rule'][0]['id']}}">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                @else
                                                    <button title="Edit rule" type="button" class="btn btn-primary btn-sm mb-1" onclick="changeRule('{{$subvalue['subcatdiscount_rule'][0]['id']}}','edit');" id="btn_edit_{{$subvalue['subcatdiscount_rule'][0]['id']}}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                @endif
                                                <button title="Save rule" type="button" class="btn btn-primary btn-sm mb-1 dont-display" onclick="changeRule('{{$subvalue['subcatdiscount_rule'][0]['id']}}','save');" id="btn_save_{{$subvalue['subcatdiscount_rule'][0]['id']}}">
                                                    <i class="fa fa-save"></i>
                                                </button>
                                            </td>
                                        @else
                                            <td colspan="10" ></td>
                                        @endif
                                    </tr>
                                    @foreach($subvalue['subcatdiscount_rule'] as $rulekey => $rulevalue)
                                        @if($rulevalue['typeid'] != -1)
                                        <tr class="dont-display">
                                            <td ></td>
                                            <td ></td>
                                            <td>{{$rulevalue['typename'] ?? ''}}</td>
                                            <td>
                                                <input type="text" name="avgvalueforlow" id="avgvalueforlow_{{$rulevalue['id']}}" value="{{$rulevalue['avgvalueforlow'] ?? 0}}" class="form-control cls_input_{{$rulevalue['id']}} numbercommatxt dont-display">
                                                <span class="cls_span_{{$rulevalue['id']}}" id="span_avgvalueforlow_{{$rulevalue['id']}}">{{$rulevalue['avgvalueforlow'] ?? 0}}</span>
                                            </td>
                                            <td>
                                                <input type="text" name="discountdifferentforlow" id="discountdifferentforlow_{{$rulevalue['id']}}" value="{{$rulevalue['discountdifferentforlow'] ?? 0}}" class="form-control cls_input_{{$rulevalue['id']}} numbercommatxt dont-display">
                                                <span class="cls_span_{{$rulevalue['id']}}" id="span_discountdifferentforlow_{{$rulevalue['id']}}">
                                                {{$rulevalue['discountdifferentforlow'] ?? 0}}</span>
                                            </td>
                                            <td>
                                                <input type="text" name="discountdifferenceformid" id="discountdifferenceformid_{{$rulevalue['id']}}" value="{{$rulevalue['discountdifferenceformid'] ?? 0}}" class="form-control cls_input_{{$rulevalue['id']}} numbercommatxt dont-display">
                                                <span class="cls_span_{{$rulevalue['id']}}" id="span_discountdifferenceformid_{{$rulevalue['id']}}">
                                                {{$rulevalue['discountdifferenceformid'] ?? 0}}</span>
                                            </td>
                                            <td>
                                                <input type="text" name="avgvalueforhigh" id="avgvalueforhigh_{{$rulevalue['id']}}" value="{{$rulevalue['avgvalueforhigh'] ?? 0}}" class="form-control cls_input_{{$rulevalue['id']}} dont-display" >
                                                <span class="cls_span_{{$rulevalue['id']}} numbercommatxt" id="span_avgvalueforhigh_{{$rulevalue['id']}}">
                                                {{$rulevalue['avgvalueforhigh'] ?? 0}}</span>
                                            </td>
                                            <td>
                                                <input type="text" name="discountdifferenceforhigh" id="discountdifferenceforhigh_{{$rulevalue['id']}}" value="{{$rulevalue['discountdifferenceforhigh'] ?? 0}}" class="form-control cls_input_{{$rulevalue['id']}} dont-display"  >
                                                <span class="cls_span_{{$rulevalue['id']}} numbercommatxt" id="span_discountdifferenceforhigh_{{$rulevalue['id']}}">
                                                {{$rulevalue['discountdifferenceforhigh'] ?? 0}}</span>
                                            </td>
                                            <td>{{$rulevalue['avgsale'] ?? 0}}</td>
                                            <td><span id="span_lastmodifieddate_{{$subvalue['subcatdiscount_rule'][0]['id']}}">{{date('d/m/Y',strtotime($rulevalue['lastmodifieddate']))}}</span></td>
                                            <td><span id="span_lastmodifiedby_{{$subvalue['subcatdiscount_rule'][0]['id']}}">{{$rulevalue['lastmodifiedby']}}</span></td>
                                            <td><span id="span_createddate_{{$subvalue['subcatdiscount_rule'][0]['id']}}">{{date('d/m/Y',strtotime($rulevalue['createddate']))}}</span></td>
                                            <td><span id="span_createdby_{{$subvalue['subcatdiscount_rule'][0]['id']}}">{{$rulevalue['createdby']}}</span></td>
                                            <td style="vertical-align: middle;">
                                                @if($rulevalue['avgvalueforhigh'] == null && $rulevalue['discountdifferenceformid'] == null)
                                                    <button title="Add rule" type="button" class="btn btn-primary btn-sm mb-1" onclick="changeRule('{{$rulevalue['id']}}','edit');" id="btn_edit_{{$rulevalue['id']}}">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                @else
                                                    <button title="Edit rule" type="button" class="btn btn-primary btn-sm mb-1" onclick="changeRule('{{$rulevalue['id']}}','edit');" id="btn_edit_{{$rulevalue['id']}}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                @endif
                                                <button title="Save rule" type="button" class="btn btn-primary btn-sm mb-1 dont-display" onclick="changeRule('{{$rulevalue['id']}}','save');" id="btn_save_{{$rulevalue['id']}}" >
                                                    <i class="fa fa-save"></i>
                                                </button>
                                                @if($rulevalue['typename']!=null && $rulevalue['avgvalueforhigh'] != null && $rulevalue['discountdifferenceformid'] != null)
                                                    <button title="Delete rule" type="button" class="btn btn-sm btn-danger"  onclick="deleteCatRule('{{$rulevalue['id']}}');" id="btn_delete_{{$rulevalue['id']}}">
                                                        <i class="fa fa-trash-o" aria-hidden="true" ></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endif
                                @endforeach
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
$(document).ready(function() {
})
</script>
<script src="{{ asset('js/NonClubMemberDisc.js') }}" ></script>
@endsection
