$("#addcashback").validate({
    rules:{
      'rulefor':'required',
      'cashcoupon':'required',   
      'rulename':'required',
      'cashoncoupon':'required',
      'cashoutcoupon':'required',
      'cashvaliddays':'required',
      'cashperc':'required',
      'cashmaxamnt':'required',
      'cashminpurc':'required',
      'intellikit3monthssubscrboxno':'required',
      'intellikit6monthssubscrboxno':'required',
      'intellikit9monthssubscrboxno':'required',
      'intellikit12monthssubscrboxno':'required',
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
        form.submit();
    }
});