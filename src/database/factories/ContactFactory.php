<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;


class ContactFactory extends Factory
{
    /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
    protected $model = \App\Models\Contact::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $details = [
            '商品がまだ届いていません。',
            '返品をしたいのですが、手続き方法を教えてください。',
            'クレジットカードの明細に不明な請求があります。',
            '注文内容を変更したいです。',
            '問い合わせフォームがうまく送信できません。',
            // ↑ ここに上記例文をどんどん追加！
        ];

        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->numberBetween(1, 3),
            'email' => $this->faker->unique()->safeEmail,
            'tel' => $this->faker->numerify('080########'),
            'address' => $this->faker->address,
            'building' => $this->faker->secondaryAddress,
            'category_id' => $this->faker->numberBetween(1, 5),
            'detail' => $this->faker->randomElement($details),
    ];
}

}
