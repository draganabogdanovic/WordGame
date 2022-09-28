import { combineReducers } from 'redux';
import wordReducer from '../word/reducers';
import emailReducer from '../email/reducers';

export default combineReducers({
  wordList: wordReducer,
  emailList: emailReducer,
});
