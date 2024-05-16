<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_ventes', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->integer('quantiteStock');
            $table->string('reference');
            $table->string('promo')->nullable();
            $table->integer('marge')->nullable();
            $table->float('coutFabrication');
            $table->float('prixVente');
            $table->foreignId("categorie_id")->constrained("categories");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_ventes');
    }
};
