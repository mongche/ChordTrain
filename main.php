<?php

require_once __DIR__ . '/vendor/autoload.php';

use Chord\Chordify;
use Chord\Song;
use Chord\Constants\ChordLabel;
use Chord\Constants\SongChords;

$choridfy = new Chordify();
$choridfy->feed(new Song(ChordLabel::EAZY, SongChords::IMAGINE));
$choridfy->feed(new Song(ChordLabel::EAZY, SongChords::SOMEWHERE_OVER_THE_RAINBOW));
$choridfy->feed(new Song(ChordLabel::EAZY, SongChords::TOO_MANY_COOKS));
$choridfy->feed(new Song(ChordLabel::MEDIUM, SongChords::I_WILL_FOLLOW_YOU_INTO_THE_DARK));
$choridfy->feed(new Song(ChordLabel::MEDIUM, SongChords::BABY_ONE_MORE_TIME));
$choridfy->feed(new Song(ChordLabel::MEDIUM, SongChords::CREEP));
$choridfy->feed(new Song(ChordLabel::HARD, SongChords::PAPER_BAG));
$choridfy->feed(new Song(ChordLabel::HARD, SongChords::TOXIC));
$choridfy->feed(new Song(ChordLabel::HARD, SongChords::BULLET_PROOF));

$choridfy->evaluate();

print_r($choridfy->getSongProbabilities());
print_r($choridfy->classify(['d', 'g', 'e', 'dm']));
print_r($choridfy->getSongProbabilities());
print_r($choridfy->classify(['f#m7', 'a', 'dadd9', 'dmaj7', 'bm', 'bm7', 'd', 'f#m']));
