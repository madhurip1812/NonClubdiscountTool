$(document).ready(function(){
    $.noConflict();
    defineDatatable();
    var urlParams = new URLSearchParams(window.location.search);
    if(urlParams.has('product')){
        $("#cat-tab").removeClass('active');
        $("#CatRuleDiv").removeClass('show active');

        $("#prod-tab").addClass('active');
        $("#ProdRuleDiv").addClass('show active');
    }
    if(window.history != undefined && window.history.pushState != undefined) {
        window.history.pushState({}, document.title, window.location.pathname);
    }
    $(".card-body").on("click",".rd_discount_type",function(){
        var arrId = this.id.split("_");
        if(this.value=='category'){
            $("#sel_category_"+arrId[2]).next().find('.amsify-selection-label').removeClass('amsify-select-disabled');
            $("#sel_sub_category_"+arrId[2]).next().find('.amsify-selection-label').addClass('amsify-select-disabled');
            $("#sel_type_level_"+arrId[2]).next().find('.amsify-selection-label').addClass('amsify-select-disabled');
            $("#txt_product_"+arrId[2]).attr('disabled','disabled');
        } else if(this.value=='sub_category'){
            $("#sel_sub_category_"+arrId[2]).next().find('.amsify-selection-label').removeClass('amsify-select-disabled');
            $("#sel_category_"+arrId[2]).next().find('.amsify-selection-label').removeClass('amsify-select-disabled');
            $("#sel_type_level_"+arrId[2]).next().find('.amsify-selection-label').addClass('amsify-select-disabled');
            $("#txt_product_"+arrId[2]).attr('disabled','disabled');
            //$("#sel_category_"+arrId[2]).next().find('.amsify-selection-label').addClass('amsify-select-disabled');
        } else if(this.value=='type_level'){
            $("#sel_type_level_"+arrId[2]).next().find('.amsify-selection-label').removeClass('amsify-select-disabled');
            $("#txt_product_"+arrId[2]).attr('disabled','disabled');
            $("#sel_category_"+arrId[2]).next().find('.amsify-selection-label').addClass('amsify-select-disabled');
            $("#sel_sub_category_"+arrId[2]).next().find('.amsify-selection-label').addClass('amsify-select-disabled');
        } else if(this.value=='product'){
            $("#txt_product_"+arrId[2]).removeAttr('disabled');
            $("#sel_category_"+arrId[2]).next().find('.amsify-selection-label').addClass('amsify-select-disabled');
            $("#sel_sub_category_"+arrId[2]).next().find('.amsify-selection-label').addClass('amsify-select-disabled');
            $("#sel_type_level_"+arrId[2]).next().find('.amsify-selection-label').addClass('amsify-select-disabled');
        }
    });
    $(".collapse-heading").click(function(){
        $(this).parent().toggleClass('active');
        if($(this).parent().attr('id').indexOf('subheading') != -1){
            $(this).parent().toggleClass('col-md-3').toggleClass('col-md-1');
            $(this).parent().next('.collapse').toggleClass('col-md-9').toggleClass('col-md-11');
            if($(this).parent().hasClass('col-md-1')){
                var subCategoryId = $(this).attr('id');
                getSubCatWiseDetail(subCategoryId);
                
            }
        }
    });
});
function getSubCatWiseDetail(subCategoryId) {
    $.ajax({
        type:'GET',
        url:"./getSubCatWiseDetail",
        data:{'subCategoryId':subCategoryId},
        success:function(output) {
            $("#typeLevelDiv"+subCategoryId).html(output.html);
            $("#typeLevelTable"+subCategoryId).DataTable({
                "retrieve": true,
                "order": [[ 10, "asc" ]],
                "columnDefs": [
                    {
                        "targets": [ 10 ],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "targets": [9],
                        "orderable": false
                    },
                    {
                        "targets": 0,
                        "className": 'custom-width'
                    }
                ]
            });
        }
    });
}
function defineDatatable(){
    return $('.catSubCatRuleTable').DataTable({
        "retrieve": true,
        "order": [[ 10, "asc" ]],
        "columnDefs": [
            {
                "targets": [ 10 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [9],
                "orderable": false
            }
        ]
    });
}
$('.table-responsive').on("click", ".editRuleBtn", function(){
    var arrId = this.id.split('_');
    var iid = arrId[2];
    changeRule(iid,'edit');
});
$('.table-responsive').on("click", ".saveRuleBtn", function(){
    var arrId = this.id.split('_');
    var iid = arrId[2];
    changeRule(iid,'save');
});
$(".cls_category").change(function(){
    $('#overlay').fadeIn();
    var arrId = this.id.split("_");
    var i = arrId[2];
    clearInputVal(i);
    $("#id_"+i).val('');
    var value = this.value;
    if(value!=''){
        $.ajax({
            type:'GET',
            url:"./getSubCategories",
            data:{'categoryid':value},
            //dataType:'json',
            success:function(output) {
                $('#overlay').fadeOut();
                var html = '<option value="">Select Sub Category</option>';
                $.each(output, function( key, value ) {  
                    html += '<option value="'+value['subcatid']+'">'+value['subcategoryname']+'</option>';
                });
                $("#sel_sub_category_"+i).html(html);
            }
        });
    }
});
$("#sel_type_level_1").change(function(){
    checkExistingRule('type');
});
$(".cls_sub_category").change(function(){
    getProductTypes();
    checkExistingRule('subcat');
});
$(".close").click(function(){
    $(this).parent().hide();
});
$("#add_more_grid").click(function(){
    var count = $(".cls_grid").length + 1;
    var newElement = $("#id_grid1").clone().find("input").val("").end();
    newElement.attr('id','id_grid'+count);
    newElement.find('.updateCatRuleForm').attr('id','catRuleform'+count);

    newElement.find('.low_disc').attr('id','low_disc_'+count);
    newElement.find('.med_disc').attr('id','med_disc_'+count);
    newElement.find('.high_disc').attr('id','high_disc_'+count);

    //Radio buttons
    newElement.find('#rd_category_0').attr('id','rd_category_'+count).attr('name','discount_type_'+count);
    newElement.find('#rd_subcategory_0').attr('id','rd_subcategory_'+count).attr('name','discount_type_'+count);
    newElement.find('#rd_typelevel_0').attr('id','rd_typelevel_'+count).attr('name','discount_type_'+count);
    newElement.find('#rd_product_0').attr('id','rd_product_'+count).attr('name','discount_type_'+count);

    //Dropdowns
    newElement.find('#sel_category_0').attr('id','sel_category_'+count);
    newElement.find('#sel_sub_category_0').attr('id','sel_sub_category_'+count);
    newElement.find('#sel_type_level_0').attr('id','sel_type_level_'+count);
    newElement.find('#txt_product_0').attr('id','txt_product_'+count);

    newElement.find('.btn_edit_save').attr('id','btn_edit_'+count);
    newElement.appendTo(".card-body");
    newElement.show();
});
$("#btn_clr_1").click(function(){
    clearInputVal(1);
});
$("#prod_rule_search").click(function(){
    var strProductIds = $("#product_ids").val();
    if(strProductIds==''){
        $("#product_ids-error").show();
    }else{
        $("#product_ids-error").hide();
        var arrProductIds = strProductIds.split(",");
        $('#overlay').fadeIn();
        $.ajax({
            type:'GET',
            url:"searchProductDiscRule",
            data:{'arrProductIds':arrProductIds},
            //dataType:'json',
            success:function(output) {
                $('#overlay').fadeOut();
                if(output.found!=''){
                    $("#prod_disc_rule_tbody").html(output.found);
                    $("#prod_disc_rule_div").show();
                } if(output.notfound!=''){
                    $("#error-msg-span-prod").html('Products with id ' +output.notfound+ ' are not found');
                    $("#success-msg-block-prod").hide();
                    showSuccessError('error-msg-block-prod');
                }
                $('#editProdRuleTable').DataTable();
            }
        });
    }
});
$('.updateCatRuleForm').validate({
    ignore: [],
    rules: {
        'category[]': "required",
        'sub_category[]': "required",
        //'type_level[]': "required",
        'avgvalueforlow[]': {
            required: function(element){
                // if($('#sel_type_level_1').val() != '')
                //     return $("#low_disc_1").val() != '' || $("#avgvalueforhigh_1").val() != ''  || $("#med_disc_1").val() != ''  || $("#high_disc_1").val() != '' ;
                // else
                    return true;
            },
            number: true,
            max: 100,
            min: 1,
        },
        'avgvalueforhigh[]': {
            required: function(element){
                // if($('#sel_type_level_1').val() != '')
                //     return $("#low_disc_1").val() != '' || $("#avgvalueforlow_1").val() != ''  || $("#med_disc_1").val() != ''  || $("#high_disc_1").val() != '' ;
                // else
                    return true;
            },
            number: true,
            max: 100,
            min: 1,
        },
        'low_disc[]': {
            required: function(element){
                // if($('#sel_type_level_1').val() != '')
                //     return $("#avgvalueforlow_1").val() != '' || $("#avgvalueforhigh_1").val() != ''  || $("#med_disc_1").val() != ''  || $("#high_disc_1").val() != '' ;
                // else
                    return true;
            },
            number: true,
            max: 100,
            min: 1,
        },
        'med_disc[]': {
            required: function(element){
                // if($('#sel_type_level_1').val() != '')
                //     return $("#low_disc_1").val() != '' || $("#avgvalueforhigh_1").val() != ''  || $("#avgvalueforlow_1").val() != ''  || $("#high_disc_1").val() != '' ;
                // else
                    return true;
            },
            number: true,
            max: 100,
            min: 1,
        },
        'high_disc[]': {
            required: function(element){
                // if($('#sel_type_level_1').val() != '')
                //     return $("#low_disc_1").val() != '' || $("#avgvalueforhigh_1").val() != ''  || $("#med_disc_1").val() != ''  || $("#avgvalueforlow_1").val() != '' ;
                // else
                    return true;
            },
            number: true,
            max: 100,
            min: 1,
        },
    },
    // Specify validation error messages
    messages: {
        category: "Select Category",
        'avgvalueforlow[]'  : {
            required: 'Please enter avg value for low',
            number: 'Please enter numeric value',
            max: 'Value should be less than or equal to 100',
            min: 'Value should be greater than 0'
        },
        'avgvalueforhigh[]'  : {
            required: 'Please enter avg value for high',
            number: 'Please enter numeric value',
            max: 'Value should be less than or equal to 100',
            min: 'Value should be greater than 0'
        },
        'low_disc[]'  : {
            required: 'Please enter discount',
            number: 'Please enter numeric value',
            max: 'Value should be less than or equal to 100',
            min: 'Value should be greater than 0'
        },
        'med_disc[]'  : {
            required: 'Please enter discount',
            number: 'Please enter numeric value',
            max: 'Value should be less than or equal to 100',
            min: 'Value should be greater than 0'
        },
        'high_disc[]'  : {
            required: 'Please enter discount',
            number: 'Please enter numeric value',
            max: 'Value should be less than or equal to 100',
            min: 'Value should be greater than 0'
        },
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    highlight: function (element, errorClass, validClass) {
       var elem = $(element);
       if (elem.hasClass("select2-hidden-accessible")) {
           $("#select2-" + elem.attr("id") + "-container").parent().addClass(errorClass); 
       } else {
           elem.addClass(errorClass);
       }
     },    
     unhighlight: function (element, errorClass, validClass) {
         var elem = $(element);
         if (elem.hasClass("select2-hidden-accessible")) {
              $("#select2-" + elem.attr("id") + "-container").parent().removeClass(errorClass);
         } else {
             elem.removeClass(errorClass);
         }
     },
     errorPlacement: function(error, element) {
       var elem = $(element);
       if (elem.hasClass("select2-hidden-accessible")) {
           element = $("#select2-" + elem.attr("id") + "-container").parent(); 

           error.addClass('text-danger').insertAfter(element);
       } else {
           error.addClass('text-danger').insertAfter(element);
       }
     },
    submitHandler: function(form) {
        //if (confirm("Are you sure to save/edit?")==true) {
            addOrUpdateCategoryRule();
        //}
    }
});
$("#reset_prod_search").click(function(){
    $("#product_ids").val('');
    $("#prod_disc_rule_tbody").html('');
    $("#prod_disc_rule_div").hide();
});
$(document).on("keydown",".numbercommatxt",function(e){
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 188]) !== -1 ||
        // Allow: Ctrl+A
    (e.ctrlKey === true) ||
        // Allow: home, end, left, right, down, up
    (e.keyCode >= 35 && e.keyCode <= 40)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});
