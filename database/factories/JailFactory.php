<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $states = ["Alaska", "Alabama", "Arkansas", "Arizona", "California", "Colorado", "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Iowa", "Idaho", "Illinois", "Indiana", "Kansas", "Kentucky", "Louisiana", "Massachusetts", "Maryland", "Maine", "Michigan", "Minnesota", "Missouri", "Mississippi", "Montana", "North Carolina", "North Dakota", "Nebraska", "New Hampshire", "New Jersey", "New Mexico", "Nevada", "New York", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Virginia", "Vermont", "Washington", "Wisconsin", "West Virginia", "Wyoming"];

        $state = $this->faker->unique()->randomElement($states);

        $jailSuffix = ['Prison','Penitentiary','Correctional Facility','Detention Center','Workhouse'];

        return [
            //
            'name' => $state . ' ' . $this->faker->randomElement($jailSuffix),
            'admin_email' => $this->faker->unique()->safeEmail(),
            'city' => $this->faker->city(),
            'state' => $state
        ];
    }
}
