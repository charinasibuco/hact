
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
    		<h4 class="profile-heading">Expired Medicine</h4>
    	</div>
    </div>
    <div class="row">
    	<div class="large-12 column">
    		<strong>
    			Date: </strong>{{ $from }} - {{ $to }}
    	</div>
    </div>
    <br />
    <div class="row">
        <div class="large-12 column">
            <table id="myTable" class="tablesorter" style="width:100%">
                <thead >
                <tr style="border-bottom:2px solid gray;">
                    <th><a href="{{route('medicine').'?search=&order_by=name&sort='.$sort}}">DRUG DESCRIPTION &amp; FORMULATION</a></th>
                    <th><a href="{{route('medicine').'?search=&order_by=item_code&sort='.$sort}}">ITEM CODE</a></th>
                    <th class="text-center"><a href="{{route('medicine').'?search=&order_by=tabs_per_bottle&sort='.$sort}}">TABS per<br>BOTTLE</a></th>
                    <th><a href="{{route('medicine').'?search=&order_by=expiry_date&sort='.$sort}}">EXPIRY</br>DATE</a></th>
                    <th><a href="{{route('medicine').'?search=&order_by=lot_number&sort='.$sort}}">LOT #</a></th>
                    <th class="text-center"><a href="{{route('medicine').'?search=&order_by=quantity&sort='.$sort}}">BOTTLE</a></th>
                </tr>
                </thead>
                <tbody>
                @foreach($medicines as $medicine)
                    <tr class="{{ $medicine->medicine_class }}">
                        <td>{{$medicine->MedicineModel->name}}</td>
                        <td>{{$medicine->MedicineModel->item_code}}</td>
                        <td class="text-center">{{$medicine->tabs_per_bottle}}</td>
                        <td>{{$medicine->expiry_date->format('m/d/Y')}}</td>
                        <td>{{$medicine->lot_number}}</td>
                        <td class="text-center">{{$medicine->quantity}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
