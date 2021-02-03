<?php

namespace Chord;

class Song
{
    /**
     * The song label.
     *
     * @var string
     */
    public $label;

    /**
     * The song chords.
     *
     * @var array
     */
    public $chords = [];

    /**
     * Create a new song data object.
     *
     * @param string $label
     * @param array  $chords
     *
     * @return void
     */
    public function __construct(string $label, array $chords)
    {
        $this->label = $label;
        $this->chords = $chords;
    }
}
