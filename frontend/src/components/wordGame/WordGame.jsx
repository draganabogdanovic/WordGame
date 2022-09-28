import React from 'react';
import { useDispatch } from 'react-redux';
import { useNavigate } from 'react-router-dom';
import { WordGameForm } from '../../containers/WordGameForm';
import { WordGameList } from '../../containers/WordGameList';
import { Button } from '../form/Button';
import { logout } from '../../redux/email/actions';
import './WordGame.scss';

function WordGame() {
  const dispatch = useDispatch();
  const navigate = useNavigate();

  const handleClick = async () => {
    await dispatch(logout());
    navigate('/');
  };
  return (
    <>
      <WordGameForm />
      <WordGameList />
      <Button
        className="button-logout"
        text="Log out"
        onClick={handleClick}
      />
    </>
  );
}

export { WordGame };
