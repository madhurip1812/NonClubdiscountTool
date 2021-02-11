@extends('layouts.app')

@section('content')
<!-- <div class="main-content">
    <div class="container-fluid"> -->
    
<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">Exclude Items</h3>
    </div>
    <div class="panel-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
	
		<div class="row">
			<div class="col-md-12">

				<form method="post" action="./ExcludeItems.aspx" id="form1">
					<div>
						<table>
						<tr>
						<td nowrap="nowrap">
						<span id="lblbrand">Exclude Brands Id's </br>(comma seperated)</span></td>
						<td nowrap="nowrap">
						<span id="lblcat">Exclude Category Id's </br>(comma seperated)</span></td>
						<td nowrap="nowrap">
						<span id="lblsubcat">Exclude Subcategory Id's </br>(comma seperated)</span></td>
						<td nowrap="nowrap">
						<span id="lblProduct">Exclude Product Id's </br>(comma seperated)</span></td>
						</tr>
						<tr>
						<td>
						<textarea name="txtbrands" rows="5" cols="22" id="txtbrands" class="numbercommatxt"  style="align-content:center; overflow:auto;" >@if(!empty($ExcludedBrand)){{$ExcludedBrand[0]['Brandids']}}
						@endif</textarea></td>
						<td>
						<textarea name="txtCat" rows="5" cols="22" id="txtCat" class="numbercommatxt" style="align-content:center; overflow:auto;"> @if(!empty($ExcludedCategory)) {{$ExcludedCategory[0]['CategoryIds']}}@endif
						</textarea></td>
						<td>
						<textarea name="txtSubCat" rows="5" cols="22" id="txtSubCat" class="numbercommatxt" style="align-content:left; overflow:auto;">@if(!empty($ExcludedSubCategory)) {{$ExcludedSubCategory[0]['SubCategoryids']}} @endif
						</textarea></td>
						<td>
						<textarea name="txtProduct" rows="5" cols="22" id="txtProduct" class="numbercommatxt" style="align-content:center; overflow:auto;">@if(!empty($ExcludedProducts)){{$ExcludedProducts[0]['productids']}}@endif</textarea></td>
						</tr>

						<tr>
							
						
						<td>
						<input type="button" class="btn btn-primary ExcludeBtn" value="Exclude Brands" id="btnExcludeBrands" /></td>
						<td>
						<input type="button" class="btn btn-primary ExcludeBtn" value="Exclude Categories" id="btnExcludeCat" /></td>
						<td>
						<input type="button" class="btn btn-primary ExcludeBtn" value="Exclude SubCategories" id="btnExcldeSubCat" /></td>
						<td>
						<input type="button" class="btn btn-primary ExcludeBtn" value="Exclude Products" id="btnExcludeProducts" /></td>
						</tr>

						<tr>
						<td>
						<textarea  size="4" name="lvBrand" id="lvBrand" style="height:300px;width:220px;">

						</textarea > 
						</td>
						<td>
						<textarea  size="4" name="lvCat" id="lvCat" style="height:300px;width:220px;">

						</textarea > 
						</td>
						<td>
						<textarea  size="4" name="lvSubCat" id="lvSubCat" style="height:300px;width:220px;">

						</textarea > 
						</td>
						<td><input type="button" name="btnShowDesc" value="Show Description"  class="btn btn-success btnShowDesc" id="btnShowDesc" /><p style="color: #3490dc;">(Description's are available for Brands,Categories and SubCategories)</p> </td>

						</tr>

						</table>

					</div>
				</form>	
			</div>
		</div>
	
	
		
		
 </div>
</div>
<!--     </div>
</div> -->
@endsection