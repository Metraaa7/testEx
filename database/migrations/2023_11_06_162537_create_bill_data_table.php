<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\BillData;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $fil = new  BillData;
        Schema::create('bill_data', function (Blueprint $table) use ($fil) {
            $table->id();
            foreach ($fil->getFillable() as $field) {
                $table->string($field);
            }
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_data');
    }
};
