<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WordController extends Controller
{


    function splitRussianWordIntoSyllables(string $word): array
    {
        $word = mb_strtolower($word, 'UTF-8');

        // Русские гласные
        $vowels = ['а','е','ё','и','о','у','ы','э','ю','я'];

        $letters = preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);

        $syllables = [];
        $currentSyllable = '';

        foreach ($letters as $letter) {
            $currentSyllable .= $letter;

            if (in_array($letter, $vowels)) {
                // Если текущая буква — гласная, заканчиваем слог
                $syllables[] = $currentSyllable;
                $currentSyllable = '';
            }
        }

        // Если остались буквы после последней гласной, добавляем их к последнему слогу
        if ($currentSyllable !== '') {
            if (count($syllables) > 0) {
                $syllables[count($syllables) - 1] .= $currentSyllable;
            } else {
                $syllables[] = $currentSyllable;
            }
        }

        return $syllables;
    }

    function generateBukvas(): array
    {
        $v = ['а','е',
//            'ё',
            'и','о','у'
//            ,'ы','э','ю','я'
        ];
        $c = ['б','в','г','д','ж','з',
//            'й',
            'к','л','м','н','п','р','с','т',
//            'ф','х','ц','ч','ш',
//            'щ'
        ];

        $e = array_merge($v, $c);



        $syllables = [];

        foreach ($c as $c1) {
            foreach ($v as $v1) {
                foreach ($c as $v2) {
                    foreach ($v as $v3) {
                        $syllables[] = $c1 . $v1 . $v2 . $v3;
                    }
                }
            }
        }

        return $syllables;
    }

    function generateSyllables(): array
    {
        $vowels = ['а','е','ё','и','о','у','ы','э','ю','я'];
        $consonants = ['б','в','г','д','ж','з','й','к','л','м','н','п','р','с','т','ф','х','ц','ч','ш','щ'];



        $syllables = [];

        foreach ($consonants as $c) {
            foreach ($vowels as $v) {
                $syllables[] = $c . $v;
            }
        }

        return $syllables;
    }

    function generateTwoSyllableWords(): array
    {
        $syllables = $this->generateSyllables();
        $words = [];

        foreach ($syllables as $first) {
            foreach ($syllables as $second) {
                $words[] = $first . $second;
            }
        }

        return $words;
    }


////        $words = $this->generateTwoSyllableWords();
//        $words = $this->generateBukvas();
//        echo "Всего слов: " . count($words) . PHP_EOL;
////        print_r(array_slice($words, 0, 20));
//
//        foreach ($words as $word) {
//            echo $word . '.рф<br/>';
//        }
//
////// Пример использования:
////        $word = 'программирование';
////        $syllables = $this->splitRussianWordIntoSyllables($word);
////        print_r($syllables);
//
//        dd('111');
}
