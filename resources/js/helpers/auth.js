export function login(credentials) {
  return new Promise((resolve, reject) => {
    axios.post('/api/login', credentials)
    .then((response) =>{
      resolve(response.data);
    })
    .catch((error) =>{
      reject("Wrong Email Or Password");
    });
  });
}

export function getLocalUser() {
  const usrStr = localStorage.getItem('user');
  if (!usrStr) {
    return null;
  }

  return JSON.parse(usrStr);
}
