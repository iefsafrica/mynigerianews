<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmojiRequest;
use App\Models\Emoji;
use Illuminate\View\View;

class EmojiController extends AppBaseController
{
    public function index(): View
    {
        return view('emojis.index');
    }

    public function store(StoreEmojiRequest $request)
    {
        $input = $request->all();
        Emoji::create($input);

        return $this->sendSuccess(__('messages.placeholder.emoji_created_successfully'));
    }

    public function destroy(Emoji $emoji): mixed
    {
        $activeEmoji = Emoji::whereStatus(Emoji::ACTIVE);

        if ($emoji->status == Emoji::ACTIVE && $activeEmoji->count() <= 4) {
            return $this->sendError(__('messages.placeholder.you_delete_than_emoji'));
        }

        $emoji->delete();

        return $this->sendSuccess(__('messages.placeholder.emoji_deleted_successfully'));
    }

    public function changeEmojiStatus($id)
    {
        $emoji = Emoji::findOrFail($id);
        $activeEmoji = Emoji::whereStatus(Emoji::ACTIVE);

        if ($emoji->status == Emoji::ACTIVE && $activeEmoji->count() <= 4) {
            return $this->sendError(__('messages.placeholder.You_disable_less_than_emoji'));
        }
        if ($emoji->status == Emoji::DISABLE && $activeEmoji->count() >= 7) {
            return $this->sendError(__('messages.placeholder.You_active_more_than_emoji'));
        }
        $updateStatus = ! $emoji->status;
        $emoji->update(['status' => $updateStatus]);

        return $this->sendSuccess(__('messages.placeholder.emoji_status_updated_successfully'));
    }
}
