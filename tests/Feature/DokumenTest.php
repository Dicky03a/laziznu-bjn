<?php

use App\Models\Dokuemen;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\Features;

describe('Dokumen CRUD', function () {
      beforeEach(function () {
            Storage::fake('public');
            $this->user = User::factory()->create();
      });

      describe('Index', function () {
            test('authenticated user can view dokumens index', function () {
                  $dokumens = Dokuemen::factory(3)->create();

                  $response = $this->actingAs($this->user)
                        ->get(route('dokumens.index'));

                  $response->assertStatus(200);
                  $response->assertViewIs('admin.dokumens.index');
                  foreach ($dokumens as $dokumen) {
                        $response->assertSee($dokumen->nama_dokumen);
                  }
            });

            test('unauthenticated user cannot view dokumens index', function () {
                  $response = $this->get(route('dokumens.index'));

                  $response->assertRedirectToRoute('login');
            });

            test('index displays empty state when no dokumens exist', function () {
                  $response = $this->actingAs($this->user)
                        ->get(route('dokumens.index'));

                  $response->assertStatus(200);
                  $response->assertSee('Belum ada dokumen');
            });
      });

      describe('Create', function () {
            test('authenticated user can view create form', function () {
                  $response = $this->actingAs($this->user)
                        ->get(route('dokumens.create'));

                  $response->assertStatus(200);
                  $response->assertViewIs('admin.dokumens.create');
            });

            test('unauthenticated user cannot view create form', function () {
                  $response = $this->get(route('dokumens.create'));

                  $response->assertRedirectToRoute('login');
            });
      });

      describe('Store', function () {
            test('authenticated user can create dokumen with file', function () {
                  $file = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

                  $response = $this->actingAs($this->user)
                        ->post(route('dokumens.store'), [
                              'nama_dokumen' => 'Laporan Keuangan 2025',
                              'deskripsi' => 'Laporan keuangan tahunan',
                              'file' => $file,
                        ]);

                  $response->assertRedirectToRoute('dokumens.index');
                  $this->assertDatabaseHas('dokuemens', [
                        'nama_dokumen' => 'Laporan Keuangan 2025',
                        'deskripsi' => 'Laporan keuangan tahunan',
                        'jumlah_download' => 0,
                  ]);
                  Storage::disk('public')->assertExists('dokumens/' . basename(Dokuemen::latest()->first()->file));
            });

            test('file is stored in dokumens directory', function () {
                  $file = UploadedFile::fake()->create('doc.xlsx', 50, 'application/vnd.ms-excel');

                  $this->actingAs($this->user)
                        ->post(route('dokumens.store'), [
                              'nama_dokumen' => 'Data Excel',
                              'file' => $file,
                        ]);

                  $dokumen = Dokuemen::latest()->first();
                  Storage::disk('public')->assertExists('dokumens/' . basename($dokumen->file));
            });

            test('ukuran_file is recorded correctly', function () {
                  $file = UploadedFile::fake()->create('document.pdf', 512, 'application/pdf');

                  $this->actingAs($this->user)
                        ->post(route('dokumens.store'), [
                              'nama_dokumen' => 'Test Doc',
                              'file' => $file,
                        ]);

                  $dokumen = Dokuemen::latest()->first();
                  expect($dokumen->ukuran_file)->toBeGreaterThan(0);
            });

            test('validation fails without nama_dokumen', function () {
                  $file = UploadedFile::fake()->create('document.pdf');

                  $response = $this->actingAs($this->user)
                        ->post(route('dokumens.store'), [
                              'file' => $file,
                        ]);

                  $response->assertSessionHasErrors('nama_dokumen');
            });

            test('validation fails without file', function () {
                  $response = $this->actingAs($this->user)
                        ->post(route('dokumens.store'), [
                              'nama_dokumen' => 'Test Doc',
                        ]);

                  $response->assertSessionHasErrors('file');
            });

            test('validation fails with invalid file format', function () {
                  $file = UploadedFile::fake()->create('document.exe', 100, 'application/octet-stream');

                  $response = $this->actingAs($this->user)
                        ->post(route('dokumens.store'), [
                              'nama_dokumen' => 'Test Doc',
                              'file' => $file,
                        ]);

                  $response->assertSessionHasErrors('file');
            });

            test('validation fails when file exceeds max size', function () {
                  $file = UploadedFile::fake()->create('document.pdf', 11000, 'application/pdf');

                  $response = $this->actingAs($this->user)
                        ->post(route('dokumens.store'), [
                              'nama_dokumen' => 'Test Doc',
                              'file' => $file,
                        ]);

                  $response->assertSessionHasErrors('file');
            });

            test('unauthenticated user cannot store dokumen', function () {
                  $file = UploadedFile::fake()->create('document.pdf');

                  $response = $this->post(route('dokumens.store'), [
                        'nama_dokumen' => 'Test Doc',
                        'file' => $file,
                  ]);

                  $response->assertRedirectToRoute('login');
            });
      });

      describe('Show', function () {
            test('authenticated user can view dokumen detail', function () {
                  $dokumen = Dokuemen::factory()->create();

                  $response = $this->actingAs($this->user)
                        ->get(route('dokumens.show', $dokumen));

                  $response->assertStatus(200);
                  $response->assertViewIs('admin.dokumens.show');
                  $response->assertSee($dokumen->nama_dokumen);
            });

            test('unauthenticated user cannot view dokumen detail', function () {
                  $dokumen = Dokuemen::factory()->create();

                  $response = $this->get(route('dokumens.show', $dokumen));

                  $response->assertRedirectToRoute('login');
            });

            test('download button is present in show view', function () {
                  $dokumen = Dokuemen::factory()->create();

                  $response = $this->actingAs($this->user)
                        ->get(route('dokumens.show', $dokumen));

                  $response->assertSee('Download');
            });
      });

      describe('Edit', function () {
            test('authenticated user can view edit form', function () {
                  $dokumen = Dokuemen::factory()->create();

                  $response = $this->actingAs($this->user)
                        ->get(route('dokumens.edit', $dokumen));

                  $response->assertStatus(200);
                  $response->assertViewIs('admin.dokumens.edit');
                  $response->assertSee($dokumen->nama_dokumen);
            });

            test('unauthenticated user cannot view edit form', function () {
                  $dokumen = Dokuemen::factory()->create();

                  $response = $this->get(route('dokumens.edit', $dokumen));

                  $response->assertRedirectToRoute('login');
            });

            test('current file info is displayed in edit form', function () {
                  $dokumen = Dokuemen::factory()->create();

                  $response = $this->actingAs($this->user)
                        ->get(route('dokumens.edit', $dokumen));

                  $response->assertSee('File Saat Ini');
                  $response->assertSee(basename($dokumen->file));
            });
      });

      describe('Update', function () {
            test('authenticated user can update dokumen info only', function () {
                  $dokumen = Dokuemen::factory()->create([
                        'nama_dokumen' => 'Old Name',
                  ]);

                  $response = $this->actingAs($this->user)
                        ->put(route('dokumens.update', $dokumen), [
                              'nama_dokumen' => 'New Name',
                              'deskripsi' => 'Updated description',
                        ]);

                  $response->assertRedirectToRoute('dokumens.index');
                  $this->assertDatabaseHas('dokuemens', [
                        'id' => $dokumen->id,
                        'nama_dokumen' => 'New Name',
                        'deskripsi' => 'Updated description',
                  ]);
            });

            test('authenticated user can update dokumen with new file', function () {
                  $dokumen = Dokuemen::factory()->create();
                  $oldFile = $dokumen->file;

                  $newFile = UploadedFile::fake()->create('newdocument.pdf', 100, 'application/pdf');

                  $response = $this->actingAs($this->user)
                        ->put(route('dokumens.update', $dokumen), [
                              'nama_dokumen' => 'Updated Name',
                              'file' => $newFile,
                        ]);

                  $response->assertRedirectToRoute('dokumens.index');
                  $this->assertDatabaseHas('dokuemens', [
                        'id' => $dokumen->id,
                        'nama_dokumen' => 'Updated Name',
                  ]);
                  expect($dokumen->fresh()->file)->not->toBe($oldFile);
            });

            test('old file is deleted when new file is uploaded', function () {
                  $dokumen = Dokuemen::factory()->create();
                  $oldFile = $dokumen->file;

                  // Ensure old file exists
                  Storage::disk('public')->put($oldFile, 'content');

                  $newFile = UploadedFile::fake()->create('newdocument.pdf');

                  $this->actingAs($this->user)
                        ->put(route('dokumens.update', $dokumen), [
                              'nama_dokumen' => 'Updated',
                              'file' => $newFile,
                        ]);

                  Storage::disk('public')->assertMissing($oldFile);
            });

            test('validation fails with invalid file format on update', function () {
                  $dokumen = Dokuemen::factory()->create();
                  $file = UploadedFile::fake()->create('document.exe', 100);

                  $response = $this->actingAs($this->user)
                        ->put(route('dokumens.update', $dokumen), [
                              'nama_dokumen' => 'Test',
                              'file' => $file,
                        ]);

                  $response->assertSessionHasErrors('file');
            });

            test('unauthenticated user cannot update dokumen', function () {
                  $dokumen = Dokuemen::factory()->create();

                  $response = $this->put(route('dokumens.update', $dokumen), [
                        'nama_dokumen' => 'Updated Name',
                  ]);

                  $response->assertRedirectToRoute('login');
            });
      });

      describe('Delete', function () {
            test('authenticated user can delete dokumen', function () {
                  $dokumen = Dokuemen::factory()->create();
                  $dokumenId = $dokumen->id;

                  $response = $this->actingAs($this->user)
                        ->delete(route('dokumens.destroy', $dokumen));

                  $response->assertRedirectToRoute('dokumens.index');
                  $this->assertDatabaseMissing('dokuemens', [
                        'id' => $dokumenId,
                  ]);
            });

            test('file is deleted when dokumen is deleted', function () {
                  $dokumen = Dokuemen::factory()->create();
                  $file = $dokumen->file;

                  // Ensure file exists
                  Storage::disk('public')->put($file, 'content');

                  $this->actingAs($this->user)
                        ->delete(route('dokumens.destroy', $dokumen));

                  Storage::disk('public')->assertMissing($file);
            });

            test('unauthenticated user cannot delete dokumen', function () {
                  $dokumen = Dokuemen::factory()->create();

                  $response = $this->delete(route('dokumens.destroy', $dokumen));

                  $response->assertRedirectToRoute('login');
            });
      });

      describe('Download', function () {
            test('download endpoint increments counter', function () {
                  $dokumen = Dokuemen::factory()->create(['jumlah_download' => 5]);
                  Storage::disk('public')->put($dokumen->file, 'file content');

                  $response = $this->actingAs($this->user)
                        ->get(route('dokumens.download', $dokumen));

                  expect($dokumen->fresh()->jumlah_download)->toBe(6);
            });

            test('download starts from 0 counter', function () {
                  $dokumen = Dokuemen::factory()->create(['jumlah_download' => 0]);
                  Storage::disk('public')->put($dokumen->file, 'file content');

                  $response = $this->actingAs($this->user)
                        ->get(route('dokumens.download', $dokumen));

                  expect($dokumen->fresh()->jumlah_download)->toBe(1);
            });
      });
});
