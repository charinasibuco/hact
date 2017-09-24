<!-- Obgyne Records -->
@if( count($medical_abstract) > 0)
    <div class="row">
        <div class="large-12 columns text-center"><h4 class="profile-heading">Medical Abstracts</h4></div>
    </div>
       <div class="row">
        <div class="large-12 columns text-center">
            <ul class="accordion" data-accordion>
                @foreach($medical_abstract as $row)
                    <li class="accordion-navigation">
                        <a href="#panel{{$row->id}}a">{{$row->date->format('F d, Y')}} </a>
                        <div id="panel{{$row->id}}a" class="content @if($row == $medical_abstract->first()) active @endif">
                            <a href="{{ route('medical_abstract_edit', $row->id) }}"><i class="fa fa-pencil-square-o fa-lg"></i> Edit</a>&nbsp;
                            <a href="{{ route('medical_abstract_print', $row->id) }}"><i class="fa fa-print fa-lg"></i> Print</a>&nbsp;
                            <a title="Delete Medical Abstract" data-confirm href="{{ route('medical_abstract_destroy',$row->id) }}"><i class="fa fa-times fa-lg"></i> Delete</a>
                            <pre style="text-align: left">{{ $row->body }}</pre>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <script>
        $(document).confirmWithReveal({
            body: "This action cannot be undone."
        });

    </script>
@endif


