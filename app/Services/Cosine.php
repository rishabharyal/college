<?php

namespace App\Services;

class Cosine {

	// Stop words does not add meanings.. so we can replace them
	private $stopWords = [
		'is', 'am', 'are'
	];
	private $specialChars = [
		'?', '!', '.', '-', '_'
	];
	public function calculate($mainString, $compareString) {
		$wordsWithCount = $this->getWordCountByString($mainString); 
		$secondStringWithCount = $this->getWordCountByString($compareString);
		$secondStringForVectorProduct = $secondStringWithCount;

		$allWordsWithCountsForBothStrings = [];

		foreach ($wordsWithCount as $word => $count) {
			$tuple = [];
			$tuple[0] = $count;
			$tuple[1] = 0;
			if (isset($secondStringWithCount[$word])) {
				$tuple[1] = $secondStringWithCount[$word];
				unset($secondStringWithCount[$word]);
			}
			$allWordsWithCountsForBothStrings[] = $tuple;
		}

		foreach ($secondStringWithCount as $word => $count) {
			$tuple[0] = 0;
			$tuple[1] = $count;
			$allWordsWithCountsForBothStrings[] = $tuple;
		}

		$vectorProduct = $this->calculateVectorProduct($allWordsWithCountsForBothStrings); // this is x.y
		$scalerProductForFirstString = $this->calculateScalerProduct($wordsWithCount); // this is x
		$scalerProductForSecondString = $this->calculateScalerProduct($secondStringForVectorProduct); // this is y

		$cosineSimilarity = $vectorProduct / (($scalerProductForFirstString*$scalerProductForFirstString) + ($scalerProductForSecondString*$scalerProductForSecondString) - ($scalerProductForFirstString*$scalerProductForSecondString));  // sim(x,y) = x.y/x.x+y.y-x.y

		return $cosineSimilarity;

	}

	private function calculateScalerProduct($data) {
		$productSum = 0;
		foreach ($data as $key => $number) {
			$productSum += ($number*$number);
		}

		return sqrt($productSum);
	}

	private function calculateVectorProduct($allWordsWithCountsForBothStrings) {
		$vectorProductSum = 0;
		foreach ($allWordsWithCountsForBothStrings as $key => $set) {
			$vectorProductSum += ($set[0] * $set[1]);
		}

		return $vectorProductSum;
	}

	private function getWordCountByString($string) {
		$string = $this->filterText($string);
		$words = explode(' ', $string);
		$wordCount = [];
		foreach ($words as $key => $word) {
			if (isset($wordCount[$word])) {
				$wordCount[$word]++;
			} else {
				$wordCount[$word] = 1;
			}
		}

		return $wordCount;
	}

	private function filterText($text) {
		$text = str_replace($this->stopWords, '', $text);
		$text = str_replace($this->specialChars, '', $text);

		return $text;
	}
}