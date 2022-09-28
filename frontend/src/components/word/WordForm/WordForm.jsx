import React, { useState } from 'react';
import PropTypes from 'prop-types';
import { Input } from '../../form/Input';
import { Button } from '../../form/Button';
import './WordForm.scss';

function WordForm({ onWordAdd }) {
  const [word, setWord] = useState('');
  const [error, setError] = useState('');
  const [disabled, setDisabled] = useState(false);

  const handleChange = (event) => {
    setWord(event.target.value);
  };

  const handleSubmit = (event) => {
    event.preventDefault();
    setDisabled(true);
    setError('');
    onWordAdd(word)
      .then(() => {
        setWord('');
        setDisabled(false);
      })
      .catch((e) => {
        setError(e.message);
        setDisabled(false);
      });
  };

  return (
    <form className="word-form" onSubmit={handleSubmit}>
      <Input
        label="Enter word"
        name="word"
        type="text"
        value={word}
        disabled={disabled}
        onChange={handleChange}
      />
      <Button
        text="Submit"
        disabled={disabled}
      />
      <div className="word-form__error">{error}</div>
    </form>
  );
}

export { WordForm };

WordForm.propTypes = {
  onWordAdd: PropTypes.func.isRequired,
};
