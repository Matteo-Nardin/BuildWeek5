<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Book;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //l'admin può cancellare le prenotazioni di qualsiasi utenete
        //l'utente cancella la prenotazione
        $status=['effettuata','cancellata'];
        return [
            'status' => fake()->randomElement($status),
            'user_id' => User::get()->random()->id,
            'book_id' => Book::get()->random()->id,
        ];
    }
}
