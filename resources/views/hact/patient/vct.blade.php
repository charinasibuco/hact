<!-- VCT Records -->
@if(count($patient->VCT) > 0)
    <div class="row">
        <div class="large-12 columns text-center"><h4 class="profile-heading">VCT (Voluntary Counselling Testing) Records</h4></div>
    </div>

    <div class="row">
        <div class="large-12 columns text-center">
            <table width="100%" class="responsive">
                <thead>
                <tr>
                    <th width="10%"></th>
                    <th class="main-column" width="20%"><a href="#">VCT Date</a></th>
                    <th width="15%"><a href="#">Result</a></th>
                    <th width="25%"><a href="#">Facilitator</a></th>
                    <th width="30%"><a href="#">Date Created</a></th>
                </tr>
                </thead>
                <tbody>
                @foreach($patient->VCT as $row)
                    <tr>
                        <td>
                            @if(Auth::user()->access == 1)
                                <a href="{{ route('vct_edit', $row->id) }}" title="Edit VCT"><i class="fa fa-edit fa-lg"></i></a>
                                <a data-confirm href="{{ route('vct_destroy', $row->id) }}" title="Delete VCT Record"><i class="fa fa-times fa-lg"></i></a>
                            @endif
                            @if($row->result == 1 && Auth::user()->access != 2)
                                <a href="{{ route('vct_doctor', $row->id) }}" title="Assign Doctor"><i class="fa fa-user-md fa-lg"></i></a>
                            @endif
                        </td>
                        <td class="main-column">{{ $row->vct_date->format('m/d/Y') }}</td>
                        <td>{{ $row->result_format }}</td>
                        <td>{{ $row->User->name }}</td>
                        <td>{{ $row->created_at->format('m/d/Y') }}</td>
                    </tr>
                @endforeach
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