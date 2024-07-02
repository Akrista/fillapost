<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Models\ServiceAccount;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Http;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        if ($data['scheduled_at'] === null) {
            $data['status'] = 'draft';
        } else {
            $data['status'] = 'scheduled';
        }

        $serviceAccount = ServiceAccount::find($data['service_account_id']);
        $socialMediaService = $serviceAccount->socialMediaService;

        if ($socialMediaService->socialMediaType->name === 'linkedin') {
            $response = Http::withToken($socialMediaService->token)
                ->post('https://api.linkedin.com/v2/ugcPosts', [
                    'author' => 'urn:li:person:' . $serviceAccount->internal_id,
                    'lifecycleState' => 'PUBLISHED',
                    'specificContent' => [
                        'com.linkedin.ugc.ShareContent' => [
                            'shareCommentary' => [
                                'text' => $data['content'],
                            ],
                            'shareMediaCategory' => 'NONE',
                        ],
                    ],
                    'visibility' => [
                        'com.linkedin.ugc.MemberNetworkVisibility' => 'PUBLIC',
                    ],
                ])->json();
            $data['internal_id'] = $response['id'];
        }

        return $data;
    }
}
