<?php

namespace App\Console\Commands;

use App\Mail\StudentsOrderFinished;
use App\Models\User;
use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Facades\Mail;

class orderStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:students';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sort students by their school orders';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $admin = User::where('is_admin', 1)->first();
        DB::table('schools')
            ->join('students', 'students.school_id', '=', 'schools.id')
            ->select('schools.id as schools_id', 'schools.name as school_name', 'students.name as std_name', 'students.order as std_order',
                DB::raw('CONCAT(schools.name,"_",students.order) as students_order'))
            ->orderBy('schools.id')
            ->get();
        $this->info('Students is ordered successfully');
        \Mail::to($admin->email)->send(new StudentsOrderFinished());
    }
}
