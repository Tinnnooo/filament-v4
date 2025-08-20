<?php

namespace Database\Factories;

use App\Models\MsgraphMessage;
use App\Models\Recipient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MsgraphMessage>
 */
class MsgraphMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => $this->faker->sentence(),
            'from_name' => $this->faker->name(),
            'from_email_address' => $this->faker->safeEmail(),
            'has_attachments' => $this->faker->boolean(),
            'received_date_time' => $this->faker->dateTime(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (MsgraphMessage $message) {
            Recipient::factory(rand(1, 5))->create([
                'msgraph_message_id' => $message->id,
            ]);
        });
    }
}
