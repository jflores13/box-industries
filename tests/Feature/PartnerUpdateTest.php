<?php

namespace Tests\Feature;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PartnerUpdateTest extends TestCase
{
    use RefreshDatabase;

    private User $adminUser;

    private Partner $partner;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');

        // Create admin user
        $this->adminUser = User::factory()->create(['role' => 'admin']);

        // Create a partner
        $this->partner = Partner::create([
            'image_path' => 'partners/test-image.png',
            'alt_text' => 'Original Alt Text',
            'sort_order' => 1,
        ]);
    }

    public function test_partner_can_update_alt_text_only(): void
    {
        $response = $this->actingAs($this->adminUser)
            ->put("/admin/partners/{$this->partner->id}", [
                'alt_text' => 'Updated Alt Text',
            ]);

        $response->assertRedirect(route('partners.index'));

        $this->partner->refresh();
        $this->assertEquals('Updated Alt Text', $this->partner->alt_text);
        $this->assertEquals('partners/test-image.png', $this->partner->image_path);
    }

    public function test_partner_can_update_image_and_alt_text(): void
    {
        $file = UploadedFile::fake()->image('new-logo.png', 600, 600);

        $response = $this->actingAs($this->adminUser)
            ->post("/admin/partners/{$this->partner->id}", [
                'image' => $file,
                'alt_text' => 'New Alt Text',
                '_method' => 'PUT',
            ]);

        $response->assertRedirect(route('partners.index'));

        $this->partner->refresh();
        $this->assertEquals('New Alt Text', $this->partner->alt_text);
        $this->assertStringStartsWith('partners/', $this->partner->image_path);
        $this->assertNotEquals('partners/test-image.png', $this->partner->image_path);

        // Verify the file was stored
        $this->assertTrue(Storage::disk('public')->exists($this->partner->image_path));
    }

    public function test_partner_can_update_image_only(): void
    {
        $file = UploadedFile::fake()->image('another-logo.png', 600, 600);

        $response = $this->actingAs($this->adminUser)
            ->post("/admin/partners/{$this->partner->id}", [
                'image' => $file,
                'alt_text' => 'Original Alt Text',
                '_method' => 'PUT',
            ]);

        $response->assertRedirect(route('partners.index'));

        $this->partner->refresh();
        $this->assertEquals('Original Alt Text', $this->partner->alt_text);
        $this->assertStringStartsWith('partners/', $this->partner->image_path);
        $this->assertNotEquals('partners/test-image.png', $this->partner->image_path);

        // Verify the file was stored
        $this->assertTrue(Storage::disk('public')->exists($this->partner->image_path));
    }

    public function test_partner_update_validates_image_dimensions(): void
    {
        $file = UploadedFile::fake()->image('wrong-size.png', 400, 400);

        $response = $this->actingAs($this->adminUser)
            ->post("/admin/partners/{$this->partner->id}", [
                'image' => $file,
                'alt_text' => 'Some Alt Text',
                '_method' => 'PUT',
            ]);

        $response->assertSessionHasErrors(['image']);
    }

    public function test_partner_update_validates_image_format(): void
    {
        $file = UploadedFile::fake()->image('wrong-format.jpg', 600, 600);

        $response = $this->actingAs($this->adminUser)
            ->post("/admin/partners/{$this->partner->id}", [
                'image' => $file,
                'alt_text' => 'Some Alt Text',
                '_method' => 'PUT',
            ]);

        $response->assertSessionHasErrors(['image']);
    }
}
