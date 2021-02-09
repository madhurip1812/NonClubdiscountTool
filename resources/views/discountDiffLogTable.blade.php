<div class="panel-body table-responsive">
    <table class="table table-hover" id="creditnote-table-list">
        <thead>
            <tr>
                <th>Category</th>
                <th>Sub-Category</th>
                <th>Type Name</th>
                <th>Avg valueforlow</th>
                <th>Discount Differentforlow</th>
                <th>Discount Differenceformid</th>
                <th>Avg Valueforhigh</th>
                <th>Discount Differenceforhigh</th>
                <th>Avg Sale</th>
                <th>Modified Date</th>
                <th>Modified By</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $value)
                <tr>
                    <td >{{$value->Category->categoryname ?? ''}}</td>
                    <td >{{$value->SubCategory->subcategoryname ?? ''}}</td>
                    <td >{{$value->typename ?? ''}}</td>
                    <td >{{$value->avgvalueforlow ?? ''}}</td>
                    <td >{{$value->discountdifferentforlow ?? ''}}</td>
                    <td >{{$value->discountdifferenceformid ?? ''}}</td>
                    <td >{{$value->avgvalueforhigh ?? ''}}</td>
                    <td >{{$value->discountdifferenceforhigh ?? ''}}</td>
                    <td >{{$value->avgsale ?? ''}}</td>
                    <td >{{date('d-m-Y',strtotime($value->lastmodifieddate)) ?? ''}}</td>
                    <td >{{$value->lastmodifiedby ?? ''}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-md-12">
        <div class="pull-right">
            <div class="pull-right">
                {!! $data->appends(Request::all())->links() !!}
            </div>
        </div>
    </div>
</div>