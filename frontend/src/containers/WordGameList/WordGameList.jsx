import React from 'react';
import { useSelector } from 'react-redux';
import { WordList } from '../../components/word/WordList';

function WordGameList() {
  const wordList = useSelector(({ wordList: stateWordList }) => stateWordList);

  return (
    <WordList wordList={wordList} />
  );
}

export { WordGameList };
