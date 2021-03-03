$("#addcashback").validate({
    rules:{
      'rulefor':'required',
      //'cashcoupon':'required',   
      'rulename':'required',
      // 'cashoncoupon':'required',
      'cashoutcoupon':'required',
      'cashvaliddays':'required',
      'cashperc':'required',
      'cashmaxamnt':'required',
      'cashminpurc':'required',
      // 'intellikit12monthssubscrboxno[]':'required',
      // 'intellikit6monthssubscrboxno':'required',
      // 'intellikit9monthssubscrboxno':'required',
      // 'intellikit12monthssubscrboxno':'required',
      'emailtemplateid':'required',
      'cashstartdate':'required',
      'cashenddate':'required' ,
      'isactive':'required',
      // 'cashproductsendtimehr':'required',
      // 'cashproductstarttimehr':'required',
      'productids':'required'
    },
    messages:{},
    submitHandler:function(form) {
        if( $("#intellikit3monthssubscrboxno").is(':visible') && $("#intellikit6monthssubscrboxno").is(':visible') && $("#intellikit9monthssubscrboxno").is(':visible') && $("#intellikit12monthssubscrboxno").is(':visible') ) {
        let subscrboxselectedcount = 0;
        
        if($("#intellikit3monthssubscrboxno").val() == "" && $("#intellikit6monthssubscrboxno").val() == "" && $("#intellikit9monthssubscrboxno").val() == "" && $("#intellikit12monthssubscrboxno").val() == ""){
          alert("Please select atleast one subscription box no.");return false;
        }
        
        if($("#intellikit3monthssubscrboxno").val() != "") subscrboxselectedcount++;
        if($("#intellikit6monthssubscrboxno").val() != "") subscrboxselectedcount++;
        if($("#intellikit9monthssubscrboxno").val() != "") subscrboxselectedcount++;
        if($("#intellikit12monthssubscrboxno").val() != "") subscrboxselectedcount++;

        if(subscrboxselectedcount > 1) {
          alert("You can not select more than one subscription box no.");return false;
        } 
       }
        form.submit();
    }
});