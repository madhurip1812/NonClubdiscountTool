<div class="panel-body table-responsive">
    <table class="table table-hover" id="cron-log-table-list">
        <thead>
            <tr>
                <th>Ruleid</th>
                <th>Created Date</th>
                <th>Created By</th>
                <th>Record</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $value)
                <tr>
                    <td >{{$value->ruleid ?? ''}}</td>
                    <td >{{date('d-m-Y',strtotime($value->createddate)) ?? ''}}</td>
                    <td >{{$value->createdby ?? ''}}</td>
                    <td >{{$value->recordcount ?? 0}}</td>
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