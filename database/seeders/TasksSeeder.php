<?php

namespace Database\Seeders;

use App\Models\Tasks;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tasks::factory()->create([
            'name' => 'Submit report',
            'assigned_by' => 'Jesus Bermudo',

            'requirements' => 'Just letting you in on the rubrics to be used for our final project.  This will serve as your guide as to how you would be graded accordingly for both the Project Documentation and Presentation.  

            Please be reminded that apart from being graded as a group, each presenter will also earn individual performance scores.  
            
            Group scores will only be 50% of your individual scores.  The remaining 50% will be derived from the individual scores earned during the presentation.  
            
            Lastly, there is "nothing to submit / turn in" for this particular task.  
            
            Let me know if you have any clarifications.
            
            Thank you. ',
            'task_start' => '2021-10-14',            
            'task_due' => '2021-10-20',
            'staff_id' => '1',
            'status' => 'Unfinished'
        ]);
    }
}