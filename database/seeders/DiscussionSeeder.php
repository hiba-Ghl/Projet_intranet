<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Discussion;
use App\Models\Message;
use App\Models\Forum;
use App\Models\Utilisateur;

class DiscussionSeeder extends Seeder
{
    public function run()
    {
        // Create a test user if not exists
        $user = Utilisateur::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'nom' => 'Test User',
                'mot_de_passe' => bcrypt('password'),
                'role' => 'user',
                'date_inscription' => now(),
            ]
        );

        // Create a test forum if not exists
        $forum = Forum::firstOrCreate(
            ['nom' => 'Test Forum'],
            [
                'description' => 'A test forum for testing',
                'adminModerateur' => $user->IDUtilisateur,
            ]
        );

        // Create some test discussions
        $discussions = [
            [
                'titre' => 'Welcome Discussion',
                'description' => 'A welcome discussion for new members',
                'IDforum' => $forum->IDforum,
                'date_creation' => now(),
            ],
            [
                'titre' => 'General Chat',
                'description' => 'A general discussion thread',
                'IDforum' => $forum->IDforum,
                'date_creation' => now(),
            ],
        ];

        foreach ($discussions as $discussionData) {
            $discussion = Discussion::create($discussionData);

            // Create some test messages for each discussion
            $messages = [
                [
                    'contenu' => 'Welcome to the discussion!',
                    'auteur' => $user->IDUtilisateur,
                    'IDdiscussion' => $discussion->IDdiscussion,
                    'date_envoi' => now(),
                ],
                [
                    'contenu' => 'This is a test message.',
                    'auteur' => $user->IDUtilisateur,
                    'IDdiscussion' => $discussion->IDdiscussion,
                    'date_envoi' => now(),
                ],
                [
                    'contenu' => 'Another test message here.',
                    'auteur' => $user->IDUtilisateur,
                    'IDdiscussion' => $discussion->IDdiscussion,
                    'date_envoi' => now(),
                ],
            ];

            foreach ($messages as $messageData) {
                Message::create($messageData);
            }
        }
    }
} 