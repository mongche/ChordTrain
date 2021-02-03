<?php

namespace Chord\Tests;

use Chord\Chordify;
use Chord\Constants\ChordLabel;
use Chord\Constants\SongChords;
use Chord\Song;
use PHPUnit\Framework\TestCase;

class ChordifyTest extends TestCase
{
    /**
     * @dataProvider musicChordDataProvider
     *
     * @param mixed $songs
     * @param mixed $chords
     * @param mixed $expected
     */
    public function testChoridfy($songs, $chords, $expected)
    {
        $choridfy = new Chordify();

        foreach ($songs as $song) {
            $choridfy->feed(new Song($song[0], $song[1]));
        }

        $choridfy->evaluate();

        $this->assertEquals($expected, $choridfy->classify($chords));
    }

    public function musicChordDataProvider()
    {
        return [
            [
                [
                    [ChordLabel::EAZY, SongChords::IMAGINE],
                    [ChordLabel::EAZY, SongChords::SOMEWHERE_OVER_THE_RAINBOW],
                    [ChordLabel::EAZY, SongChords::TOO_MANY_COOKS],
                    [ChordLabel::MEDIUM, SongChords::I_WILL_FOLLOW_YOU_INTO_THE_DARK],
                    [ChordLabel::MEDIUM, SongChords::BABY_ONE_MORE_TIME],
                    [ChordLabel::MEDIUM, SongChords::CREEP],
                    [ChordLabel::HARD, SongChords::PAPER_BAG],
                    [ChordLabel::HARD, SongChords::TOXIC],
                    [ChordLabel::HARD, SongChords::BULLET_PROOF],
                ],
                ['d', 'g', 'e', 'dm'],
                [
                    'eazy' => 2.0230948271605,
                    'medium' => 1.8557586131687,
                    'hard' => 1.8557586131687,
                ]
            ],
            [
                [
                    [ChordLabel::EAZY, SongChords::IMAGINE],
                    [ChordLabel::EAZY, SongChords::SOMEWHERE_OVER_THE_RAINBOW],
                    [ChordLabel::EAZY, SongChords::TOO_MANY_COOKS],
                    [ChordLabel::MEDIUM, SongChords::I_WILL_FOLLOW_YOU_INTO_THE_DARK],
                    [ChordLabel::MEDIUM, SongChords::BABY_ONE_MORE_TIME],
                    [ChordLabel::MEDIUM, SongChords::CREEP],
                    [ChordLabel::HARD, SongChords::PAPER_BAG],
                    [ChordLabel::HARD, SongChords::TOXIC],
                    [ChordLabel::HARD, SongChords::BULLET_PROOF],
                ],
                ['f#m7', 'a', 'dadd9', 'dmaj7', 'bm', 'bm7', 'd', 'f#m'],
                [
                    'eazy' => 1.3433333333333,
                    'medium' => 1.5060259259259,
                    'hard' => 1.688422399177,
                ]
            ]
        ];
    }
}
