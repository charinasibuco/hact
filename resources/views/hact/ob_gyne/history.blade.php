@extends('hact.layouts.layout_admin')

@section('content')


    <div class="row">
        <div class="large-7 columns">
            <ul class="breadcrumbs">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{route('ob_gyne')}}">OB-GYNE</a></li>
                <li class="current"><a href="#">{{$patient->code_name}}'s Ob-Gyne History</a></li>
            </ul>
        </div>
        <div class="large-5 columns">
            <form method="get" action="{{route('ob_gyne')}}">
                <div class="large-12 columns">
                    <div class="row">
                        <div class="row collapse">
                            <div class="small-9 columns">
                                <input name="search" type="text" placeholder="Search" value="{{$patient->code_name}}">
                                <input type="hidden" name="order_by" value="max_delivered_date">
                                <input type="hidden" name="sort" value="desc">
                            </div>
                            <div class="small-3 columns">
                                <button type="submit" class="button alert postfix"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class='row'>
        <div class='large-12 columns'>
            @include('hact.messages.success')
            @include('hact.messages.error_list')
            <table width="100%">
                <thead>
                <tr>
                    <th width="7%">

                    </th>
                    <th width="10%"><a href="{{route('ob_gyne_history', ['id' => $patient->id]).'?search='.$search.'&order_by=currently_pregnant&sort='.$sort}}">Currently Pregnant</a></th>
                    <th width="20%"><a href="{{route('ob_gyne_history', ['id' => $patient->id]).'?search='.$search.'&order_by=currently_pregnant_if_yes_gestation_age&sort='.$sort}}">Age Gestation</a></th>
                    <th width="10%"><a href="{{route('ob_gyne_history', ['id' => $patient->id]).'?search='.$search.'&order_by=if_delivered_date&sort='.$sort}}">Delivery Date</a></th>
                    <th width="10%"><a href="{{route('ob_gyne_history', ['id' => $patient->id]).'?search='.$search.'&order_by=infant_type&sort='.$sort}}">Type of Infant Feeding</a></th>
                    <th width="43%"><a href="{{route('ob_gyne_history', ['id' => $patient->id]).'?search='.$search.'&order_by=pap_smear&sort='.$sort}}">Pap Smear</a></th>
                </tr>
                </thead>
                <tbody>
                @foreach($histories as $obgyne)
                    <tr>
                        <td>
                            <a href="{{ route('ob_gyne_edit',['id' => $obgyne->patient_id, 'ob_id' => $obgyne->id]) }}" title="Edit OB-Gyne"><i class="fa fa-edit fa-lg"></i></a>
                        </td>
                        <td>{{$obgyne->currently_pregnant}}</td>
                        <td>{{$obgyne->currently_pregnant_if_yes_gestation_age}}</td>
                        <td>{{($obgyne->if_delivered_date != NULL) ? $obgyne->if_delivered_date->format('M j Y') : ''}}</td>
                        <td>{{$obgyne->infant_type}}</td>
                        <td>{{$obgyne->pap_smear}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            {!! $histories->render() !!}
        </div>
    </div>

@endsection
