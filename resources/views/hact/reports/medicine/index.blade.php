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
        <h4 class="profile-heading">Low Stock Summary</h4>
    </div>
</div>
    <div class="row">
        <div class="large-12 columns">
            <table id="myTable" class="tablesorter" width="100%">
                <thead class="custom-panel-heading" >
                <tr style="border-bottom:2px solid gray;" >
                  <th width="50%"><a href="{{route('medicine').'?search=&order_by=name&sort='.$sort}}" style="color:#FFF">Drug Description &amp; Formulation</a></th>
                  <th width="20%"><a href="{{route('medicine').'?search=&order_by=item_code&sort='.$sort}}" style="color:#FFF">Item Code</a></th>
                  <th width="20%"><a href="{{route('medicine').'?search=&order_by=classification&sort='.$sort}}" style="color:#FFF">Classification</a></th>
                  <th width="10%" class="text-center"><a href="#" style="color:#FFF">Balance</a></th>
                </tr>
                </thead>
                <tbody>
                @foreach($medicines as $medicine)
                    @if($medicine->current_stock <= 100)
                        @if($medicine->current_stock <= 20)
                            <tr class="critical_medicine">
                        @else
                            <tr class="warning_medicine">
                        @endif
                                <td>
                                    {{ $medicine->name }}
                                </td>
                                <td>{{ $medicine->item_code }}</td>
                                <td>{{ $medicine->classification_format }}</td>
                                <td>{{ $medicine->current_stock }}</td>
                            </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            <div>
                <small><i class="fa fa-square" style="color:red"></i> Critical (less than 20 boxes)</small><br>
                <small><i class="fa fa-square" style="color:orange"></i> Warning (less than 100 boxes)</small><br>
            </div>
        </div>
    </div>
@endsection