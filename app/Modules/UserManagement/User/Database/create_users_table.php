<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\UserManagement\User\Database\create_users_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->nullable();
            $table->string('user_name', 50)->nullable();
            $table->tinyInteger('role_serial')->default(3);
            $table->string('email', 50)->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('photo',100)->default('avatar.png');
            $table->string('password', 100)->nullable();
            $table->bigInteger('role_id')->default(3);
            $table->tinyInteger('is_blocked')->default(0);
            $table->integer('no_of_attempt')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug',50)->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->timestamps();
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
