import React from 'react';
import { useSelector } from 'react-redux';
import { Navigate, Outlet } from 'react-router-dom';

function useAuth() {
  const token = useSelector((emailList) => emailList.emailList.token);
  if (token !== null) {
    return true;
  }
  return false;
}

function ProtectedRoute() {
  const auth = useAuth();
  return auth ? <Outlet /> : <Navigate to="/" />;
}

export { ProtectedRoute };
