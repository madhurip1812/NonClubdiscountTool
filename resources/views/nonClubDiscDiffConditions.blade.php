@extends('layouts.app')
@section('header')
@endsection
@section('content')
<div class="col-md-12 justify-content-center">
    <div class="row " >
        <div class="card col-md-12">
            <div class="card-header ">
                <label><h4> Non Club Discount Difference Conditions</h4></label>
                <div class="float-right"> 
                    <a class="btn btn-dark" type="button" href="{{url('editAllDiscountRules')}}"> 
                        Choose Rule to edit
                    </a> 
                </div>
            </div>
            <div class="card-body">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">   
                @foreach($categories as $key => $value)
                <div class="row border-bottom" id="accordion{{$key}}">
                    <div class="col-md-1 collapse-heading-div" id="heading{{$value['productcatid']}}">
                        <label class="font-weight-bold collapse-heading" data-toggle="collapse" data-target="#collapse{{$value['productcatid']}}" aria-expanded="true" aria-controls="collapse{{$value['productcatid']}}">
                            {{$value['categoryname'] ?? ''}}
                        </label>
                    </div>
                    <div id="collapse{{$value['productcatid']}}" class="collapse col-md-11" aria-labelledby="heading{{$value['productcatid']}}" data-parent="#accordion{{$key}}" >
                        @foreach($value['subcategory'] as $subkey => $subvalue)
                        @if(count($subvalue['subcatdiscount_rule']) >0 )
                            <div id="subaccordion{{$subkey}}" class="row border-bottom">
                                <div class="col-md-1 collapse-heading-div" id="subheading{{$subvalue['subcatid']}}">
                                    <label class="collapse-heading font-weight-bold" data-toggle="collapse" data-target="#subcollapse{{$subvalue['subcatid']}}" aria-expanded="true" aria-controls="subcollapse{{$subvalue['subcatid']}}">
                                        {{$subvalue['subcategoryname'] ?? ''}}
                                    </label>
                                </div>
                                <div id="subcollapse{{$subvalue['subcatid']}}" class="collapse col-md-11" aria-labelledby="subheading{{$subvalue['subcatid']}}" data-parent="#subaccordion{{$subkey}}">
                                    <div class="alert alert-danger dont-display" role="alert" id="error-msg-block{{$subvalue['subcatid']}}">
                                        <button type="button" class="close" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <span id="error-msg-span{{$subvalue['subcatid']}}"></span>
                                    </div>
                                    <div class="alert alert-success dont-display" role="alert" id="success-msg-block{{$subvalue['subcatid']}}">
                                        <span id="success-msg-span{{$subvalue['subcatid']}}"></span>
                                        <button type="button" class="close" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="table-responsive" id="typeLevelDiv{{$subvalue['subcatid']}}">     
                                        <table id="typeLevelTable{{$subvalue['subcatid']}}" class="table catSubCatRuleTable">
                                        @php($isSubCatLevel = $subvalue['subcatdiscount_rule'][0]['typeid'] == -1) 
                                            <thead class="thead-dark">
                                                <tr>
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
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="typeLevelTableBody{{$subvalue['subcatid']}}">
                                                @if(!$isSubCatLevel)
                                                <tr>
                                                    <input type="hidden" value="{{$value['productcatid']}}" id="categoryid_new-{{$subvalue['subcatid']}}">
                                                    <input type="hidden" value="{{$subvalue['subcatid']}}" id="subcategoryid_new-{{$subvalue['subcatid']}}">
                                                    <td>{{'Rest All'}}</td>
                                                    <td>
                                                        <input type="text" name="avgvalueforlow" id="avgvalueforlow_new-{{$subvalue['subcatid']}}" value="0" class="form-control cls_input_new-{{$subvalue['subcatid']}} numbercommatxt dont-display">
                                                        <span class="cls_span_new-{{$subvalue['subcatid']}}" id="span_avgvalueforlow_new-{{$subvalue['subcatid']}}">0</span>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="discountdifferentforlow" id="discountdifferentforlow_new-{{$subvalue['subcatid']}}" value="0" class="form-control cls_input_new-{{$subvalue['subcatid']}} numbercommatxt dont-display">
                                                        <span class="cls_span_new-{{$subvalue['subcatid']}}" id="span_discountdifferentforlow_new-{{$subvalue['subcatid']}}">
                                                        0</span>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="discountdifferenceformid" id="discountdifferenceformid_new-{{$subvalue['subcatid']}}" value="0" class="form-control cls_input_new-{{$subvalue['subcatid']}} numbercommatxt dont-display">
                                                        <span class="cls_span_new-{{$subvalue['subcatid']}}" id="span_discountdifferenceformid_new-{{$subvalue['subcatid']}}">
                                                        0</span>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="avgvalueforhigh" id="avgvalueforhigh_new-{{$subvalue['subcatid']}}" value="0" class="form-control cls_input_new-{{$subvalue['subcatid']}} dont-display" >
                                                        <span class="cls_span_new-{{$subvalue['subcatid']}} numbercommatxt" id="span_avgvalueforhigh_new-{{$subvalue['subcatid']}}">
                                                        0</span>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="discountdifferenceforhigh" id="discountdifferenceforhigh_new-{{$subvalue['subcatid']}}" value="0" class="form-control cls_input_new-{{$subvalue['subcatid']}} dont-display"  >
                                                        <span class="cls_span_new-{{$subvalue['subcatid']}} numbercommatxt" id="span_discountdifferenceforhigh_new-{{$subvalue['subcatid']}}">
                                                        0</span>
                                                    </td>
                                                    <td>0</td>
                                                    <!-- <td>
                                                    <span id="span_createddate_new-{{$subvalue['subcatid']}}">
                                                    {{date('d/m/Y',strtotime($rulevalue['createddate']))}}
                                                    </span>
                                                    </td>
                                                    <td>
                                                    <span id="span_createdby_new-{{$subvalue['subcatid']}}">
                                                    {{$rulevalue['createdby']}}
                                                    </span>
                                                    </td> -->
                                                    <td>
                                                        <span id="span_lastmodifieddate_new-{{$subvalue['subcatid']}}">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span id="span_lastmodifiedby_new-{{$subvalue['subcatid']}}"></span>
                                                    </td>
                                                    <td class="ver-aligned" >
                                                        <button title="Add rule" type="button" class="btn btn-primary btn-sm mb-1 editRuleBtn"  id="btn_edit_new-{{$subvalue['subcatid']}}">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                        <button  data-sub-cat-id="{{$subvalue['subcatid']}}" title="Save rule" type="button" class="btn btn-primary btn-sm mb-1 dont-display saveRuleBtn" id="btn_save_new-{{$subvalue['subcatid']}}" >
                                                            <i class="fa fa-save"></i>
                                                        </button>
                                                    </td>
                                                    <td>-1</td>
                                                </tr>
                                                @endif
                                                @foreach($subvalue['subcatdiscount_rule'] as $rulekey => $rulevalue)
                                                <tr>
                                                    <input type="hidden" value="{{$subvalue['subcatid']}}" id="subcategoryid_{{$rulevalue['id']}}">
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
                                                    <!-- <td>
                                                    <span id="span_createddate_{{$rulevalue['id']}}">
                                                    {{date('d/m/Y',strtotime($rulevalue['createddate']))}}
                                                    </span>
                                                    </td>
                                                    <td>
                                                    <span id="span_createdby_{{$rulevalue['id']}}">
                                                    {{$rulevalue['createdby']}}
                                                    </span>
                                                    </td> -->
                                                    <td>
                                                        <span id="span_lastmodifieddate_{{$rulevalue['id']}}">
                                                            {{date('d/m/Y',strtotime($rulevalue['lastmodifieddate']))}}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span id="span_lastmodifiedby_{{$rulevalue['id']}}">{{$rulevalue['lastmodifiedby']}}</span>
                                                    </td>
                                                    <td class="ver-aligned" >
                                                        @if($rulevalue['avgvalueforhigh'] == null && $rulevalue['discountdifferenceformid'] == null)
                                                        <button @if(!$isSubCatLevel) disabled='disabled' @endif title="Add rule" type="button" class="btn btn-primary btn-sm mb-1 action-btn-{{$subvalue['subcatid']}} editRuleBtn" id="btn_edit_{{$rulevalue['id']}}">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                        @else
                                                        <button @if(!$isSubCatLevel) disabled='disabled' @endif title="Edit rule" type="button" class="btn btn-primary btn-sm mb-1 action-btn-{{$subvalue['subcatid']}} editRuleBtn" id="btn_edit_{{$rulevalue['id']}}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        @endif
                                                        <button  data-sub-cat-id="{{$subvalue['subcatid']}}" title="Save rule" type="button" class="btn btn-primary btn-sm mb-1 dont-display saveRuleBtn" id="btn_save_{{$rulevalue['id']}}" >
                                                            <i class="fa fa-save"></i>
                                                        </button>
                                                        @if($rulevalue['typeid']!=-1 && $rulevalue['avgvalueforhigh'] != null && $rulevalue['avgvalueforhigh'] != 0)
                                                        <button title="Delete rule" type="button" class="btn btn-sm btn-danger"  onclick="deleteCatRule('{{$rulevalue['id']}}');" id="btn_delete_{{$rulevalue['id']}}">
                                                            <i class="fa fa-trash-o" aria-hidden="true" ></i>
                                                        </button>
                                                        @endif
                                                    </td>
                                                    <td>{{$rulevalue['typeid']}}</td>
                                                </tr>
                                                @endforeach 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>                           
                        @endif
                        @endforeach
                    </div>
                </div>
                @endforeach
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
