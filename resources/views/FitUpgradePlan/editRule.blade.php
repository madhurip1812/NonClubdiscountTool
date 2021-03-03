       
                <div class="card-header">
                    <label class="mt-2 mb-0"><h5><b>Add/Edit Rule</b></h5></label>
                   
                </div>
                <div class="card-body">
                    <form  action="{{ route('FitJuniorPlanUpgradeSystemUpdate',$FitJuniorPlanRule['productid'] )}}" method="POST" id="eventListEdit" enctype="multipart/form-data">
                        @csrf
                    <div class="form-group row">
                        <label for="productid" class="control-label col-sm-2">Product Id</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="productid" name="productid"placeholder="Product Id" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" value="{{$FitJuniorPlanRule['productid']}}" readonly required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="productname" class="control-label col-sm-2">Rule Name</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="productname" name="productname" placeholder="Rule Name" value="{{$FitJuniorPlanRule['productname']}}" readonly required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="upgradeplanid" class="control-label col-sm-2">Upgrade Plan Id's</label>
                        <div class="col-sm-6">
                         <input type="text" class="form-control" id="upgradeplanid" name="upgradeplanid" placeholder="Upgrade Plan Id's" oninput="this.value = this.value.replace(/[^0-9,]/g, '').replace(/(\..*?)\..*/g, '$1');"
                         value="{{$FitJuniorPlanRule['upgradeplanoption']}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="upgradedayfrom" class="control-label col-sm-2">Upgrade Day From</label>
                        <div class="col-sm-6">
                         <input type="number" min="0" max="365" step="1" class="form-control" id="upgradedayfrom" name="upgradedayfrom" placeholder="Upgrade Day From" autocomplete="off" value="{{$FitJuniorPlanRule['upgradedatefrom']}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="upgradedayto" class="control-label col-sm-2">Upgrade Day To</label>
                        <div class="col-sm-6">
                         <input type="number" min="0" max="365" step="1" class="form-control" id="upgradedayto" name="upgradedayto" placeholder="Upgrade Day To" autocomplete="off" value="{{$FitJuniorPlanRule['upgradedateto']}}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="upgradepostexpiry" class="control-label col-sm-2">Upgrade Post Expiry</label>
                        <div class="col-sm-6">
                        <select name="upgradepostexpiry" class="custom-select" required>
                         <option value="1"  {{$FitJuniorPlanRule['upgradepostexpiry'] == "1" ? 'selected' : ''}}>Yes</option>
                          <option value="0" {{$FitJuniorPlanRule['upgradepostexpiry'] == "0" ? 'selected' : ''}}>No</option>
                         </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="isactive" class="control-label col-sm-2">Is Active</label>
                        <div class="col-sm-6">
                        <select name="isactive"class="custom-select" required>
                          <option value="1" {{$FitJuniorPlanRule['isactive'] == "1" ? 'selected' : ''}}>Yes</option>
                          <option value="0" {{$FitJuniorPlanRule['isactive'] == "0" ? 'selected' : ''}}>No</option>
                         </select>
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10 pull-right">
                            <button type="submit" class="btn btn-success">Save Rule</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
                            <button type="button" class="btn btn-primary" id="searchRules">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        
   
<script type="text/javascript">
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
    $("#searchRules").click(function(){
      $('html, body').animate({
        scrollTop: ($('#searchRulesDiv').offset().top)
      },500);
    });
         
    
</script>