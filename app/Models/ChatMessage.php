<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    /**
     * Peran staf yang boleh membaca/membalas semua thread
     * (1=Admin, 3=Verifikator, 4=Operator).
     */
    public const STAFF_ROLES = [1, 3, 4];

    protected $table = 'chat_messages';

    protected $fillable = [
        'conversation_user_id',
        'sender_id',
        'content',
        'image_path',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function conversationUser()
    {
        return $this->belongsTo(User::class, 'conversation_user_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Semua pesan dalam satu thread, terlama ke terbaru.
     */
    public function scopeForConversation($query, int $userId)
    {
        return $query->where('conversation_user_id', $userId)->orderBy('id');
    }

    /**
     * Pesan yang dikirim oleh client (pemilik thread).
     */
    public function scopeFromClient($query)
    {
        return $query->whereColumn('sender_id', 'conversation_user_id');
    }

    /**
     * Pesan yang dikirim oleh staf.
     */
    public function scopeFromStaff($query)
    {
        return $query->whereColumn('sender_id', '!=', 'conversation_user_id');
    }

    /**
     * URL gambar yang bisa dipakai langsung di browser.
     * Route hanya menerima satu segmen, jadi kirim nama file saja.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image_path) {
            return null;
        }

        return route('chat.image', ['path' => basename($this->image_path)]);
    }

    /**
     * Bentuk JSON yang dikonsumsi view chat.
     */
    public function toChatArray(int $viewerId): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'imageUrl' => $this->image_url,
            'createdAt' => $this->created_at?->toISOString(),
            'isRead' => $this->read_at !== null,
            'sender' => [
                'id' => $this->sender_id,
                'name' => $this->sender?->name,
            ],
            // "me" berarti pesan milik yang sedang melihat
            'mine' => $this->sender_id === $viewerId,
        ];
    }
}
