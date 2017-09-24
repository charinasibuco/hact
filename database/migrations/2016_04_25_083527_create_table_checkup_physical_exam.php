<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCheckupPhysicalExam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('checkup_physical_exam')){
            Schema::create('checkup_physical_exam', function(Blueprint $table){
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('checkup_id');
                $table->enum('general_survey',['Awake','Drowsy','Unconscious','Ambulatory','CP distress'])->nullable()->default(NULL);
                $table->enum('skin',['Warm to touch','cyaqnosis','jaundice','rashes'])->nullable()->default(NULL);
                $table->text('heent')->nullable()->default(NULL);
                $table->enum('lips_buccal_mucosa',['Moist','Dry'])->nullable()->default(NULL);
                $table->enum('sclerae',['Anicteric','Icteric'])->nullable()->default(NULL);
                $table->enum('conjunctivae',['Pinkish','Pale'])->nullable()->default(NULL);
                $table->enum('chest_and_lungs',['SCE','Retractions','Masses','CBS','Wheeze','Crackles','Dec/absent breath sounds'])->nullable()->default(NULL);
                $table->enum('cardial',['AP','NRRR','Tachycardia','Distinct S1/S2','Murmur'])->nullable()->default(NULL);
                $table->enum('abdomen',['flat','Globular/distended','Soft','Nontender','Masses'])->nullable()->default(NULL);
                $table->enum('extremities',['Grossly normal','Edema','Ulcerations','FPP','Good ROM','Joint swelling/tenderness'])->nullable()->default(NULL);

                /**
                 * Remarks
                 */
                $table->text('general_survey_remarks')->nullable()->default(NULL);
                $table->text('skin_remarks')->nullable()->default(NULL);
                $table->text('heent_remarks')->nullable()->default(NULL);
                $table->text('chest_and_lungs_remarks')->nullable()->default(NULL);
                $table->text('cardial_remarks')->nullable()->default(NULL);
                $table->text('abdomen_remarks')->nullable()->default(NULL);
                $table->text('extremities_remarks')->nullable()->default(NULL);

//                $table->foreign('checkup_id')->references('id')->on('checkup')->onDelete('cascade');

                $table->index(['id','checkup_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('checkup_physical_exam');
    }
}
