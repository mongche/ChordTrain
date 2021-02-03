<?php

namespace Chord;

class Chordify
{
    /**
     * The music songs of the label.
     *
     * @var array
     */
    private $label_songs = [];

    /**
     * The chords of the label.
     *
     * @var array
     */
    private $label_chords = [];

    /**
     * The song of label probabilities.
     *
     * @var array
     */
    public $song_probabilities = [];

    /**
     * The label chord probabilities.
     *
     * @var array
     */
    public $chord_probabilities = [];

    /**
     * Feed a new song to the classifier.
     *
     * @param Song $song
     *
     * @return void
     */
    public function feed(Song $song)
    {
        $this->label_songs[$song->label] = ($this->label_songs[$song->label] ?? 0) + 1;
        $this->label_chords[$song->label] = [...$this->label_chords[$song->label] ?? [], ...$song->chords];
    }

    /**
     * Evaluate the songs and chords probabilities.
     *
     * @return void
     */
    public function evaluate()
    {
        $this->evaluateSongProbabilities();
        $this->evaluateChordProbabilities();
    }

    /**
     * Evaluate the song probabilities.
     *
     * @return void
     */
    private function evaluateSongProbabilities()
    {
        $all_songs = $this->allSongs();

        foreach ($this->label_songs as $label => $songs) {
            $this->song_probabilities[$label] = $songs / $all_songs;
        }
    }

    /**
     * Evaluate the chord probabilities.
     *
     * @return void
     */
    private function evaluateChordProbabilities()
    {
        $all_songs = $this->allSongs();

        foreach ($this->label_chords as $label => $chords) {
            $this->chord_probabilities[$label] = array_map(function ($frequency) use ($all_songs) {
                return ($frequency * 1.0) / $all_songs;
            }, array_count_values($chords));
        }
    }

    /**
     * Get the number of songs.
     *
     * @return int
     */
    public function allSongs(): int
    {
        return array_sum($this->label_songs);
    }

    /**
     * Get the song probabilities.
     *
     * @return array
     */
    public function getSongProbabilities()
    {
        return $this->song_probabilities;
    }

    /**
     * Classify the music audio by the chords.
     *
     * @param array $chords
     *
     * @return array
     */
    public function classify(array $chords): array
    {
        $classified = [];

        foreach ($this->song_probabilities as $label => $song_probability) {
            $song_probability += 1.01;

            foreach ($chords as $chord) {
                if (isset($this->chord_probabilities[$label][$chord])) {
                    $song_probability *= ($this->chord_probabilities[$label][$chord] + 1.01);
                }
            }

            $classified[$label] = $song_probability;
        }

        return $classified;
    }
}
