<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\LaboratoryType;

class AlterTableLaboratoryAddColumnLaboratoryTestId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('laboratory_type', 'laboratory_test_id')) {
            Schema::table('laboratory_type', function (Blueprint $table) {
                $table->integer('laboratory_test_id');

            });
        }

        LaboratoryType::where('id','1')->update(['laboratory_test_id' => '1']);
        LaboratoryType::where('id','2')->update(['laboratory_test_id' => '2']);
        LaboratoryType::where('id','3')->update(['laboratory_test_id' => '3']);
        LaboratoryType::where('id','4')->update(['laboratory_test_id' => '3']);
        LaboratoryType::where('id','5')->update(['laboratory_test_id' => '3']);
        LaboratoryType::where('id','6')->update(['laboratory_test_id' => '3']);
        LaboratoryType::where('id','7')->update(['laboratory_test_id' => '4']);
        LaboratoryType::where('id','8')->update(['laboratory_test_id' => '5']);
        LaboratoryType::where('id','9')->update(['laboratory_test_id' => '5']);
        LaboratoryType::where('id','10')->update(['laboratory_test_id' => '5']);
        LaboratoryType::where('id','11')->update(['laboratory_test_id' => '5']);
        LaboratoryType::where('id','12')->update(['laboratory_test_id' => '6']);
        LaboratoryType::where('id','13')->update(['laboratory_test_id' => '7']);
        LaboratoryType::where('id','14')->update(['laboratory_test_id' => '8']);
        LaboratoryType::where('id','15')->update(['laboratory_test_id' => '9']);
        LaboratoryType::where('id','16')->update(['laboratory_test_id' => '10']);
        LaboratoryType::where('id','17')->update(['laboratory_test_id' => '11']);
        LaboratoryType::where('id','18')->update(['laboratory_test_id' => '12']);
        LaboratoryType::where('id','19')->update(['laboratory_test_id' => '13']);
        LaboratoryType::where('id','20')->update(['laboratory_test_id' => '14']);
        LaboratoryType::where('id','21')->update(['laboratory_test_id' => '14']);
        LaboratoryType::where('id','22')->update(['laboratory_test_id' => '15']);


        Schema::dropIfExists('laboratory_test_type');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laboratory', function (Blueprint $table) {
            //
        });
    }
}
