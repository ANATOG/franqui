<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFranchisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franchises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('slug')->index()->unique();
            $table->string('business_name')->nullable();
            $table->string('vat_condition')->nullable();
            $table->string('cuit')->nullable();
            $table->string('contact_address')->nullable();
            $table->string('authorizes_recruitment')->nullable();
            $table->string('contrac_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contracting_period')->nullable();
            $table->string('way_pay')->nullable();
            $table->text('description')->nullable();
            $table->string('description_red')->nullable();
            $table->string('country')->nullable();
            $table->string('country_in')->nullable();
            $table->string('grand_open')->nullable();
            $table->string('franchises_first_open')->nullable();
            $table->string('franchises_local')->nullable();
            $table->string('franchises_this_year')->nullable();
            $table->string('franchises_total')->nullable();
            $table->string('partners')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('fee')->nullable();
            $table->string('royalty')->nullable();
            $table->string('total_investment')->nullable();
            $table->string('corporate_advertising')->nullable();
            $table->string('canon_advertising')->nullable();
            $table->string('financing_available')->nullable();
            $table->string('average_annual')->nullable();
            $table->string('recover_estimated')->nullable();
            $table->string('premises_size')->nullable();
            $table->string('employees')->nullable();
            $table->string('contract_term')->nullable();
            $table->string('exportable_franchise')->nullable();
            $table->string('first_reasons')->nullable();
            $table->string('second_reasons')->nullable();
            $table->string('third_reasons')->nullable();
            $table->string('fourth_reasons')->nullable();
            $table->string('fifth_reasons')->nullable();
            $table->string('video')->nullable();
            $table->text('string_tags')->nullable();
            $table->integer('first_suggested')->nullable();
            $table->integer('second_suggested')->nullable();
            $table->integer('third_suggested')->nullable();
            $table->integer('subject_id')->unsigned()->nullable();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('set null');
            $table->integer('thematic_id')->unsigned()->nullable();
            $table->foreign('thematic_id')->references('id')->on('thematics')->onDelete('set null');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->boolean('highlights')->default(false);
            $table->boolean('weekly')->default(false);
            $table->boolean('subject_highlight')->default(false);
            $table->integer('order')->default(9999)->index();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->boolean('visible')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('franchises');
    }
}
