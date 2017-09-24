
@extends("hact.layouts.layout_admin")

@section("content")

    <div class='row'>
        <div class='large-12 columns'>
            <ul class="breadcrumbs">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#">Reports</a></li>
                <li class="current"><a href="#">Expired Medicine</a></li>
            </ul>
        </div>
    </div>
<div class="row">
    <div class="large-12 medium-12 small-12 columns">
        @include("hact.messages.success")
        @if(count($errors) > 0)
            <div class="alert-box alert ">Error: Highlight fields are required!</div>
        @endif
        <div class="custom-panel-heading">
            <span>Expired Medicine Report</span>
        </div>
        <div class="custom-panel-details">
            <div class="row">
                <div class="large-6 columns">
                    <form id="report" method="get" action="{{ route('medicine_expired_results') }}">
                        <fieldset>
                            <legend>Generate</legend>
                            <div class="row">
                                <div class="large-12 columns">
                                    <label>From</label>
                                    <input type="text" id="from" class="fdatepicker {{ ($errors->has('from')) ? 'highlight_error' : '' }}" name="from" placeholder="MM dd,yyyy" value="{{ $from }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-12 columns">
                                    <label>To</label>
                                    <input type="text" id="to" class="fdatepicker {{ ($errors->has('to')) ? 'highlight_error' : '' }}" name="to" placeholder="MM dd,yyyy" value="{{ $to }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-12 columns">
                                    <button type="submit" class="button small alert">Generate</button>
                                    <input type="submit" class="button small alert" name="excel" value="Excel" />
                                    {!! csrf_field() !!}
                                </div>
                            </div>
                            <input type="hidden" name="order_by" value="expiry_date" />
                            <input type="hidden" name="sort" value="desc" />
                        </fieldset>
                    </form>
                    <script>
                        $('#report').on('submit',function(){
                            if($('#from').val() && $('#to').val()){
                                $('#report').attr('target','_blank');
                            }
                        });
                    </script>
                </div>
            </div>
            <div class="row">
                <div class="large-6 columns">
                    <div id="container1"></div>
                </div>
                <div class="large-6 columns">
                    <div id="container2"></div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script type="text/javascript">
    </script>

@endsection
