import React from 'react';
import { useDispatch } from 'react-redux';
import { useNavigate } from 'react-router-dom';
import { loginWithEmail } from '../../redux/email/actions';
import { EmailForm } from '../../components/email/EmailForm';
import { loadAddedWords } from '../../redux/word/actions';

function WordGameEmail() {
  const dispatch = useDispatch();
  const navigate = useNavigate();

  const handleEmailAdd = async (email) => {
    await dispatch(loginWithEmail(email));
    navigate('/createScore');
    await dispatch(loadAddedWords());
  };

  return (
    <EmailForm onEmailAdd={handleEmailAdd} />
  );
}

export { WordGameEmail };
