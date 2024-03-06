    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateAddedToCartProductsTable extends Migration
    {
        public function up()
        {
            Schema::create('added_to_cart_products', function (Blueprint $table) {
                // Remove the auto-incrementing primary key
                $table->id();

                $table->foreignId('product_id')->constrained('products');
                $table->foreignId('buyer_id')->constrained('users');
                $table->integer('quantity');
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('added_to_cart_products');
        }
    }
