<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Simulación de datos para interfaz gráfica

        $featuredMods = [
            [
                'title' => 'Ultimate Skyrim Pack',
                'slug' => 'ultimate-skyrim-pack',
                'thumbnail' => 'img/mods/skyrim.jpg',
                'views' => 1240,
                'downloads' => 800,
                'likes' => 230,
                'author' => ['name' => 'ModMaster', 'username' => 'modmaster']
            ],
            [
                'title' => 'Cyberpunk Music Replacer',
                'slug' => 'cyberpunk-music-replacer',
                'thumbnail' => 'img/mods/cyberpunk.jpg',
                'views' => 980,
                'downloads' => 640,
                'likes' => 190,
                'author' => ['name' => 'SynthMan', 'username' => 'synthman']
            ]
        ];

        $trending = $featuredMods; // Reutilizados por ahora

        $recommended = [
            [
                'title' => 'HD Minecraft Textures',
                'slug' => 'hd-minecraft-textures',
                'thumbnail' => 'img/mods/minecraft.jpg',
                'author' => ['name' => 'PixelKing', 'username' => 'pixelking']
            ]
        ];

        $categories = [
            ['name' => 'Acción', 'slug' => 'accion'],
            ['name' => 'RPG', 'slug' => 'rpg'],
            ['name' => 'Música', 'slug' => 'musica'],
        ];

        $recentComments = [
            [
                'user' => [
                    'name' => 'Gamer123',
                    'username' => 'gamer123',
                    'avatar' => 'img/users/user1.png'
                ],
                'mod' => [
                    'title' => 'Ultimate Skyrim Pack',
                    'slug' => 'ultimate-skyrim-pack'
                ],
                'created_at' => now()->subMinutes(30)
            ]
        ];

        $topMods = $featuredMods;

        $news = [
            [
                'title' => 'Nuevas funciones para creadores',
                'slug' => 'nuevas-funciones-creadores',
                'author' => ['name' => 'Admin'],
                'content' => '¡Estamos lanzando nuevas herramientas para subir mods más fácil que nunca!'
            ]
        ];

        return view('home', compact(
            'featuredMods',
            'trending',
            'recommended',
            'categories',
            'recentComments',
            'topMods',
            'news'
        ));
    }
}
