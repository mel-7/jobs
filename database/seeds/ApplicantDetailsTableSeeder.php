<?php

use Illuminate\Database\Seeder;

class ApplicantDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $applicantDetail = new \App\Applicant_details([
            'user'      => 2,
            'type'      => 'work_experience',
            'startdate' => '2002-04-01 00:04:00',
            'todate'    => null,
            'topresent' => 1,
            'value'     => '{"jobtitle":"Web Developer","company":"GAG","city":"Dubai","description":"Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."}'
        ]);
        $applicantDetail->save();
        $applicantDetail = new \App\Applicant_details([
            'user'    => 2,
            'type'    => 'work_experience',
            'startdate' => '2002-04-01 00:04:00',
            'todate'    => '2050-04-01 00:04:00',
            'topresent' => null,
            'value'   => '{"jobtitle":"Web Developer","company":"Grandiose","city":"Dubai","description":"Simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."}'
        ]);
        $applicantDetail->save();
        $applicantDetail = new \App\Applicant_details([
            'user'    => 2,
            'type'    => 'work_experience',
            'startdate' => '2002-04-01 00:04:00',
            'todate'    => '2060-04-01 00:04:00',
            'topresent' => null,
            'value'   => '{"jobtitle":"Web Developer","company":"OTC","city":"Dubai","description":"Standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."}'
        ]);
        $applicantDetail->save();
        $applicantDetail = new \App\Applicant_details([
            'user'    => 1,
            'type'    => 'work_experience',
            'startdate' => '2002-04-01 00:04:00',
            'todate'    => '2070-04-01 00:04:00',
            'topresent' => null,
            'value'   => 'Testing Testing'
        ]);
        $applicantDetail->save();
    }
}
