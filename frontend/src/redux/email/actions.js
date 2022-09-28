import axios from 'axios';
import { LOGIN_USER, LOGOUT_USER } from './types';

export const loginWithEmail = ((email) => async (dispatch) => {
  const LOGIN_USER_API = `${process.env.REACT_APP_SERVER_HOME}api/login/login_user`;

  return new Promise((resolve, reject) => {
    axios({
      method: 'post',
      url: LOGIN_USER_API,
      data: { email },
      headers: {
        'Content-Type': 'application/json',
      },
    }).then((result) => {
      const userLogin = { token: result.data };
      dispatch({
        type: LOGIN_USER,
        payload: userLogin,
      });
      if (result.data.token) {
        localStorage.setItem('user', JSON.stringify(result.data));
      }
      resolve(result.data);
    }).catch((errorResponse) => {
      reject(new Error(errorResponse.response.data));
    });
  });
});

export const logout = () => async (dispatch) => {
  dispatch({
    type: LOGOUT_USER,
  });
};
