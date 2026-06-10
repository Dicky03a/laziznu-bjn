<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(
    Tests\TestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
)->in('Feature');

/** Fake file PDF yang lolos validasi mimes:pdf via magic bytes %PDF-. */
function fakePdf(string $name = 'laporan.pdf'): Illuminate\Http\UploadedFile
{
    return Illuminate\Http\UploadedFile::fake()->createWithContent($name, "%PDF-1.4\n%%EOF");
}
