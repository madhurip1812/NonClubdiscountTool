@extends('layouts.FitLayoutapp')

@section('header')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
@endsection
@section('content')
@php($fromNo = ($PreCartOffer->currentPage() - 1) * $PreCartOffer->perPage() +1)
@php($toNo = $fromNo - 1 + $PreCartOffer->count())
    <div class="col-md-12 " >
            <div class="card">
                <div class="card-header">
                    <label class="mt-2 mb-0"><h5><b>Pre Cart Offer</b></h5></label>
                    <div class="float-right"> 
                      
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <table class="table table-bordered table-hover" id="productRuleTable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="cls-prod-column">Id</th>
                                    <th scope="col" class="cls-prod-column">Cartoffername</th>
                                    <th scope="col">IsActive</th>
                                    <th scope="col" class="cls-lmdate-column">Validtodate</th>
                                    <th scope="col" class="cls-lmdate-column">Validfromdate</th>
                                    <th scope="col">Ruletype</th>
                                    <th scope="col">Ruledata</th>
                                    <th scope="col">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($PreCartOffer as $key => $value)
                                <tr id="{{$value->id}}">
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->cartoffername}}</td>
                                    <td>{{$value->IsActive}}</td>
                                    <td>{{$value->validtodate? date('d/m/Y',strtotime($value->validtodate)) : ''}}</td>
                                    <td>{{$value->validfromdate? date('d/m/Y',strtotime($value->validfromdate)) : ''}}</td>
                                    <td>{{$value->ruletype}}</td>
                                    <td>{{$value->ruledata}}</td>
                                    <td><a href="./FitJuniorPlanUpgradeSystem/{{$value->id}}">details</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row pt-1"> 
                            <div class="col-md-5 float-left font-weight-bold">
                                Showing {{$fromNo}} to {{$toNo}} of {{$PreCartOffer->total()}} entries
                            </div>
                            <div class="col-md-7">
                                <div class="pull-right">
                                    {!! $PreCartOffer->appends(Request::all())->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('footer')
<script type="text/javascript">
    $('#productRuleTable').DataTable({
        "paging": false,
        "info": false,
    });
</script>
@endsection
