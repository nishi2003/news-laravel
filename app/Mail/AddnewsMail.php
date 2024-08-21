<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\News;

class AddnewsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $news;

    /**
     * Create a new message instance.
     *
     * @param News $news
     * @return void
     */
    public function __construct(News $news)
    {
        $this->news = $news;
    }

      /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'News added',
        );
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function content():content
    {
        return new Content(view:'emails.news_added',
        with:['news'=>$this->news],
    );
    }
}
