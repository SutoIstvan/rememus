<?php

namespace App\Services;

use App\Models\Memorial;
use OpenAI;

class BiographyGeneratorService
{
    /**
     * Generate biography and motto for a memorial using OpenAI.
     *
     * @param  Memorial  $memorial  (with family and timeline loaded)
     * @return array{biography: string, motto: string}
     */
    public function generate(Memorial $memorial): array
    {
        $client = OpenAI::client(config('services.openai.key'));
        $model  = config('services.openai.model', 'gpt-4o-mini');

        $prompt = $this->buildPrompt($memorial);

        $response = $client->chat()->create([
            'model'    => $model,
            'messages' => [
                [
                    'role'    => 'system',
                    'content' => <<<EOT
You are a compassionate memorial writer. Based on the information provided about a person,
generate two things:
1. BIOGRAPHY: A warm, respectful narrative biography (3-10 paragraphs, ~300-1000 words) that honors
   their life. Write in third person. Be specific using the provided data. Use a thoughtful,
   literary tone. Do NOT invent facts not in the data.
2. MOTTO: A short, meaningful life motto (max 20 words) that reflects their personality,
   values, or life story. It can be a quote-style sentence, a poetic line, or a short phrase.

Respond ONLY with valid JSON in this exact format:
{"biography": "...", "motto": "..."}
EOT
                ],
                [
                    'role'    => 'user',
                    'content' => $prompt,
                ],
            ],
            'response_format' => ['type' => 'json_object'],
            'temperature'     => 0.7,
        ]);

        $content = $response->choices[0]->message->content ?? '{}';
        $data    = json_decode($content, true) ?? [];

        return [
            'biography' => trim($data['biography'] ?? ''),
            'motto'     => trim($data['motto']     ?? ''),
        ];
    }

    /**
     * Build a structured text prompt from all memorial data.
     */
    private function buildPrompt(Memorial $memorial): string
    {
        $lines = [];

        // ── Basic info ──────────────────────────────────────────────
        $lines[] = "PERSON: {$memorial->name}";

        if ($memorial->birth_date) {
            $lines[] = "BORN: {$memorial->birth_date}";
        }
        if ($memorial->death_date) {
            $lines[] = "DIED: {$memorial->death_date}";
        }
        if ($memorial->birth_place) {
            $lines[] = "BIRTH PLACE: {$memorial->birth_place}";
        }

        // ── Family tree ─────────────────────────────────────────────
        if ($memorial->family && $memorial->family->isNotEmpty()) {
            $familyLines = [];
            foreach ($memorial->family as $member) {
                if ($member->role === 'main_person') {
                    continue;
                }
                $roleLabel = ucwords(str_replace('_', ' ', $member->role));
                $familyLines[] = "- {$roleLabel}: {$member->name}";
            }
            if (!empty($familyLines)) {
                $lines[] = '';
                $lines[] = 'FAMILY:';
                $lines   = array_merge($lines, $familyLines);
            }
        }

        // ── Timeline ────────────────────────────────────────────────
        if ($memorial->timeline && $memorial->timeline->isNotEmpty()) {
            $lines[] = '';
            $lines[] = 'LIFE EVENTS (TIMELINE):';
            foreach ($memorial->timeline->sortBy('date') as $event) {
                $date = $event->date ?? $event->date_from ?? $event->date_to ?? null;
                $datePart = $date ? "[{$date}] " : '';
                $line = "- {$datePart}{$event->title}";
                if ($event->description) {
                    $line .= ": {$event->description}";
                }
                if ($event->location) {
                    $line .= " (Location: {$event->location})";
                }
                if ($event->related_person) {
                    $line .= " Related person: {$event->related_person}";
                }
                $lines[] = $line;
            }
        }

        // ── Features / Character ────────────────────────────────────
        $features = [];

        if (!empty($memorial->characteristics)) {
            $chars = is_array($memorial->characteristics)
                ? implode(', ', $memorial->characteristics)
                : $memorial->characteristics;
            $features[] = "Personality traits: {$chars}";
        }

        if ($memorial->custom_traits) {
            $features[] = "Additional traits: {$memorial->custom_traits}";
        }

        if (!empty($memorial->hobbies)) {
            $hobbies = is_array($memorial->hobbies)
                ? implode(', ', $memorial->hobbies)
                : $memorial->hobbies;
            $features[] = "Hobbies & interests: {$hobbies}";
        }

        if ($memorial->additional_hobbies) {
            $features[] = "Additional hobbies: {$memorial->additional_hobbies}";
        }

        if ($memorial->retirement) {
            $features[] = "Retirement / later years: {$memorial->retirement}";
        }

        if ($memorial->habits) {
            $features[] = "Daily habits: {$memorial->habits}";
        }

        if ($memorial->stories) {
            $features[] = "Memorable stories: {$memorial->stories}";
        }

        if ($memorial->wisdom) {
            $features[] = "Words of wisdom: {$memorial->wisdom}";
        }

        if (!empty($features)) {
            $lines[] = '';
            $lines[] = 'CHARACTER & PERSONALITY:';
            foreach ($features as $f) {
                $lines[] = "- {$f}";
            }
        }

        return implode("\n", $lines);
    }
}
