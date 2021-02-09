<div class="panel-body table-responsive">
    <table class="table table-hover" id="creditnote-table-list">
        <thead>
            <tr>
                <th>productid</th>
                <th>name</th>
                <th>nonclubdiscountdifference</th>
                <th>nonclubdiscountdifferencetype</th>
                <th>lastmodifieddate</th>
                <th>lastmodifiedby</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $value)
                <tr>
                    <td >{{$value->productid ?? ''}}</td>
                    <td >{{$value->productinfowithtype->productname ?? ''}}</td>
                    <td >{{$value->nonclubdiscountdifference ?? ''}}</td>
                    <td >{{$value->nonclubdiscountdifferencetype ?? ''}}</td>
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