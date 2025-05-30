<?php

test('homepage is accessible', function () {
    $response = $this->get('/')->assertOk();
    $response->assertStatus(200);
});

test('login page is accessible', function () {
    $response = $this->get('/login')->assertOk();
    $response->assertStatus(200);
});

test('register page is accessible', function () {
    $response = $this->get('/register')->assertOk();
    $response->assertStatus(200);
});

test('dashboard requires authentication', function () {
    $response = $this->get('/dashboard')->assertRedirect('/login');
    $response->assertRedirect('/login');
});

test('verify-otp page redirects without user', function () {
    $response = $this->get('/verify-otp');
    $response->assertRedirect('/');
});

test('articles page redirects if not authenticated', function () {
    $response = $this->get('/articles');
    $response->assertRedirect('/login');
});

test('create article page redirects if not authenticated', function () {
    $response = $this->get('/articles/create');
    $response->assertRedirect('/login');
});
