<?php

namespace Database\Seeders;

use App\Models\Poll;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'is_admin' => false,
            'is_pathfinder' => false,
            'password' => 'password',
        ]);

        User::factory()->create([
            'name' => 'Pathfinder',
            'email' => 'pathfinder@example.com',
            'is_admin' => false,
            'is_pathfinder' => true,
            'password' => 'password',
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'is_admin' => true,
            'is_pathfinder' => false,
            'password' => 'password',
        ]);

        Poll::create([
            'quote' => "Les procurations pour les législatives ont quadruplé par rapport à 2022 » (juin 2024)",
            'author' => "Emmanuel Macron",
            'source' => "le journal du dimanche",
            'date' => date('Y-m-d'),
            'context' => "Lors de l’annonce de la dissolution de l’Assemblée nationale, Emmanuel Macron a avancé que le nombre de procurations avait quadruplé par rapport aux élections législatives précédentes.",
            'analysis' => "En réalité, cette augmentation ne concerne qu’une période très spécifique et n’est pas représentative de l’ensemble des votes par procuration. L’information a été clarifiée par le ministère de l’Intérieur et critiquée pour son manque de nuance",
            'title' => "Procuration législative",
            'slug' => "procuration-legislative",
            'published_at' => date('Y-m-d'),
        ]);

        //            // Poll 2: "Should the government raise the minimum wage?"
        Poll::create([
            'quote' => "Paris est aujourd’hui l’une des villes les plus accessibles au monde pour les personnes en situation de handicap",
            'author' => "Anne Hidalgo",
            'source' => "le journal du dimanche",
            'context' => "Lors d’une conférence à l’Hôtel de Ville, la maire de Paris a salué les progrès de la ville en matière d’accessibilité. Ces propos sont appuyés par des rapports d’organisations internationales qui placent Paris parmi les leaders mondiaux pour l’accessibilité des espaces publics.",
            'analysis' => "Une étude réalisée auprès de 3 500 personnes en situation de handicap révèle que dix grandes villes, dont Paris, ont été exclues du classement des destinations touristiques les plus accessibles. Parmi ces villes figurent également Amsterdam, Las Vegas et Londres. Cette situation met en lumière les récentes initiatives du gouvernement français, notamment le 'Plan 100% accessibilité', visant à faire de Paris une ville plus inclusive pour tous.
        Cependant, malgré ces efforts, des voix critiques, en particulier celles des associations de défense des droits des personnes handicapées, insistent sur la nécessité de poursuivre ces actions au-delà de 2024. Elles soulignent que de nombreuses lacunes demeurent, notamment dans l’accessibilité du métro et des bus. Ce constat est largement discuté dans les débats politiques actuels, où des partis comme La France Insoumise (LFI) appellent à une prise en compte renforcée de l’accessibilité dans les politiques publiques.",
            'title' => "Paris accéssibilité",
            'slug' => "paris-accessibilite",
            'published_at' => date('Y-m-d'),
        ]);

        // Poll 3: "Do you believe in the need for climate change policies?"
        Poll::create([
            'quote' => "La nouvelle loi immigration interdit désormais aux étrangers d’accéder aux prestations sociales.",
            'author' => "Environmental Leader C",
            'source' => "le journal du dimanche",
            'context' => "With increasing natural disasters and environmental destruction, the urgency to implement climate change policies has become a priority for governments worldwide.",
            'analysis' => "While climate change policies are widely supported by environmentalists, some argue that the economic cost of implementing these policies could be too high.",
            'title' => "Climate Change Policies",
            'slug' => "climate-change-policies-3",
            'published_at' => date('Y-m-d'),
        ]);

        // Poll 4: "Is universal healthcare a fundamental right?"
        Poll::create([
            'quote' => "Healthcare should be accessible to all, regardless of income or status.",
            'author' => "Health Advocate D",
            'source' => "le journal du dimanche",
            'context' => "The debate about universal healthcare continues to spark polarized views. Some advocate for healthcare being a basic right, while others argue about its feasibility.",
            'analysis' => "Supporters argue that universal healthcare ensures equity in access to services, while critics raise concerns about funding and potential inefficiency.",
            'title' => "Universal Healthcare",
            'slug' => "universal-healthcare-3",
            'published_at' => date('Y-m-d'),
        ]);

        // Poll 5: "Should governments prioritize spending on defense over education?"
        Poll::create([
            'quote' => "A strong defense ensures the safety and sovereignty of a nation, but investing in education will secure a prosperous future.",
            'author' => "Politician E",
            'source' => "le journal du dimanche",
            'context' => "This debate revolves around whether governments should allocate more funds to military defense or prioritize investments in education, which can shape a nation's long-term success.",
            'analysis' => "The challenge is balancing immediate national security concerns with long-term investments in human capital.",
            'title' => "Defense vs. Education Spending",
            'slug' => "defense-vs-education-spending-3",
            'published_at' => date('Y-m-d'),
        ]);
    }
}
