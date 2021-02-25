$(document).ready(function(){

	 $elementToScrollTo = $("#error-success-massage");
            $("#success-massage").delay(500).fadeOut(500);
                $("html,body").animate({
                scrollTop: $elementToScrollTo.offset().top - 175
            }, 500);



	$(".editfitjuniorplan").click(function(){
		 var productid=$(this).attr("id");

		 $.ajax({
            url:"../FitJuniorPlanUpgradeSystemEdit",
            type: 'GET',
            dataType: 'json', 
            data:{'productid':productid},
            success: function(data)
            {
                // console.log('data = ',data);
                document.getElementById('addeditformdiv').style.display = 'block';
                $("#addeditformdiv").empty().append(data.html);

               
            }
        });
	})   

    $("#upgradedayfrom" ).change(function() {
          var max = parseInt($(this).attr('max'));
          var min = parseInt($(this).attr('min'));
          $('#upgradedayto').attr('min', $(this).val());
          var p=hasValue("#upgradedayto");  
          if(p)
          {
            $(this).attr('max',$("#upgradedayto").val());
          }       
          // if (p &&($(this).val() > $("#upgradedayto").val()))
          // {
          //     $(this).val(min);
          // }
           
        }); 
    $("#upgradedayto" ).change(function() {
          var max = parseInt($(this).attr('max'));
          var min = parseInt($(this).attr('min'));
          var p=hasValue("#upgradedayfrom");
          if(p)
          {
            $(this).attr('min',$("#upgradedayfrom").val());
          }
          // if (p &&($(this).val() < $("#upgradedayfrom").val()))
          // {
          //    $(this).val(min);
          // }
            
        }); 
    function hasValue(elem) {
      return $(elem).filter(function() { return $(this).val(); }).length > 0;
     }
                
});