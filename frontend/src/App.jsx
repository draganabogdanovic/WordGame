import React from 'react';
import { Route, Routes, Navigate } from 'react-router-dom';
import { WordGame } from './components/wordGame';
import { WordGameEmail } from './containers/WordGameEmail';
import { ProtectedRoute } from './components/protectedRoute/ProtectedRoute';

function App() {
  return (
    <Routes>
      <Route exact path="/" element={<WordGameEmail />} />
      <Route path="/" element={<ProtectedRoute />}>
        <Route path="/" element={<Navigate replace to="/createScore" />} />
        <Route path="createScore" element={<WordGame />} />
      </Route>
    </Routes>
  );
}

export { App };
