import React from 'react';
import PropTypes from 'prop-types';
import './Button.scss';

function Button({
  type,
  text,
  disabled,
  className,
  onClick,
}) {
  return (
    <button
      type={type === 'submit' ? 'submit' : 'button'}
      className={className}
      disabled={disabled}
      onClick={onClick}
    >
      {text}
    </button>
  );
}

export { Button };

Button.propTypes = {
  type: PropTypes.oneOf(['submit', 'button']),
  text: PropTypes.string.isRequired,
  disabled: PropTypes.bool,
  className: PropTypes.string,
  onClick: PropTypes.func,
};

Button.defaultProps = {
  type: 'submit',
  disabled: false,
  className: 'button',
  onClick: () => {},
};
