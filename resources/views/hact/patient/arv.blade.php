<!-- arv Records -->
@if( count($arv) > 0 )
    <div class="row">
        <div class="large-12 columns text-center"><h4 class="profile-heading">Prescription</h4></div>
    </div>
    <div class="row overflow">
        <div class="large-12 columns overflow-profile">
            <table class="responsive" width="100%">
                <thead>
                <tr>
                    <th width="10%"></th>
                    <th class="main-column" width="50%"><a href="#">Medicines</a></th>
                    <th width="20%"><a href="#">Doctor</a></th>
                    <th width="20%"><a href="#">Date Issued</a></th>
                </tr>
                </thead>
                <tbody>
                @foreach($arv as $row)
                    @if($row->ARVItems->count() > 0)
                        <tr>
                            <td>
                                <a href="{{ route('prescription_create', $row->id) }}" title="Dispense"><i class="fa fa-download fa-lg"></i></a>
                                <a href="{{ route('prescription_details', $row->id) }}" title="Dispense Details"><i class="fa fa-lg fa-file-text-o"></i></a>
                            </td>
                            <td class="main-column">
                                @foreach($row->ARVItems as $item)
                                    @if($item->arv_item_count != 0)
                                        @if($item->specified_medicine == '')
                                            <span class="line-through" title="Already Dispense">{{ $item->Medicine->name }} ( {{ $item->infection_format }} )</span>
                                        @else
                                            <span class="line-through" title="Already Dispense">{{ $item->specified_medicine }} ( {{ $item->infection_format }} )</span>
                                        @endif
                                    @else
                                        @if($item->specified_medicine == '')
                                            {{ $item->Medicine->name }} ( {{ $item->infection_format }} )
                                        @else
                                            {{ $item->specified_medicine }} ( {{ $item->infection_format }} )
                                        @endif
                                    @endif
                                    <br />
                                @endforeach
                            </td>
                            <td>{{ $row->User->name }}</td>
                            <td>{{ $row->created_at->format('m/d/Y H:i:s') }}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif