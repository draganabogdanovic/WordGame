import React, { useState } from 'react';
import PropTypes from 'prop-types';
import { Input } from '../../form/Input';
import { Button } from '../../form/Button';
import './EmailForm.scss';

function EmailForm({ onEmailAdd }) {
  const [email, setEmail] = useState('');
  const [error, setError] = useState('');
  const [disabled, setDisabled] = useState(false);

  const handleChange = (event) => {
    setEmail(event.target.value);
  };

  const handleEmailSubmit = (event) => {
    event.preventDefault();
    setDisabled(true);
    setError('');
    onEmailAdd(email)
      .then(() => {
        setError('');
        setDisabled(false);
      })
      .catch((e) => {
        setError(e.message);
        setDisabled(false);
      });
  };

  return (
    <form className="email-form" onSubmit={handleEmailSubmit}>
      <Input
        label="Enter email"
        name="email"
        type="text"
        value={email}
        disabled={disabled}
        onChange={handleChange}
      />
      <Button
        text="Submit"
        disabled={disabled}
      />
      <div className="email-form__error">{error}</div>

    </form>
  );
}

export { EmailForm };

EmailForm.propTypes = {
  onEmailAdd: PropTypes.func.isRequired,
};
