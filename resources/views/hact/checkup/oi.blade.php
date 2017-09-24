<div id="oiModal" class="reveal-modal" data-reveal aria-labelledby="OITitle" aria-hidden="true" role="dialog">
    <form id="oi_form" action="{{ route('checkup_store_session') }}" action="get">
        <input type="hidden" id="ses_key" name="key" value="" />
        <input type="hidden" name="med_type" value="oi">
        <div class="row">
            <div class="large-12 columns">
                <h4 id="OITitle">OI Medicine</h4>
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
                <label for="specified_medicine">Specify Medicine</label>
                <input type="text" name="specified_medicine" id="specified_medicine" value="">
            </div>
            <div class="large-4 columns">
                <label for="pills_per_day">Frequency</label>
                <input type="text" name="pills_per_day" id="pills_per_day" value="">
            </div>
        </div>

        <div class="row">
            <div class="large-4 columns">
                <label for="date_started">Date Prescribed</label>
                <input type="text" name="date_started" id="date_started" class="fdatepicker" value="" readonly>
            </div>
            <div class="large-4 columns">
                <label for="date_started">Suggested Dosage</label>
                <input type="text" name="suggested_dosage" id="suggested_dosage" value="">
            </div>
            <div class="large-4 columns">
                {!! csrf_field() !!}
                <button id="add_oi" class="button small alert expand" type="submit">Add</button>
            </div>
        </div>
    </form>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>