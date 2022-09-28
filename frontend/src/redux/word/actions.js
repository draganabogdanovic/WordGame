import axios from 'axios';
import store from '../store';
import { LOAD_ADDED_WORDS, ADD_NEW_WORD } from './types';

export const loadAddedWords = (() => async (dispatch) => {
  const LOAD_WORDS_API = `${process.env.REACT_APP_SERVER_HOME}api/entry/user_words`;
  const userToken = store.getState().emailList.token;
  console.log(userToken);

  return new Promise((resolve, reject) => {
    axios({
      method: 'get',
      url: LOAD_WORDS_API,
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${userToken.token}`,
      },
    }).then((result) => {
      const wordList = result.data;
      console.log(wordList);
      dispatch({
        type: LOAD_ADDED_WORDS,
        payload: wordList,
      });
      resolve(result.data);
    }).catch((errorResponse) => {
      reject(new Error(errorResponse.response.data));
    });
  });
});

export const addNewWord = ((word) => async (dispatch) => {
  const ADD_WORD_API = `${process.env.REACT_APP_SERVER_HOME}api/entry/word`;
  const userToken = store.getState().emailList.token;

  return new Promise((resolve, reject) => {
    axios({
      method: 'post',
      url: ADD_WORD_API,
      data: { word },
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${userToken.token}`,
      },
    }).then((result) => {
      const wordScore = result.data;
      dispatch({
        type: ADD_NEW_WORD,
        payload: {
          word,
          score: wordScore,
        },
      });
      resolve(result.data);
    }).catch((errorResponse) => {
      reject(new Error(errorResponse.response.data));
    });
  });
});
