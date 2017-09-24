<!-- Tuberculosis Records -->
@if( count($tuberculosis) > 0)
    <div class="row">
        <div class="large-12 columns text-center"><h4 class="profile-heading">Tuberculosis Records</h4></div>
    </div>

    <div class='row'>
        <div class='large-12 columns'>
            @include('hact.messages.success')
            @include('hact.messages.error_list')
            <table class="responsive" width="100%" align="center" >
                <thead>
                    <tr>
                        <th width="10%"></th>
                        <th width="10%"><a href="#">Symptoms Screening</a></th>
                        <th width="10%"><a href="#">TB Status</a></th>
                        <th width="20%"><a href="#">Site</a></th>
                        <th width="10%"><a href="#">TB Regimen</a></th>
                        <th class="main-column" style="width:10%;" width="10%"><a href="#">Date Started</a></th>
                        <th width="10%"><a href="#">IPT</a></th>
                        <th width="10%"><a href="#">Drug Resistance</a></th>
                        <th width="10%"><a href="#">Tx Outcome</a></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($tuberculosis as $tb)
                    <tr>
                        <td>
                            <a title="Edit Record" href="{{ route('tuberculosis_edit', [$tb->id]) }}"><i class="fa fa-pencil-square-o fa-lg"></i></a>
                            <a data-confirm href="{{ route('tuberculosis_destroy', $tb->id) }}" title="Delete TB Record"><i class="fa fa-times fa-lg"></i></a>
                        </td>

                        <td>{{ $tb->presence_format }}</td>
                        <td>{{ $tb->tb_status_format }}</td>
                        <td>{{ $tb->site_format }} {{ $tb->site_extrapulmonary }}</td>
                        <td>{{ $tb->current_tb_regimen_format }}</td>
                        <td class="main-column">{{ $tb->date_started }}</td>
                        {{-- <td>{{ $tb->on_ipt }}</td> --}}
                        <td>{{ $tb->ipt_outcome_format }} {{ $tb->ipt_outcome_other }}</td>
                        <td>{{ $tb->drug_resistance_format }} {{ $tb->drug_resistance_other }}</td>
                        <td>{{ $tb->tx_outcome_format }} {{ $tb->tx_outcome_other }}</td>
                    </tr>
                @endforeach
                <tr></tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).confirmWithReveal({
            body: "This action cannot be undone."
        });
    </script>
@endif