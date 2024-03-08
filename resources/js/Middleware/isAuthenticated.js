// import axios from 'axios';

const isAuthenticated = async () => {
  // Check if the user has a valid JWT token in local storage or cookies
  const token = localStorage.getItem('token');
  const validity = localStorage.getItem('valid');

  // If no token is found, the user is not authenticated
  if (!token) {
    console.log('NO VALIDITY');
    localStorage.setItem('valid', false);
    console.log(token);
    console.log(validity);
    return false;
  }
  console.log(token);
  console.log(validity);
  return true
  

};

export default isAuthenticated;
