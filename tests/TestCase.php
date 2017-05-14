<?php

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * create an Admin User
     *
     * @return \Runner\Filter\Factory
     */
    protected function createOperatorUser()
    {
        return factory('App\User')->create([
            'email'      => 'demola@gmail.com',
            'password'   => bcrypt('london'),
            'first_name' => 'Demola',
            'last_name'  => 'Raimi',
            'role_id'    => 3,
            'avatar'     => 'https://en.gravatar.com/userimage/102347280/b3e9c138c1548147b7ff3f9a2a1d9bb0.png?size=200',
        ]);
    }

    /**
     * create a Patient
     *
     * @return \Runner\Filter\Factory
     */
    protected function createPatient()
    {
        return factory('App\Patient')->create([
            'email'      => 'demola@gmail.com',
            'name'   => 'Raimi Ademola',
            'phone_number' => '08032186996',
            'date_of_birth'  => '12/24/2016',
            'patient_id'    => 38726836,
            'case_number'   => 84743883,
        ]);
    }

    /**
     * create a report
     *
     * @return \Runner\Filter\Factory
     */
    protected function createReport()
    {
        $patient = $this->createPatient();

        return factory('App\Report')->create([
            'patient_id'   => $patient->id,
            'description' => '08032186996',
            'statement'  => '12/24/2016',
        ]);
    }

    /**
     * create a staff user- ordinary user
     *
     * @return \Runner\Filter\Factory
     */
    protected function createStaff()
    {
        return factory('App\User')->create([
            'email'      => 'ramah_ng@sample.com',
            'password'   => bcrypt('london'),
            'role_id' => 1,
            'first_name'  => 'Ahmed',
            'last_name'  => 'Raimi',
            'avatar'     => 'https://en.gravatar.com/userimage/102347280/b3e9c138c1548147b7ff3f9a2a1d9bb0.png?size=200',
        ]);
    }
}
