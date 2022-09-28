import React from 'react';
import PropTypes from 'prop-types';
import './WordList.scss';

function WordList({ wordList }) {
  return (
    <ul className="word-list">
      {wordList && wordList.map((item) => (
        <li className="word-list__word" key={item.word}>
          <span className="word-list__word__value">{item.word}</span>
          <span className="word-list__word__score">{item.score}</span>
        </li>
      ))}
    </ul>
  );
}

export { WordList };

WordList.propTypes = {
  wordList: PropTypes.arrayOf(PropTypes.shape({
    word: PropTypes.string,
    score: PropTypes.number,
  })),
};

WordList.defaultProps = {
  wordList: [],
};
