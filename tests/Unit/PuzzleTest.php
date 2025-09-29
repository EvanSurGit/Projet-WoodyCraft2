<?php

namespace Tests\Unit;

use App\Models\Puzzle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class PuzzleTest extends TestCase
{
    use RefreshDatabase;

    public function test_puzzle_can_be_created()
    {
        $puzzle = Puzzle::factory()->create([
            'nom' => 'Test Puzzle',
            'categorie' => 'Test Categorie',
            'description' => 'Ceci est un puzzle de test.',
            'prix' => 9.99,
            'note' => 4.5,
            'image' => 'test_image.png', // Ajouter le champ image
        ]);

        $this->assertDatabaseHas('puzzles', [
            'nom' => 'Test Puzzle',
        ]);
    }

    public function test_puzzle_creation_fails_with_missing_data()
    {
        $this->expectException(ValidationException::class);

        $puzzleData = [
            'nom' => '',
            'categorie' => '',
            'description' => '',
            'prix' => '',
            'note' => '',
            'image' => '', // Ajouter le champ image
        ];

        // Valider les données manuellement
        $validator = Validator::make($puzzleData, [
            'nom' => 'required',
            'categorie' => 'required',
            'description' => 'required',
            'prix' => 'required|numeric',
            'note' => 'required|numeric',
            'image' => 'required',
        ]);

        $validator->validate();

        Puzzle::create($puzzleData);
    }

    public function test_puzzle_creation_fails_with_invalid_data()
    {
        $this->expectException(ValidationException::class);

        $puzzleData = [
            'nom' => str_repeat('A', 256), // Nom trop long
            'categorie' => 'Test Categorie',
            'description' => 'Ceci est un puzzle de test.',
            'prix' => -5.99, // Prix négatif
            'note' => 4.5,
            'image' => 'test_image.png', // Ajouter le champ image
        ];

        // Valider les données manuellement
        $validator = Validator::make($puzzleData, [
            'nom' => 'required|max:255',
            'categorie' => 'required',
            'description' => 'required',
            'prix' => 'required|numeric|min:0',
            'note' => 'required|numeric|min:0',
            'image' => 'required',
        ]);

        $validator->validate();

        Puzzle::create($puzzleData);
    }

    public function test_puzzle_creation_fails_with_duplicate_data()
    {
        $puzzleData = [
            'nom' => 'Unique Puzzle',
            'categorie' => 'Test Categorie',
            'description' => 'Ceci est un puzzle de test.',
            'prix' => 9.99,
            'note' =>4.5,
            'image' => 'test_image.png', // Ajouter le champ image
        ];

        Puzzle::create($puzzleData);

        $this->expectException(ValidationException::class);

        // Valider les données manuellement avec la règle d’unicité
        $validator = Validator::make($puzzleData, [
            'nom' => 'required|unique:puzzles,nom',
            'categorie' => 'required',
            'description' => 'required',
            'prix' => 'required|numeric|min:0',
            'note' => 'required|numeric|min:0',
            'image' => 'required',
        ]);

        

        $validator->validate();

        Puzzle::create($puzzleData); // Création avec le même nom unique
    }



public function test_puzzle_can_be_read()
{
    $puzzle = Puzzle::factory()->create([
        'nom'        => 'Test Puzzle',
        'categorie'  => 'Test Categorie',
        'description'=> 'Ceci est un puzzle de test.',
        'prix'       => 9.99,
        'note'       => 4.5,   
    ]);

    $foundPuzzle = Puzzle::find($puzzle->id);

    $this->assertNotNull($foundPuzzle);
    $this->assertEquals($puzzle->nom, $foundPuzzle->nom);
}

public function test_puzzle_can_be_updated()
{
    $puzzle = Puzzle::factory()->create();

    $puzzle->nom = 'Nom mis à jour';
    $puzzle->save();

    $this->assertEquals('Nom mis à jour', $puzzle->fresh()->nom);
}

public function test_puzzle_can_be_deleted()
{
    $puzzle = Puzzle::factory()->create();

    $puzzle->delete();

    $this->assertModelMissing($puzzle);
}


}
