@extends('layouts.FitLayoutapp')

@section('header')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
@endsection
@section('content')
@php($fromNo = ($FitJuniorPlanRule->currentPage() - 1) * $FitJuniorPlanRule->perPage() +1)
@php($toNo = $fromNo - 1 + $FitJuniorPlanRule->count())
    <div class="col-md-12 " >
            <div class="card">
                <div class="card-header">
                    <label class="mt-2 mb-0"><h5><b>Fit Junior Plan Upgrade System</b></h5></label>
                   <div class="float-right"> 
                        <a class="btn btn-info" type="button" onclick = "Openform();"> 
                            Add Rule
                        </a> 
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <table class="table table-bordered table-hover" id="fitruleTable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="cls-prod-column">ProductId</th>
                                    <th scope="col" class="cls-prod-column">ProductName</th>
                                    <th scope="col">UppgradePlanOptions</th>
                                    <th scope="col" class="cls-lmdate-column">UpgradeDateFrom</th>
                                    <th scope="col" class="cls-lmdate-column">UpgradeDateTo</th>
                                    <th scope="col">UpgradePostExpiry</th>
                                    <th scope="col">IsActive</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($FitJuniorPlanRule as $key => $value)
                                <tr >
                                    <td>{{$value->productid}}</td>
                                    <td>{{$value->productname}}</td>
                                    <td>{{$value->upgradeplanoption}}</td>
                                    <td>{{$value->upgradedatefrom}}</td>
                                    <td>{{$value->upgradedateto}}</td>
                                    <td>{{$value->upgradepostexpiry}}</td>
                                    <td>{{$value->isactive}}</td>
                                    <td><a href="#" class="editfitjuniorplan" id="{{$value->productid}}" >Edit</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row pt-1"> 
                            <div class="col-md-5 float-left font-weight-bold">
                                Showing {{$fromNo}} to {{$toNo}} of {{$FitJuniorPlanRule->total()}} entries
                            </div>
                            <div class="col-md-7">
                                <div class="pull-right">
                                    {!! $FitJuniorPlanRule->appends(Request::all())->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

              <div class="card" id="addeditformdiv" style=" margin-top: 2%;display: none;" >
                <div class="card-header">
                    <label class="mt-2 mb-0"><h5><b>Add/Edit Rule</b></h5></label>
                   
                </div>
                <div class="card-body">
                    <form  id="form1" action="{{url('FitJuniorPlanUpgradeSystemCreate')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="form-group row">
                        <label for="productid" class="control-label col-sm-2">Product Id</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="productid" name="productid"placeholder="Product Id" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="productname" class="control-label col-sm-2">Product Name</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="productname" name="productname" placeholder="Product Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="upgradeplanid" class="control-label col-sm-2">Upgrade Plan Id's</label>
                        <div class="col-sm-6">
                         <input type="text" class="form-control" id="upgradeplanid" name="upgradeplanid"placeholder="Upgrade Plan Id's" oninput="this.value = this.value.replace(/[^0-9,]/g, '').replace(/(\..*?)\..*/g, '$1');"required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="upgradedayfrom" class="control-label col-sm-2">Upgrade Day From</label>
                        <div class="col-sm-6">
                         <input type="number" min="0" max="365" step="1" class="form-control numberrange" id="upgradedayfrom" name="upgradedayfrom" placeholder="Upgrade Day From" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="upgradedayto" class="control-label col-sm-2">Upgrade Day To</label>
                        <div class="col-sm-6">
                         <input type="number" min="0" step="1" max="365" class="form-control numberrange" id="upgradedayto" name="upgradedayto" placeholder="Upgrade Day To" autocomplete="off" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="upgradepostexpiry" class="control-label col-sm-2">Upgrade Post Expiry</label>
                        <div class="col-sm-6">
                        <select name="upgradepostexpiry" class="custom-select" required>
                         <option value="yes" selected="selected">Yes</option>
                          <option value="no">No</option>
                         </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="isactive" class="control-label col-sm-2">Is Active</label>
                        <div class="col-sm-6">
                        <select name="isactive"class="custom-select" required>
                          <option value="1" >Yes</option>
                          <option value="0" selected="selected">No</option>
                         </select>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" value="{{$id}}" name="precartofferid">
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10 pull-right">
                            <button type="submit" class="btn btn-success">Save Rule</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>
                    </div>
                </form>
              </div>
            </div>
    </div>
@endsection
@section('footer')
<script type="text/javascript">
    $('#fitruleTable').DataTable({
        "paging": false,
        "info": false,
    });
   
    function Openform(){
      var p=hasValue("#productid");  
      if(p)
      {
        
         //document.getElementById('addeditformdiv').style.display = 'block';
      }
      else
      {
         document.getElementById('addeditformdiv').style.display = 'block';
      }
    
    }      
     function hasValue(elem) {
      return $(elem).filter(function() { return $(this).val(); }).length > 0;
     }
</script>
@endsection