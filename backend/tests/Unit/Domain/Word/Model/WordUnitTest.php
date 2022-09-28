<?php

namespace App\Tests\Unit\Domain\Word\Model;

use App\Domain\Email\Exception\EmailFormatException;
use App\Domain\Email\Model\Email;
use App\Domain\Word\Exception\NegativeScoreException;
use App\Domain\Word\Exception\WordFormatException;
use App\Domain\Word\Model\Points;
use App\Domain\Word\Model\Word;
use PHPUnit\Framework\TestCase;

class WordControllerUnitTest extends TestCase
{
    public function testConstructorThrowsWordFormatExceptionIfWhitespaceOnly(): void
    {
        $this->expectException(WordFormatException::class);
        $this->word = new Word(" ");
    }

    public function testConstructorThrowsWordFormatExceptionIfTextWithWhitespace(): void
    {
        $this->expectException(WordFormatException::class);
        $this->word = new Word("mo m ");
    }

    public function testConstructorThrowsWordFormatExceptionIfParamTypeInt(): void
    {
        $this->expectException(WordFormatException::class);
        $this->word = new Word(1);
    }

    public function testConstructorThrowsWordFormatExceptionIfParamTypeBool(): void
    {
        $this->expectException(WordFormatException::class);
        $this->word = new Word(true);
    }

    public function testConstructorThrowsWordFormatExceptionIfTextWithNumbersOnly(): void
    {
        $this->expectException(WordFormatException::class);
        $this->word = new Word("123");
    }

    public function testConstructorThrowsWordFormatExceptionIfTextWithNumbers(): void
    {
        $this->expectException(WordFormatException::class);
        $this->word = new Word("mom2");
    }

    public function testConstructorThrowsWordFormatExceptionIfTextWithSpecialCharacter(): void
    {
        $this->expectException(WordFormatException::class);
        $this->word = new Word("mom!");
    }

    public function testConstructorThrowsWordFormatExceptionIfTextWithSpecialCharacters(): void
    {
        $this->expectException(WordFormatException::class);
        $this->word = new Word("%D$");
    }

    public function testConstructorThrowsNegativeScoreExceptionIfScoreIsZeroValue(): void
    {
        $this->expectException(NegativeScoreException::class);
        $this->points = new Points(0);
    }

    public function testConstructorThrowsNegativeScoreExceptionIfScoreIsNegativeValue(): void
    {
        $this->expectException(NegativeScoreException::class);
        $this->points = new Points(-2);
    }

    public function testIsPalindromeReturnTrueIfTextWithOneLetter(): void
    {
        $word = new Word("d");
        $this->assertEquals(true, $word->isPalindrome());
    }

    public function testIsPalindromeReturnTrueIfTextWithTwoSameLetters(): void
    {
        $word = new Word("dd");
        $this->assertEquals(true, $word->isPalindrome());
    }

    public function testIsPalindromeReturnTrueIfTextWithThreeSameLetters(): void
    {
        $word = new Word("sss");
        $this->assertEquals(true, $word->isPalindrome());
    }

    public function testIsPalindromeReturnTrueIfTextWithLowercaseLettersOnly(): void
    {
        $word = new Word("level");
        $this->assertEquals(true, $word->isPalindrome());
    }

    public function testIsPalindromeReturnTrueIfTextWithUppercaseLetters(): void
    {
        $word = new Word("deiFieD");
        $this->assertEquals(true, $word->isPalindrome());
    }

    public function testIsPalindromeReturnFalseIfTextWithLowercaseLettersOnly(): void
    {
        $word = new Word("computer");
        $this->assertEquals(false, $word->isPalindrome());
    }

    public function testIsAlmostPalindromeReturnTrueIfTextWithUppercaseLetters(): void
    {
        $word = new Word("levKel");
        $this->assertEquals(true, $word->isAlmostPalindrome());
    }

    public function testIsAlmostPalindromeReturnFalseIfTextWithLowercaseLettersOnly(): void
    {
        $word = new Word("miss");
        $this->assertEquals(false, $word->isAlmostPalindrome());
    }

    public function testIsAlmostPalindromeReturnFalseIfTextWithRandomLetters(): void
    {
        $word = new Word("abcbcba");
        $this->assertEquals(false, $word->isAlmostPalindrome());
    }

    public function testUniqueLettersCountReturn6IfTextWithLowercaseLettersOnly(): void
    {
        $word = new Word("devione");
        $this->assertEquals(6, $word->uniqueLettersCount());
    }

    public function testUniqueLettersCountReturn6IfTextWithUppercaseLetters(): void
    {
        $word = new Word("DeVionE");
        $this->assertEquals(6, $word->uniqueLettersCount());
    }

    public function testUniqueLettersCountReturn1IfTextWithMultipleSameLetters(): void
    {
        $word = new Word("ddd");
        $this->assertEquals(1, $word->uniqueLettersCount());
    }

    public function testUniqueLettersCountReturn1IfTextWithMultipleSameLowerAndUppercaseLetters(): void
    {
        $word = new Word("ddDDd");
        $this->assertEquals(1, $word->uniqueLettersCount());
    }

    public function testisEqualReturnTrueIfTextWithUppercaseLettersOnly(): void
    {
        $word = new Word("LEVEL");
        $this->assertEquals(true, $word->isEqual($word));
    }

    public function testisEqualReturnTrueIfTextWithUppercaseLetters(): void
    {
        $word = new Word("WorD");
        $this->assertEquals(true, $word->isEqual($word));
    }

    public function testConstructorThrowsEmailFormatExceptionIfUnrecognizedUserEmail(): void
    {
        $this->expectException(EmailFormatException::class);
        $this->email = new Email("dragan@unscom");
    }

    public function testConstructorThrowsEmailFormatExceptionIfInvalidUserEmail(): void
    {
        $this->expectException(EmailFormatException::class);
        $this->email = new Email("draganuns.com");
    }

    /**
     * @var Word $word
     */
    private Word $word;

    /**
     * @var Points $points
     */
    private Points $points;

    /**
     * @var Email $email
     */
    private Email $email;
}
