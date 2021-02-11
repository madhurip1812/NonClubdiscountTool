/**  hide productid field on page load   **/
$(document).ready(()=>{
  // alert('hello');
	let ruleFor = $("input:radio[name='rulefor']:checked").val();
  if(ruleFor == 'intellikit') {
    $(".product").hide();
    $(".intellikitsubscbox").show();
  } else if(ruleFor == 'time') {
    $(".intellikitsubscbox").hide();
    $(".product").show();
  }
});

/**  dispaly the fields as per selection of rulefor    **/
$("input:radio[name='rulefor']").on('change',()=>{
   let ruleFor = $("input:radio[name='rulefor']:checked").val();
   
   if(ruleFor == 'intellikit') { //intellikit
      $(".intellikitsubscbox").show();
	    $(".product").hide();
   } else if(ruleFor == 'time') { //product
       $(".intellikitsubscbox").hide();
       $(".product").show();
   } else {

   }
});