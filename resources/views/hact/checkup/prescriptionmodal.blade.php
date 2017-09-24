<div id="arvRegimenModal" class="reveal-modal" data-reveal aria-labelledby="arvRegimenTitle" aria-hidden="true" role="dialog">
    <form id="arv_regimen_form" action="{{ route('checkup_store_session') }}" action="get">
        <input type="hidden" id="ses_key" name="key" value="" />
        <input type="hidden" name="med_type" value="arv">
        <div class="row">
            <div class="large-12 columns">
                <h4 id="arvRegimenTitle">ARV Regimen</h4>
            </div>
        </div>
        <div class="row">
            <div class="large-4 columns">
                <label for="search_vct">Patient</label>
                <div class="row collapse">
                    <div class="small-10 columns">
                        <input type="text" id="search_vct" name="search_vct" value="{{ $search_vct }}" readonly/>
                    </div>
                    <div class="small-2 columns">
                        <span class="postfix"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
            <div class="large-4 columns">
                <label for="search_medicine">Medicine</label>
                <div class="row collapse">
                    <div class="small-10 columns">
                        <input type="text" id="search_medicine" name="search_medicine" value="" >
                        <input type="hidden" id="medicine_id" name="medicine_id" value="" />
                        <input type="hidden" id="search_item_url" name="search_item_url" value="{{ route('prescription_search_json') }}" />
                    </div>
                    <div class="small-2 columns">
                        <span class="postfix"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
            <div class="large-4 columns">
                {{--<label for="specified_medicine">Specify Medicine</label>--}}
                {{--<input type="text" name="specified_medicine" id="specified_medicine" value="">--}}
                <label for="pills_per_day">No. of pills per day</label>
                <input type="text" name="pills_per_day" id="pills_per_day" value="">
            </div>
        </div>

        <div class="row">
            <div class="large-4 columns">
                <label for="date_started">Date Prescribed</label>
                <input type="text" name="date_started" id="date_started" class="fdatepicker" value="" readonly>
            </div>
            <div class="large-4 columns">
                <input type="hidden" name="infection">
                {{--<label for="infections">Infection</label>
                <select id="infection" name="infection">
                    <option value=""></option>
                    @foreach($infections as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>--}}
            </div>
            <div class="large-4 columns">

            </div>
        </div>


        <div class="row">
            <div class="large-4 columns">
                <label for="date_discontinued">Date Discontinued</label>
                <input type="text" name="date_discontinued" id="date_discontinued" class="fdatepicker" value="" readonly>
            </div>
            <div class="large-4 columns">
                <label for="prescription_reason">Reason</label>
                <select name="prescription_reason" id="prescription_reason">
                    <option value=""></option>
                    <option value="1">Treatment Failure</option>
                    <option value="2">Clinical Progression/Hospitalization</option>
                    <option value="3">Patient Decision/Request</option>
                    <option value="4">Compliance Difficulties</option>
                    <option value="5">Drug Interaction</option>
                    <option value="6">Adverse Event (Specify)</option>
                    <option value="7">Others (Specify)</option>
                    <option value="8">Death</option>
                </select>
            </div>
            <div class="large-4 columns">
                <label for="prescription_specify">Specify</label>
                <input type="text" name="prescription_specify" id="prescription_specify" value="" readonly>
            </div>
        </div>

        <div class="row">
            <div class="large-3 columns">
                {!! csrf_field() !!}
                <button id="add_arv" class="button small alert expand" type="submit">Add</button>
            </div>
            <div class="large-3 columns">&nbsp;</div>
            <div class="large-3 columns">&nbsp;</div>
            <div class="large-3 columns">&nbsp;</div>
        </div>
    </form>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>