<?php
namespace Tests\Unit;

use App\Models\Article;
use App\Models\User;
use App\Notifications\ArticlePublishedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@gmail.com',
        ]);
    }

    #[Test]
    public function it_can_create_an_article_with_published_status()
    {
        Notification::fake();
        Event::fake();

        $response = $this->actingAs($this->user)->postJson(route('articles.store'), [
            'title' => 'Test Artikel',
            'slug' => 'test-artikel',
            'content' => 'Ini adalah konten artikel.',
            'status' => 'published',
            '_token' => csrf_token(),
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Artikel dibuat!',
                'redirect' => route('articles.index'),
            ]);

        $this->assertDatabaseHas('articles', [
            'title' => 'Test Artikel',
            'slug' => 'test-artikel',
            'status' => 'published',
            'user_id' => 1,
        ]);

        $article = Article::first();
        Notification::assertSentTo($this->user, ArticlePublishedNotification::class, function ($notification) use ($article) {
            return $notification->article->id === $article->id;
        });

        Event::assertDispatched(\App\Events\ArticlePublished::class);
    }

    #[Test]
    public function it_can_create_an_article_with_draft_status()
    {
        Notification::fake();
        Event::fake();

        $response = $this->actingAs($this->user)->postJson(route('articles.store'), [
            'title' => 'Draft Artikel',
            'slug' => 'draft-artikel',
            'content' => 'Ini adalah konten draft.',
            'status' => 'draft',
            '_token' => csrf_token(),
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Artikel dibuat!',
                'redirect' => route('articles.index'),
            ]);

        $this->assertDatabaseHas('articles', [
            'title' => 'Draft Artikel',
            'slug' => 'draft-artikel',
            'status' => 'draft',
            'user_id' => 1,
        ]);

        Notification::assertNotSentTo($this->user, ArticlePublishedNotification::class);
        Event::assertNotDispatched(\App\Events\ArticlePublished::class);
    }

    #[Test]
    public function it_can_read_article_list()
    {
        Article::factory()->create([
            'title' => 'Test Artikel',
            'slug' => 'test-artikel',
            'user_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->user)->get(route('articles.index'));

        $response->assertStatus(200)
            ->assertViewHas('articles', function ($articles) {
                return $articles->contains('title', 'Test Artikel');
            });
    }

    #[Test]
    public function it_can_update_an_article()
    {
        $article = Article::factory()->create([
            'title' => 'Old Artikel',
            'slug' => 'old-artikel',
            'user_id' => $this->user->id,
        ]);

        Notification::fake();
        Event::fake();

        $response = $this->actingAs($this->user)->putJson(route('articles.update', $article), [
            'title' => 'Updated Artikel',
            'slug' => 'updated-artikel',
            'content' => 'Konten baru.',
            'status' => 'published',
            '_token' => csrf_token(),
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'title' => 'Updated Artikel',
            'slug' => 'updated-artikel',
            'status' => 'published',
        ]);

        Notification::assertSentTo($this->user, ArticlePublishedNotification::class);
        Event::assertDispatched(\App\Events\ArticlePublished::class);
    }

    #[Test]
    public function it_can_delete_an_article()
    {
        $article = Article::factory()->create([
            'title' => 'Test Artikel',
            'slug' => 'test-artikel',
            'user_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->user)->deleteJson(route('articles.destroy', $article), [
            '_token' => csrf_token(),
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('articles', [
            'id' => $article->id,
        ]);
    }

    #[Test]
    public function it_validates_article_creation()
    {
        $response = $this->actingAs($this->user)->postJson(route('articles.store'), [
            'title' => '',
            'slug' => '',
            'content' => '',
            'status' => 'invalid',
            '_token' => csrf_token(),
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title', 'slug', 'content', 'status']);
    }
}