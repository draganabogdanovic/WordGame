import { LOAD_ADDED_WORDS, ADD_NEW_WORD } from './types';

const words = [];

export default function (state = words, action = undefined) {
  console.log(action.payload);
  switch (action.type) {
    case LOAD_ADDED_WORDS:
      return action.payload;
    case ADD_NEW_WORD:
      return [
        ...state,
        action.payload,
      ];

    default: return words;
  }
}
