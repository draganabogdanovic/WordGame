import React from 'react';
import PropTypes from 'prop-types';
import './Input.scss';

function Input({
  name,
  type,
  label,
  value,
  placeholder,
  disabled,
  onChange,
}) {
  return (
    <div className="input">
      <label className="input__label" htmlFor={name}>{label}</label>
      <input
        className="input__field"
        id={name}
        name={name}
        type={type}
        value={value}
        placeholder={placeholder}
        autoComplete="off"
        disabled={disabled}
        onChange={onChange}
      />
    </div>
  );
}

export { Input };

Input.propTypes = {
  name: PropTypes.string.isRequired,
  type: PropTypes.string,
  label: PropTypes.string.isRequired,
  value: PropTypes.string,
  placeholder: PropTypes.string,
  disabled: PropTypes.bool,
  onChange: PropTypes.func.isRequired,
};

Input.defaultProps = {
  type: 'text',
  value: '',
  disabled: false,
  placeholder: '',
};
