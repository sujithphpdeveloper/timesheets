<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();
        $attributes = Attribute::all();

        foreach ($projects as $project) {

            // TODO : This seeder is only works for the predefined attributes
            $startDate = fake()->dateTimeBetween('-100 days', 'now');
            $endDate = fake()->dateTimeBetween($startDate, '+50 days');

            foreach ($attributes as $attribute) {
                $value = '';

                switch ($attribute->name) {

                    case 'department':
                        $value = fake()->randomElement(['Creative', 'Design', 'HR', 'IT', 'Operations', 'Product', 'Training', 'Legal']);
                        break;

                    case 'start_date':
                        $value = $startDate->format('Y-m-d');
                        break;

                    case 'end_date':
                        $value = $endDate->format('Y-m-d');
                        break;
                }


                AttributeValue::create([
                    'attribute_id' => $attribute->id,
                    'entity_id'    => $project->id,
                    'value'        => $value
                ]);
            }
        }
    }
}
