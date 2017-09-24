<!-- Obgyne Records -->
@if( count($ob) > 0)
    <div class="row">
        <div class="large-12 columns text-center"><h4>Obgyne Records</h4></div>
    </div>

    <div class="row">
        <div class="large-12 columns text-center">
            <table class="responsive" width="100%">
                <thead>
                <tr>
                    <th width="7%">

                    </th>
                    <th width="15%"><a href="#">Currently Pregnant</a></th>
                    <th width="15%"><a href="#">Age of Gestation</a></th>
                    <th class="main-column" width="15%"><a href="#">Delivery Date</a></th>
                    <th width="15%"><a href="#">Type of Infant Feeding</a></th>
                    <th width="33%"><a href="#">Pap Smear</a></th>
                </tr>
                </thead>
                <tbody>
                @foreach($ob as $obgyne)
                    <tr>
                        <td>
                            <a href="{{ route('ob_gyne_edit',$obgyne->id) }}" title="Edit OB-Gyne"><i class="fa fa-edit fa-lg"></i></a>
                            <a data-confirm href="{{ route('ob_gyne_destroy', $obgyne->id) }}" title="Delete OBGyne Record"><i class="fa fa-times fa-lg"></i></a>
                        </td>
                        <td>{{$obgyne->currently_pregnant_format }}</td>
                        <td>{{$obgyne->currently_pregnant_if_yes_gestation_age}}</td>
                        <td class="mian-column">{{($obgyne->if_delivered_date != NULL) ? $obgyne->if_delivered_date->format('m/d/Y') : ''}}</td>
                        <td>{{$obgyne->infant_type_format }}</td>
                        <td><pre>{{ $obgyne->pap_smear }}</pre></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            {!! $ob->render() !!}
        </div>
    </div>
    <script>
        $(document).confirmWithReveal({
            body: "This action cannot be undone."
        });
    </script>
@endif