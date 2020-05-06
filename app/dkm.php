Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('title');
            $table->integer('price');  
            $table->integer('sale_price');  
            $table->string('image');
            $table->longText('detail');
            $table->string('list_image');    
            $table->integer('category_id')->unsigned();  
            $table->integer('user_id')->unsigned();
            $table->integer('status');      
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');;
            $table->foreign('user_id')->references('id')->on('users') ->onDelete('cascade');;
        });

        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });