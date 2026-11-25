<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->integer('quantity');
            $table->decimal('price', 8, 2);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        DB::table('products')->insert([
            'code' => 'P001',
            'name' => 'A revolução dos Bichos',
            'quantity' => 100,
            'price' => 35.90,
            'description' => 'Animal Farm é um romance satírico do escritor inglês George Orwell, publicado no Reino Unido 
                            em 17 de agosto de 1945 e incluído pela revista americana Time na Lista dos 
                            100 melhores romances da língua inglesa.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'code' => 'P002',
            'name' => 'O Senhor dos Anéis',
            'quantity' => 125,
            'price' => 80.90,
            'description' => 'O Senhor dos Anéis é uma obra de fantasia épica escrita por J. R. R. Tolkien, publicada em três volumes entre 1954 e 1955. 
                            A história se passa na Terra-média e segue a jornada de um hobbit chamado Frodo Bolseiro, 
                            que recebe a tarefa de destruir o Um Anel, um artefato maligno criado pelo Senhor do Escuro Sauron.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        //Esse eu li kdfskfksdk
        DB::table('products')->insert([
            'code' => 'P003',
            'name' => 'A guerra que salvou minha vida',
            'quantity' => 75,
            'price' => 40.59,
            'description' => 'A guerra que salvou minha vida é um livro escrito por John R. David, publicado em 2020. 
                            O livro conta a história de um jovem que enfrenta os desafios da vida durante a Segunda Guerra Mundial.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'code' => 'P004',
            'name' => '1984',
            'quantity' => 150,
            'price' => 25.70,
            'description' => '1984 é um romance distópico escrito por George Orwell, publicado em 1948. 
                            A obra retrata um futuro sombrio onde a sociedade é controlada por um regime autoritário.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'code' => 'P005',
            'name' => 'A droga da obediência',
            'quantity' => 40,
            'price' => 20,
            'description' => 'A Droga da Obediência é um livro de ficção infantojuvenil escrito por Pedro Bandeira e publicado em 1984, através da Editora Moderna.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'code' => 'P006',
            'name' => 'Contos dos irmãos Grimm',
            'quantity' => 60,
            'price' => 30.50,
            'description' => 'Contos dos irmãos Grimm é uma coleção de contos de fadas compilada pelos irmãos Jacob e Wilhelm Grimm.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
