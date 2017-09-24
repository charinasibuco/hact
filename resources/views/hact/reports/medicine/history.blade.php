@extends("hact.layouts.print_layout")

@section("content")
    <br/>
    <input id="print" type="button" value="Print">
    <script>
        $('#print').click(function(){
            $(this).hide();
            window.print();
            $(this).show();
        });
    </script>
    <br/>
    <br/>
    <div class="row">
        <div class="large-12 column">
            <h4 class="profile-heading">Restocking History</h4>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <table id="myTable" class="tablesorter" style="width:100%">
                <thead class="custom-panel-heading">
                    <tr>
                      <th width="20%"><a href="#" style="color:#FFF">Lot Number</a></th>
                      <th width="15%" class="text-center"><a href="#" style="color:#FFF">Tabs/Bot.</a></th>
                      <th width="15%" class="text-center"><a href="#" style="color:#FFF">Quantity</a></th>
                      <th width="10%" class="text-center"><a href="#" style="color:#FFF">Balance</a></th>
                      <th width="20%"><a href="#" style="color:#FFF">Expiry Date</a></th>
                      <th width="20%"><a href="#" style="color:#FFF">Created At</a></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($histories as $row)
                    <tr>
                        <td>{{ $row->lot_number }}</td>
                        <td class="text-center">{{ $row->tabs_per_bottle }}</td>
                        <td class="text-center">{{ $row->quantity }}</td>
                        <td class="text-center">{{ $row->current_medicine_stock }}</td>
                        <td>{{ $row->expiry_date->format('m/d/Y') }}</td>
                        <td>{{ $row->created_at->format('m/d/Y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $histories->render() !!}
        </div>
    </div>


@endsection
