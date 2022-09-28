import { LOGIN_USER, LOGOUT_USER } from './types';

const token = { token: null };

export default function (state = token, action = undefined) {
  switch (action.type) {
    case LOGIN_USER:
      return {
        token: action.payload,
      };

    case LOGOUT_USER:
      return {
        token: null,
      };

    default: return state;
  }
}
