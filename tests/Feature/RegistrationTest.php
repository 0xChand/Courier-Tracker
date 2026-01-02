<?php

test('User Can See Dashboard Or Not', function () {
    
    $user = User::factory()->create();

    $response = $this->actingAs('$user')->get('/dashboard');
    $response->assertStatus(200);
    $response->assertSee('Works');
});

test('Registration', function () {
    
    

    $this->post('register');
    
    $response->assertStatus(302);
    $response->assertSee('Registered');
});