function changeProdRule(id,type) {
    if(type=='edit' || type=='add'){
        $(".cls_input_"+id).show();
        $(".cls_span_"+id).hide();
        $("#btn_prod_disc_save_"+id).show();
        $("#btn_prod_disc_edit_"+id).hide();       
    } else if(type=='save'){
        var nonclubdiscountdifference = $("#nonclubdiscountdifference_"+id).val();
        if(nonclubdiscountdifference=='' || isNaN(nonclubdiscountdifference) || nonclubdiscountdifference<1){
            $("#nonclubdiscountdifference_"+id).addClass('border border-danger');
            $("#err-nonclubdiscountdifference_"+id).show();
        } else{
            $('#overlay').fadeIn();
            var token = $("#token").val();
            $.ajax({
                type:'POST',
                url:"./updateProductDiscountRule",
                data:{'productid':id,'nonclubdiscountdifference':nonclubdiscountdifference,'_token': token},
                //dataType:'json',
                success:function(output) {
                    $('#overlay').fadeOut();
                    if(output.success){
                        var lmDate = new Date(output.data.lastmodifieddate);
                        $(".cls_input_"+id).hide();
                        $("#err-nonclubdiscountdifference_"+id).hide();
                        $(".cls_span_"+id).show();
                        $("#span_nonclubdiscountdifference_"+id).text(output.data.nonclubdiscountdifference);
                        $("#span_nonclubdiscountdifferencetype_"+id).text(output.data.nonclubdiscountdifferencetype);
                        $("#span_lastmodifiedby_"+id).text(output.data.lastmodifiedby);
                        $("#span_lastmodifieddate_"+id).text(lmDate.getDate()+"/"+(lmDate.getMonth() + 1)+"/"+lmDate.getFullYear());
                        $("#btn_prod_disc_save_"+id).hide();
                        //$("#btn_prod_disc_edit_"+id).show();
                        $("#btn_prod_disc_edit_"+id).removeClass('btn-secondary').addClass('btn-primary').attr('title','Edit Rule').html('<i class="fa fa-edit"></i>').show();
                        $("#success-msg-span-prod").html('Rule added/Edited successfully!');
                        //$("#success-msg-block-prod").show();
                        showSuccessError('success-msg-block-prod');
                        $("#error-msg-block-prod").hide();
                        if(nonclubdiscountdifference>0)
                            $("#btn_prod_disc_delete_"+id).show();
                        else
                            $("#btn_prod_disc_delete_"+id).hide();
                    } else {
                        $("#error-msg-span-prod").html('Something went wrong!');
                        $("#success-msg-block-prod").hide();
                        //$("#error-msg-block-prod").show();
                        showSuccessError('error-msg-block-prod');
                    }
                }
            });
        }
    }
}
function deleteProdRule(id) {
    if (confirm("Are you sure to delete the rule?")==true) {
        var token = $("#token").val();
        $.ajax({
            type:'POST',
            url:"./updateProductDiscountRule",
            data:{'productid':id,'nonclubdiscountdifference':0,'_token': token},
            //dataType:'json',
            success:function(output) {
                if(output.success){
                    var lmDate = new Date(output.data.lastmodifieddate);
                    $(".cls_input_"+id).hide();
                    $("#err-nonclubdiscountdifference_"+id).hide();
                    $(".cls_span_"+id).show();
                    $("#span_nonclubdiscountdifference_"+id).text(output.data.nonclubdiscountdifference);
                    $("#nonclubdiscountdifference_"+id).val(output.data.nonclubdiscountdifference);
                    $("#span_nonclubdiscountdifferencetype_"+id).text(output.data.nonclubdiscountdifferencetype);
                    $("#span_lastmodifiedby_"+id).text(output.data.lastmodifiedby);
                    $("#span_lastmodifieddate_"+id).text(lmDate.getDate()+"/"+(lmDate.getMonth() + 1)+"/"+lmDate.getFullYear());
                    $("#btn_prod_disc_save_"+id).hide();
                    $("#btn_prod_disc_edit_"+id).show();
                    $("#success-msg-span-prod").html('Rule deleted successfully!');
                    showSuccessError('success-msg-block-prod');
                    $("#error-msg-block-prod").hide();
                    $("#btn_prod_disc_delete_"+id).hide();
                } else {
                    $("#error-msg-span-prod").html('Something went wrong!');
                    $("#sucess-msg-block-prod").hide();
                    showSuccessError('error-msg-block-prod');
                }
            }
        });
    }
}
function deleteCatRule(id) {
    if (confirm("Are you sure to delete the rule?")==true) {
        var token = $("#token").val();
        var subcategoryid = $("#subcategoryid_"+id).val();
        $.ajax({
            type:'POST',
            url:"./updateCategoryDiscountRule/"+id,
            data:{'subcategoryid':subcategoryid,'avgvalueforlow':null,'discountdifferentforlow':null,'discountdifferenceformid':null,'avgvalueforhigh':null ,'discountdifferenceforhigh':null,'_token': token,'action':'delete_rule'},
            success:function(output) {
                if(output.success){
                    $(".cls_input_"+id).val(0).hide();
                    $(".cls_span_"+id).text(0).show();
                    $("#btn_delete_"+id).remove();
                    $("#success-msg-span").html('Rule deleted successfully!');
                    showSuccessError('success-msg-block');
                    $("#error-msg-block").hide();
                    $("#btn_save_"+id).hide();
                    $("#btn_edit_"+id).html('<i class="fa fa-plus"></i>').attr('title','Add Rule').show();
                } else{
                    var errMsg = '';
                    $.each(output.errors, function( key, value ) {
                        errMsg += value;
                        errMsg += '<br>';
                    });
                    $("#error-msg-span").html(errMsg);
                    $("#success-msg-block").hide();
                    //$("#error-msg-block").show();
                    showSuccessError('error-msg-block');
                }
            }
        });
    }
}
function changeRule(id,type) {
    if(type=='edit'){
        $(".cls_input_"+id).show();
        $(".cls_span_"+id).hide();
        $("#btn_save_"+id).show();
        $("#btn_edit_"+id).hide();       
    } else if(type=='save'){
        var errCount = 0;
        $('.cls_input_'+id).each(function(i, obj) {           
            if(this.value=='' || isNaN(this.value) || this.value>100 || this.value<=0){
                errCount++;
                $(this).addClass('border border-danger');
            }
            else
                $(this).removeClass('border border-danger');
        });
        if(errCount>0){
            alert('Enter all fields with valid numeric values which is greater than zero and less than 100');
        } else{
            $('#overlay').fadeIn();
            var subcategoryid = $("#subcategoryid_"+id).val();
            var categoryid = $("#categoryid_"+id).val();
            var avgvalueforlow = $("#avgvalueforlow_"+id).val();
            var discountdifferentforlow = $("#discountdifferentforlow_"+id).val();
            var discountdifferenceformid = $("#discountdifferenceformid_"+id).val();
            var avgvalueforhigh = $("#avgvalueforhigh_"+id).val();
            var discountdifferenceforhigh = $("#discountdifferenceforhigh_"+id).val();
            var token = $("#token").val();

            var arrId = id.split("-");
            if(arrId.length>1){
                var url = "addCategoryDiscountRule";
                var data = {'categoryid':categoryid,'subcategoryid':subcategoryid,'typename':null,'avgvalueforlow':avgvalueforlow,'discountdifferentforlow':discountdifferentforlow,'discountdifferenceformid':discountdifferenceformid,'avgvalueforhigh':avgvalueforhigh ,'discountdifferenceforhigh':discountdifferenceforhigh,'_token': token};
            } else {
                var url = "./updateCategoryDiscountRule/"+id;
                var data = {'subcategoryid':subcategoryid, 'avgvalueforlow':avgvalueforlow,'discountdifferentforlow':discountdifferentforlow,'discountdifferenceformid':discountdifferenceformid,'avgvalueforhigh':avgvalueforhigh ,'discountdifferenceforhigh':discountdifferenceforhigh,'_token': token};
            }
            $.ajax({
                type:'POST',
                url:url,
                data:data,
                success:function(output) {
                    $('#overlay').fadeOut();
                    if(output.success){
                        getSubCatWiseDetail(subcategoryid);
                        /*var lmDate = new Date(output.data.lastmodifieddate);
                        $("#span_avgvalueforlow_"+id).text(output.data.avgvalueforlow);
                        $("#span_discountdifferentforlow_"+id).text(output.data.discountdifferentforlow);
                        $("#span_discountdifferenceformid_"+id).text(output.data.discountdifferenceformid);
                        $("#span_avgvalueforhigh_"+id).text(output.data.avgvalueforhigh);
                        $("#span_discountdifferenceforhigh_"+id).text(output.data.discountdifferenceforhigh);
                        $("#span_lastmodifiedby_"+id).text(output.data.lastmodifiedby);
                        $("#span_lastmodifieddate_"+id).text(lmDate.getDate()+"/"+(lmDate.getMonth() + 1)+"/"+lmDate.getFullYear());
                        $(".cls_input_"+id).hide();
                        $(".cls_span_"+id).show();
                        $("#btn_save_"+id).hide();
                        $("#btn_edit_"+id).removeClass('btn-secondary').addClass('btn-primary').attr('title','Edit Rule').html('<i class="fa fa-edit"></i>').show();
                        if(arrId.length>1){
                            $("#categoryid_"+id).attr('id',"categoryid_"+output.data.id);
                            $("#subcategoryid_"+id).attr('id',"subcategoryid_"+output.data.id);
                            $("#avgvalueforlow_"+id).attr('id',"avgvalueforlow_"+output.data.id);
                            $("#span_avgvalueforlow_"+id).attr('id',"span_avgvalueforlow_"+output.data.id);
                            $("#discountdifferentforlow_"+id).attr('id',"discountdifferentforlow_"+output.data.id);
                            $("#span_discountdifferentforlow_"+id).attr('id',"span_discountdifferentforlow_"+output.data.id);
                            $("#discountdifferenceformid_"+id).attr('id',"discountdifferenceformid_"+output.data.id);
                            $("#span_discountdifferenceformid_"+id).attr('id',"span_discountdifferenceformid_"+output.data.id);
                            $("#avgvalueforhigh_"+id).attr('id',"avgvalueforhigh_"+output.data.id);
                            $("#span_avgvalueforhigh_"+id).attr('id',"span_avgvalueforhigh_"+output.data.id);
                            $("#discountdifferenceforhigh_"+id).attr('id',"discountdifferenceforhigh_"+output.data.id);
                            $("#span_lastmodifieddate_"+id).attr('id',"span_lastmodifieddate_"+output.data.id);
                            $("#span_lastmodifiedby_"+id).attr('id',"span_lastmodifiedby_"+output.data.id);
                            $('.cls_input_'+id).removeClass('cls_input_'+id).addClass('cls_input_'+output.data.id);
                            $('.cls_span_'+id).removeClass('cls_span_'+id).addClass('cls_span_'+output.data.id);
                            $(".action-btn-"+subcategoryid).removeAttr('disabled');
                        }
                        if(arrId.length<=1 && $("#btn_delete_"+id).length==0){
                            $( '<button title="Delete rule" type="button" class="btn btn-sm btn-danger"  onclick="deleteCatRule('+id+');" id="btn_delete_'+id+'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>' ).insertAfter( "#btn_edit_"+id );
                        }*/
                        $("#success-msg-span"+subcategoryid).html('Rule edited successfully!');
                        $("#error-msg-block"+subcategoryid).hide();
                        showSuccessError('success-msg-block'+subcategoryid);
                        //$("#typeLevelTable"+subcategoryid).load(location.href + " #typeLevelTable"+subcategoryid);
                    } else{
                        var errMsg = '';
                        $.each(output.errors, function( key, value ) {
                            errMsg += value;
                            errMsg += '<br>';
                        });
                        $("#error-msg-span"+subcategoryid).html(errMsg);
                        $("#success-msg-block"+subcategoryid).hide();
                        //$("#error-msg-block").show();
                        showSuccessError('error-msg-block'+subcategoryid);
                    }
                }
            });
        }
    }
}
function clearInputVal(index) {
    $('#avgvalueforlow_'+index).val('');
    $('#low_disc_'+index).val('');
    $('#med_disc_'+index).val('');
    $('#avgvalueforhigh_'+index).val('');
    $('#high_disc_'+index).val('');
}
function checkExistingRule(type){
    $('#overlay').fadeIn();
    clearInputVal(1);
    $("#id_1").val('');
    var subCatId    = $("#sel_sub_category_1").val();
    var typeName    = $("#sel_type_level_1").val();
    $.ajax({
        type:'GET',
        url:"./getExistingRule",
        data:{'subCatId':subCatId,'typeName':typeName},
        success:function(output) {
            $('#overlay').fadeOut();
            if(output.success==true && output.data != null){
                $("#id_1").val(output.data.id);
                $("#avgvalueforlow_1").val(output.data.avgvalueforlow);
                $("#avgvalueforhigh_1").val(output.data.avgvalueforhigh);
                $("#low_disc_1").val(output.data.discountdifferentforlow);
                $("#med_disc_1").val(output.data.discountdifferenceformid);
                $("#high_disc_1").val(output.data.discountdifferenceforhigh);
                $("#btn_edit_1").html('Save').val('edit');
                $("#error-msg-block").hide();
                $('#sel_type_level_1').removeAttr('disabled');
            } else {
                $('#sel_type_level_1').removeAttr('disabled');
                $("#id_1").val('');
                $("#avgvalueforlow_1").val('');
                $("#avgvalueforhigh_1").val('');
                $("#low_disc_1").val('');
                $("#med_disc_1").val('');
                $("#high_disc_1").val('');
                $("#btn_edit_1").html('Save').val('save');
            }
            if(output.subCatLevelExist==false){
                $('#sel_type_level_1').attr('disabled','disabled');
                $("#error-msg-span").html('Rule not exist on this subcategory');
                showSuccessError('error-msg-block');
                $("#success-msg-block").hide();
            }
        }
    });
}
function addOrUpdateCategoryRule() {
    $('#overlay').fadeIn();
    var action = $("#btn_edit_1").val();
    var categoryid = $("#sel_category_1").val();
    var subcategoryid = $("#sel_sub_category_1").val();
    var typename = $("#sel_type_level_1").val();
    var avgvalueforlow = $("#avgvalueforlow_1").val();
    var discountdifferentforlow = $("#low_disc_1").val();
    var discountdifferenceformid = $("#med_disc_1").val();
    var avgvalueforhigh = $("#avgvalueforhigh_1").val();
    var discountdifferenceforhigh = $("#high_disc_1").val();
    var id = $("#id_1").val();
    var token = $("#token").val();
    if(action=='edit'){
        $.ajax({
            type:'POST',
            url:"./updateCategoryDiscountRule/"+id,
            data:{'subcategoryid':subcategoryid,'typename':typename,'avgvalueforlow':avgvalueforlow,'discountdifferentforlow':discountdifferentforlow,'discountdifferenceformid':discountdifferenceformid,'avgvalueforhigh':avgvalueforhigh ,'discountdifferenceforhigh':discountdifferenceforhigh,'_token': token},
            //dataType:'json',
            success:function(output) {
                $('#overlay').fadeOut();
                if(output.success){
                    $("#success-msg-span").html('Rule edited successfully!');
                    showSuccessError('success-msg-block');
                    if(output.data.typeid==-1){
                        $('#sel_type_level_1').removeAttr('disabled');
                    }
                    $("#error-msg-block").hide();
                }else if(output.errors){
                    var errMsg = '';
                    $.each(output.errors, function( key, value ) {
                        errMsg += value;
                        errMsg += '<br>';
                    });
                    $("#error-msg-span").html(errMsg);
                    $("#success-msg-block").hide();
                    //$("#error-msg-block").show();
                    showSuccessError('error-msg-block');
                }else{
                    $("#error-msg-span").html('Something went wrong!');
                    $("#success-msg-block").hide();
                    //$("#error-msg-block").show();
                    showSuccessError('error-msg-block');
                }
            }
        });
    } else if(action=='save'){
        $.ajax({
            type:'POST',
            url:"addCategoryDiscountRule",
            data:{'categoryid':categoryid,'subcategoryid':subcategoryid,'typename':typename,'avgvalueforlow':avgvalueforlow,'discountdifferentforlow':discountdifferentforlow,'discountdifferenceformid':discountdifferenceformid,'avgvalueforhigh':avgvalueforhigh ,'discountdifferenceforhigh':discountdifferenceforhigh,'_token': token},
            //dataType:'json',
            success:function(output) {
                $('#overlay').fadeOut();
                if(output.success){
                    $("#success-msg-span").html('Rule added successfully!');
                    showSuccessError('success-msg-block');
                    $("#error-msg-block").hide();
                    $("#id_1").val(output.data.id);
                    $("#btn_edit_1").val('edit');
                    if(output.data.typeid==-1){
                        $('#sel_type_level_1').removeAttr('disabled');
                    }
                }else if(output.errors){
                    var errMsg = '';
                    $.each(output.errors, function( key, value ) {
                        errMsg += value;
                        errMsg += '<br>';
                    });
                    $("#error-msg-span").html(errMsg);
                    $("#success-msg-block").hide();
                    //$("#error-msg-block").show();
                    showSuccessError('error-msg-block');
                }else{
                    $("#error-msg-span").html('Something went wrong!');
                    $("#success-msg-block").hide();
                    //$("#error-msg-block").show();
                    showSuccessError('error-msg-block');
                }
            }
        });
    }
}
function showSuccessError(obj){
    $("#"+obj).show();
    /*setTimeout(function () {
        $('#'+obj).hide();
    }, 5000);*/
}
function getProductTypes(){
    var subCategoryId = $("#sel_sub_category_1").val();
    var categoryId = $("#sel_category_1").val();
    clearInputVal(1);
    $("#id_1").val('');
    if(subCategoryId!=''){
        $.ajax({
            type:'GET',
            url:"./getProductTypes",
            data:{'subCategoryId':subCategoryId,'categoryId':categoryId},
            //dataType:'json',
            success:function(output) {
                 var html = '<option value="">Select Product Type</option>';
                $.each(output, function( key, value ) {
                    html += '<option value="'+value['typeid']+'+++'+value['typetitle']+'" >'+value['typetitle']+'</option>';        
                });
                $("#sel_type_level_1").html(html);
            }
        });
    }
}