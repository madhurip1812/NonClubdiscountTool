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
            <input type="hidden" value="{{$subvalue['productcatid']}}" id="categoryid_new-{{$subvalue['subcatid']}}">
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
            <td>{{ ($rulevalue['typeid']==-1) ? 'Rest All' : $rulevalue['typename'] ?? ''}}</td>
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