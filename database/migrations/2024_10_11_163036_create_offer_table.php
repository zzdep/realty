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
        if (!Schema::hasTable('offer')) {
            Schema::create('offer', function (Blueprint $table) {
                $table->bigInteger('id', true);
                $table->string('uuid', 36)->nullable()->comment('UUID');
                $table->bigInteger('b24_contact_id')->nullable()->comment('id контакт из Битрикс24');
                $table->bigInteger('b24_deal_id')->nullable()->comment('id сделки из Битрикс24');
                $table->bigInteger('b24_manager_id')->nullable()->comment('id сотрудника из Битрикс24');
                $table->string('manager', 100)->nullable()->comment('ФИО Сотрудника');
                $table->string('position', 100)->nullable()->comment('Должность сотрудника');
                $table->string('phone', 100)->nullable()->comment('Телефон сотрудника');
                $table->string('avatar', 100)->nullable()->comment('Ссылка на фото');
                //$table->bigInteger('status')->nullable()->comment('Статус обработки (Новая, Отправлена клиенту, Просмотрена клиентом)');
                $table->enum('status', [ 'Новая', 'Отправлена клиенту', 'Просмотрена клиентом' ])
                    ->nullable()
                    ->comment('Статус обработки');
                $table->date('date_end')->nullable()->comment('Дата истечения действия подборки для клиента');
                $table->date('created_at')->nullable()->comment('Дата создания подборки');
                $table->date('updated_at')->nullable()->comment('Дата обновления подборки');
            });
        }

        if (!Schema::hasTable('offer_items')) {
            Schema::create('offer_items', function (Blueprint $table) {
                $table->bigInteger('id', true);
                $table->bigInteger('offer_id')->nullable()->comment('Связь с подборкой');
                $table->string('cid', 100)->nullable()->comment('Уникальный id из 1С');
                $table->string('type', 100)->nullable()->comment('Тип квартиры (Евродвушка)');
                $table->double('square', 100)->nullable()->comment('Площадь');
                $table->integer('price')->nullable()->comment('Цена');
                $table->string('complex', 100)->nullable()->comment('Название ЖК');
                $table->string('house', 100)->nullable()->comment('Название дома');
                $table->text('description')->nullable()->comment('Описание квартиры');
                $table->json('images', 100)->nullable()->comment('Массив ссылок на картинки (тип json array). Ссылки на картинки из текущего проекта');
                $table->boolean('like')->nullable()->comment('Отметка “Нравится” ');
                $table->date('created_at')->nullable()->comment('Дата создания');
                $table->date('updated_at')->nullable()->comment('Дата обновления');
            });

            Schema::table('offer_items', function (Blueprint $table) {
                $table->foreign(['offer_id'], 'FK_offers')->references(['id'])->on('offer')->onUpdate('NO ACTION')->onDelete('CASCADE');
            });
        }

        if (!Schema::hasTable('users_auth_mobile')) {
            Schema::create('users_auth_mobile', function (Blueprint $table) {
                $table->bigInteger('id', true);
                $table->string('bearer', 80)->nullable()->comment('Токен доступа');
                $table->bigInteger('users_id')->unsigned()->nullable()->comment('Юзер');
            });

            Schema::table('users_auth_mobile', function (Blueprint $table) {
                $table->foreign(['users_id'], 'FK_users_auth_mobile_users')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_auth_mobile');
        Schema::dropIfExists('offer_items');
        Schema::dropIfExists('offer');
    }
};
