<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GeneralTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testThatIndexRedirectsToForm()
    {
        $response = $this->get('/');
        $response->assertStatus(302)
            ->assertHeader('location', 'http://localhost/form');
    }

    public function testThatFormIsOk()
    {
        $response = $this->get('/form');
        $response->assertStatus(200);
    }

    public function testFormSubmittedWithValidDataToBeSuccessful()
    {
        $symbol = 'AAL';
        $startDate = '2022-07-02';
        $endDate = '2022-07-23';
        $email = 'am.papacostas@gmail.com';
        $emailUrl = urlencode($email);
        $validPostData = [
            'symbol' => $symbol,
            'start-date' => $startDate,
            'end-date' => $endDate,
            'email' => $email
        ];
        $expectedLocation = "http://localhost/table?data%5Bsymbol%5D=$symbol&data%5Bstart-date%5D=$startDate&data%5Bend-date%5D=$endDate&data%5Bemail%5D=$emailUrl";
        $response = $this->post('/form/submit', $validPostData)
            ->assertHeader('location', $expectedLocation);
    }

    public function testFormSubmittedWithEmptyDataRedirects()
    {
        $validPostData = [
            'symbol' => 'AAL',
            'start-date' => '2022-07-02',
            'end-date' => '2022-07-23',
            'email' => 'am.papacostas@gmail.com'
        ];
        $postBody = $validPostData;
        $postBody['symbol'] = '';
        $response = $this->post('/form/submit', $postBody);
        $response->assertHeader('location', 'http://localhost');

        $postBody = $validPostData;
        $postBody['start-date'] = '';
        $response = $this->post('/form/submit', $postBody);
        $response->assertHeader('location', 'http://localhost');

        $postBody = $validPostData;
        $postBody['end-date'] = '';
        $response = $this->post('/form/submit', $postBody);
        $response->assertHeader('location', 'http://localhost');

        $postBody = $validPostData;
        $postBody['email'] = '';
        $response = $this->post('/form/submit', $postBody);
        $response->assertHeader('location', 'http://localhost');
    }

    public function testDatesStartDateTodayFalse()
    {
        $validPostData = [
            'symbol' => 'AAL',
            'start-date' => '2022-07-02',
            'end-date' => '2022-07-23',
            'email' => 'am.papacostas@gmail.com'
        ];
        $today = now()->toDate()->format('Y-m-d');
        $postBody = $validPostData;
        $postBody['start-date'] = $today;
        $response = $this->post('/form/submit', $postBody);
        $response->assertHeader('location', 'http://localhost');
    }

    public function testDatesEndDateTomorrowFalse()
    {
        $validPostData = [
            'symbol' => 'AAL',
            'start-date' => '2022-07-02',
            'end-date' => '2022-07-23',
            'email' => 'am.papacostas@gmail.com'
        ];
        $postBody = $validPostData;
        $postBody['end-date'] = date_add(now(), date_interval_create_from_date_string("1 day"))->toDate()->format('Y-m-d');
        $response = $this->post('/form/submit', $postBody);
        $response->assertHeader('location', 'http://localhost');
    }

    public function testDatesStartDateAfterEndDateFalse()
    {
        $validPostData = [
            'symbol' => 'AAL',
            'start-date' => '2022-07-02',
            'end-date' => '2022-07-23',
            'email' => 'am.papacostas@gmail.com'
        ];
        $postBody = $validPostData;
        $postBody['end-date'] = date_sub(now(), date_interval_create_from_date_string("5 days"))->toDate()->format('Y-m-d');
        $postBody['start-date'] = date_sub(now(), date_interval_create_from_date_string("2 days") )->toDate()->format('Y-m-d');
        $response = $this->post('/form/submit', $postBody);
        $response->assertHeader('location', 'http://localhost');
    }

    public function testSymbolWrongSymbolFalse()
    {
        $validPostData = [
            'symbol' => 'AAL',
            'start-date' => '2022-07-02',
            'end-date' => '2022-07-23',
            'email' => 'am.papacostas@gmail.com'
        ];
        $postBody = $validPostData;
        $postBody['symbol'] = 'wrong';
        $response = $this->post('/form/submit', $postBody);
        $response->assertHeader('location', 'http://localhost');
    }

    public function testEmailWrongFormatFalse()
    {
        $validPostData = [
            'symbol' => 'AAL',
            'start-date' => '2022-07-02',
            'end-date' => '2022-07-23',
            'email' => 'am.papacostas@gmail.com'
        ];
        $postBody = $validPostData;
        $postBody['email'] = 'wrongemail';
        $response = $this->post('/form/submit', $postBody);
        $response->assertHeader('location', 'http://localhost');

        $postBody['email'] = 'wrongemail@';
        $response = $this->post('/form/submit', $postBody);
        $response->assertHeader('location', 'http://localhost');

        $postBody['email'] = 'wrongemail@.';
        $response = $this->post('/form/submit', $postBody);
        $response->assertHeader('location', 'http://localhost');
    }
}
