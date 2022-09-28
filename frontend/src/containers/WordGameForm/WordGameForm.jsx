import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { WordForm } from '../../components/word/WordForm';
import { addNewWord } from '../../redux/word/actions';

function WordGameForm() {
  const wordList = useSelector(({ wordList: stateWordList }) => stateWordList);
  const dispatch = useDispatch();

  const handleWordAdd = async (word) => {
    const existingWord = wordList.some((wordObject) => wordObject.word.word === word);
    if (existingWord) {
      await Promise.reject(new Error('Error! Word already exists.'));
    }

    await dispatch(addNewWord(word));
  };

  return (
    <WordForm onWordAdd={handleWordAdd} />
  );
}

export { WordGameForm };
